<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Helpers\AppHelper;
use App\Models\SpeechToText;
use App\Models\TextToSpeech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Response;


class SpeechTextController extends Controller
{
    public function speech_to_text()
    {
        try {
            $user = AppHelper::user();
            $todaysTexts = AppHelper::today_content('text');

            return Inertia::render('SpeechToText', compact('user', 'todaysTexts'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function text_save(Request $request)
    {
        try {
            $user = auth()->user();
            SpeechToText::create([
                'user_id' => $user->id,
                'title' => $request->title,
                'description' => $request->description,
                'text' => $request->text,
            ]);
            return Redirect::route('speech-to-text')->with('success', 'Speech to text generated successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function show_text(Request $request)
    {
        try {
            $page = 10;
            $user = auth()->user();
            if ($request->per_page) {
                $page = intval($request->per_page);
            }

            if ($user->role == 'admin') {
                $texts = SpeechToText::orderBy('created_at', 'desc')
                    ->paginate($page);
            } else {
                $texts = SpeechToText::orderBy('created_at', 'desc')
                    ->where('user_id', $user->id)
                    ->paginate($page);
            }

            return Inertia::render('SavedDocuments/SpeechToText/Show', compact('texts'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function view_text($id)
    {
        try {
            $text = SpeechToText::where('id', $id)->first();

            return Inertia::render('SavedDocuments/SpeechToText/Update', compact('text'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function update_text(Request $request, $id)
    {
        try {
            SpeechToText::where('id', $id)->update([
                'title' => $request->title,
                'text' => $request->text,
            ]);

            return back()->with('success', "Speech to text successfully updated.");
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function delete_text($id)
    {
        try {
            SpeechToText::where('id', $id)->delete();

            return back()->with('success', 'Speech to text successfully deleted');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function search_text(Request $request)
    {
        try {
            $page = 20;
            $user = auth()->user();
            $query = $request->value;
            if ($request->per_page) {
                $page = intval($request->per_page);
            }

            if ($user->role == 'admin') {
                $result = SpeechToText::where('title', 'LIKE', '%' . $query . '%')
                    ->paginate($page);
            } else {
                $result = SpeechToText::where('user_id', $user->id)
                    ->where('title', 'LIKE', '%' . $query . '%')
                    ->paginate($page);
            }

            return $result;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }


    // Text to speech controller form here
    public function text_to_speech()
    {
        try {
            $user = AppHelper::user();
            $todaysSpeeches = AppHelper::today_content('speech');
            $speeches = TextToSpeech::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->latest()
                ->take(10)
                ->get();

            return Inertia::render('TextToSpeech', compact('user', 'speeches', 'todaysSpeeches'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function show_speeches(Request $request)
    {
        try {
            $page = 10;
            $user = auth()->user();
            if ($request->per_page) {
                $page = intval($request->per_page);
            }

            if ($user->role == 'admin') {
                $speeches = TextToSpeech::orderBy('created_at', 'desc')
                    ->paginate($page);
            } else {
                $speeches = TextToSpeech::orderBy('created_at', 'desc')
                    ->where('user_id', $user->id)
                    ->paginate($page);
            }

            return Inertia::render('SavedDocuments/TextToSpeech/Show', compact('speeches'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function delete_speech($id)
    {
        try {
            $speech = TextToSpeech::where('id', $id)->first();
            File::delete($speech->audio);
            $speech->delete();

            return back()->with('success', 'Text to speech successfully deleted');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function search_speech(Request $request)
    {
        try {
            $page = 20;
            $user = auth()->user();
            $query = $request->value;
            if ($request->per_page) {
                $page = intval($request->per_page);
            }

            if ($user->role == 'admin') {
                $result = TextToSpeech::where('title', 'LIKE', '%' . $query . '%')
                    ->paginate($page);
            } else {
                $result = TextToSpeech::where('user_id', $user->id)
                    ->where('title', 'LIKE', '%' . $query . '%')
                    ->paginate($page);
            }

            return $result;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }


    // Export texts list
    public function export_text()
    {
        $texts = SpeechToText::all();
        $columns = Schema::getColumnListing((new SpeechToText())->getTable());
        $headers = AppHelper::exportToCSV($texts, $columns, 'texts');

        return Response::make('', 200, $headers);
    }


    // Export speeches list
    public function export_speech()
    {
        $speeches = TextToSpeech::all();
        $columns = Schema::getColumnListing((new TextToSpeech())->getTable());
        $headers = AppHelper::exportToCSV($speeches, $columns, 'speeches');

        return Response::make('', 200, $headers);
    }
}
