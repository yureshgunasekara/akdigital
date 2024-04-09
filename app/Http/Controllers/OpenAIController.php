<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\AppHelper;
use App\Models\AppSetting;
use App\Models\ChatMessage;
use App\Models\GeneratedContent;
use App\Models\MostUsedTemplate;
use App\Models\SavedImage;
use App\Models\TextToSpeech;
use App\Rules\XSSPurifier;
use Illuminate\Http\Request;
use Orhanerday\OpenAi\OpenAi;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class OpenAIController extends Controller
{
    private $open_ai;

    public function __construct()
    {
        $app = AppSetting::first();
        $this->open_ai = new OpenAi($app->openai_key);
    }

    public function user()
    {
        $id = auth()->user()->id;
        return User::where('id', $id)->with('subscription_plan')->first();
    }


    public function template_content(Request $request)
    {
        try {
            $model = $request->model;
            $prompt = $request->prompt;
            $length = (int) $request->length;
            $results = (int) $request->results;
            $creativity = $request->creativity;
            $todaysPrompts = AppHelper::today_content('template');

            $template = MostUsedTemplate::where('user_id', $this->user()->id)->where('template_id', $request->template_id)->first();

            $tokenOver = AppHelper::token_checker($length);
            $contentOver = AppHelper::limit_checker($todaysPrompts, 'prompt_generation', 'template content');
            if ($tokenOver) return $tokenOver;
            if ($contentOver) return $contentOver;

            if ($creativity == 'low') {
                $temp = (float) rand(1, 3);
                $temp = $temp / 10;
            } elseif ($creativity == 'medium') {
                $temp = (float) rand(4, 6);
                $temp = $temp / 10;
            } elseif ($creativity == 'high') {
                $temp = (float) rand(7, 10);
                $temp = $temp / 10;
            }

            // Prepare messages array
            $messages = [
                ["role" => "assistant", "content" => 'You are a helpful assistant.'],
                ["role" => "user", "content" => $prompt],
            ];
            $response = $this->open_ai->chat([
                'model' => $model,
                'messages' => $messages,
                'temperature' => 1.0,
                'max_tokens' => $length,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
                'n' => $results,
            ]);

            $resultToken = json_decode($response)->usage->completion_tokens;

            AppHelper::token_handler($resultToken);
            AppHelper::content_handler($todaysPrompts, 'template');

            if ($template) {
                $template->count = $template->count + 1;
                $template->save();
            } else {
                $newTemplate = new MostUsedTemplate;
                $newTemplate->template_id = $request->template_id;
                $newTemplate->user_id = $this->user()->id;
                $newTemplate->save();
            }

            return $response;
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }


    public function ai_images(Request $request)
    {
        try {
            $todaysImages = AppHelper::today_content('image');
            $contentOver = AppHelper::limit_checker($todaysImages, 'image_generation', 'image');
            if ($contentOver) {
                return back()->with('error', $contentOver['error']);
            };

            $promptDetails = '';
            if ($request->art != 'None') {
                $promptDetails = $promptDetails . '. Image art style will be ' . "'$request->art'.";
            }
            if ($request->lighting != 'None') {
                $promptDetails = $promptDetails . ' Image background lighting style will be ' . "'$request->lighting'.";
            }
            if ($request->mood != 'None') {
                $promptDetails = $promptDetails . ' Image element will be ' . "'$request->mood'.";
            }

            $complete = $this->open_ai->image([
                "prompt" => $request->prompt . $promptDetails,
                "n" => $request->quantity,
                "size" => $request->size,
                "response_format" => "url",
            ]);


            if ($todaysImages) {
                $todaysImages->content_count = $todaysImages->content_count + $request->quantity;
                $todaysImages->update();
            } else {
                $newPrompt = new GeneratedContent;
                $newPrompt->user_id = $this->user()->id;
                $newPrompt->content_type = 'image';
                $newPrompt->generation_date = date('d-m-Y');
                $newPrompt->content_count = $request->quantity;
                $newPrompt->save();
            }
            $res = json_decode($complete, true);
            $currentDateTime = date('Y-m-d H:i:s');

            foreach ($res['data'] as $item) {
                $imageData = file_get_contents($item['url']);
                $filePath = 'generated/' . date('YmdHis') . '.jpg';
                file_put_contents(public_path($filePath), $imageData);

                SavedImage::create([
                    'user_id' => $this->user()->id,
                    'title' => $request->title,
                    'description' => $request->prompt,
                    'generated_at' => $currentDateTime,
                    'img_url' => $filePath,
                ]);
            }

            return back();
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function ai_chats(Request $request)
    {
        try {
            $length = AppHelper::left_token();
            $tokenOver = AppHelper::token_checker($length);
            if ($tokenOver) return $tokenOver;

            // Prepare messages array
            $messages = [
                [
                    "role" => "assistant",
                    "content" => $request->prompt
                ],
                [
                    "role" => "user",
                    "content" => $request->message
                ],
            ];

            $complete = $this->open_ai->chat([
                'model' => $request->model,
                'messages' => $messages,
                'temperature' => 1.0,
                'max_tokens' => $length,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
            ]);

            // decode response
            $bot_replay = json_decode($complete)->choices[0]->message->content;
            $resultToken = json_decode($complete)->usage->completion_tokens;

            AppHelper::token_handler($resultToken);

            ChatMessage::create([
                'user_id' => $this->user()->id,
                'chat_bot_id' => $request->bot_id,
                'chat_bot_chat_id' => $request->chat_id,
                'message' => $request->message,
                'role' => 'user',
            ]);

            ChatMessage::create([
                'user_id' => $this->user()->id,
                'chat_bot_id' => $request->bot_id,
                'chat_bot_chat_id' => $request->chat_id,
                'message' => $bot_replay,
                'role' => 'assistant',
            ]);

            // Content
            return ['role' => 'assistant', 'message' => $bot_replay];
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }


    public function ai_code(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:100', new XSSPurifier],
            'details' => ['required', 'string', 'max:600', new XSSPurifier],
            'language' => ['required', 'string'],
        ]);

        try {
            $title = $request->title;
            $language = $request->language;
            $details = $request->details;
            $maxToken = AppHelper::left_token();
            $todaysCodes = AppHelper::today_content('code');

            $tokenOver = AppHelper::token_checker($maxToken);
            $codeOver = AppHelper::limit_checker($todaysCodes, 'code_generation', 'code');
            if ($tokenOver) return $tokenOver;
            if ($codeOver) return $codeOver;

            $prompt = "Please highly focus to generate only code depend on my instruction and no need any explanation of code but you can add comment beside the code it's depend up to you. Now my instruction is " . $details . ". Please give me the code for " . $language . " programming language.";

            $response = $this->open_ai->completion([
                'model' => "text-davinci-003",
                'prompt' => $prompt,
                'max_tokens' => $maxToken, // The maximum number of tokens to generate
                'temperature' => 0.7, // Controls the randomness of the generated output
                'n' => 1, // The number of completions to generate
            ]);

            header('Content-type: text/event-stream');
            header('Cache-Control: no-cache');

            $code = json_decode($response)->choices[0]->text;
            $resultToken = json_decode($response)->usage->completion_tokens;

            AppHelper::token_handler($resultToken);
            AppHelper::content_handler($todaysCodes, 'code');

            return response([
                'title' => $title,
                'language' => $language,
                'description' => $details,
                'code' => $code,
            ]);
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }


    public function speech_to_text(Request $request)
    {
        $request->validate([
            'audio' => ['required', 'max:6000', 'mimes:mp3'],
            'title' => ['required', 'string', 'max:100', new XSSPurifier],
            'description' => ['required', 'string', 'max:600', new XSSPurifier],
        ]);

        try {
            $audio = $request->audio;
            $title = $request->title;
            $description = $request->description;
            $audio_length = floatval($request->audio_length);

            $todaysTexts = AppHelper::today_content('text');
            $contentOver = AppHelper::limit_checker($todaysTexts, 'speech_to_text_generation', 'speech to text');
            if ($contentOver) return $contentOver;

            if ($request->hasFile('audio')) {
                if ($this->user()->role == 'user') {
                    $duration = (int) $this->user()->subscription_plan->speech_duration;
                    if (($duration * 60) < $audio_length) {
                        return response(['error' => "Speech duration will be $duration minutes."]);
                    }
                };

                $name = time() . '.' . $audio->getClientOriginalExtension();
                $audio->move(public_path('upload'), $name);
                $audioPath = public_path('upload/' . $name);
                $c_file = curl_file_create($audioPath);

                $result = $this->open_ai->transcribe([
                    "model" => "whisper-1",
                    "file" => $c_file,
                ]);

                $text = json_decode($result)->text;
                AppHelper::content_handler($todaysTexts, 'text');
                File::delete('upload/' . $name);

                return ['title' => $title, 'description' => $description, 'text' => $text];
            } else {
                return response(['error' => 'Audio file not found!']);
            }
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }


    public function text_to_speech(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:50', new XSSPurifier],
            'description' => ['required', 'string', new XSSPurifier],
        ]);

        try {
            $outputFormat = 'mp3';
            $app = AppSetting::first();
            $apiUrl = 'https://api.openai.com/v1/audio/speech';

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $app->openai_key,
                'Content-Type' => 'application/json',
            ])->post($apiUrl, [
                'model' => 'tts-1',
                'voice' => $request->voice,
                'input' => $request->description,
                'language' => $request->language,
            ]);

            $speechContent = $response->body();
            $audioPath = 'text-to-audio/' . time() . '.' . $outputFormat;
            file_put_contents(public_path($audioPath), $speechContent);

            TextToSpeech::create([
                'user_id' => $this->user()->id,
                'title' => $request->title,
                'description' => $request->description,
                'language' => $request->language,
                'voice' => $request->voice,
                'audio' => $audioPath,
            ]);

            return back()->with('success', 'Text To Speech generated successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
