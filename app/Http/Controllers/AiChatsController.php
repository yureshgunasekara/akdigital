<?php

namespace App\Http\Controllers;

use App\Models\ChatBot;
use App\Models\ChatBotChat;
use App\Models\ChatMessage;
use App\Models\User;
use App\Rules\XSSPurifier;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AiChatsController extends Controller
{
    public function chat_bot_handler($chat_bot)
    {
        $user = User::where('id', auth()->user()->id)->first();
        $chats = ChatBotChat::orderBy('created_at', 'desc')
            ->where('user_id', $user->id)
            ->where('chat_bot_id', $chat_bot->id)
            ->with('messages')
            ->paginate(8);

        if ($chats->count() <= 0) {
            ChatBotChat::create([
                'user_id' => $user->id,
                'chat_bot_id' => $chat_bot->id,
                'title' => 'New Conversation',
            ]);

            $chats = ChatBotChat::orderBy('created_at', 'desc')
                ->where('user_id', $user->id)
                ->where('chat_bot_id', $chat_bot->id)
                ->with('messages')
                ->paginate(8);
        };

        return $chats;
    }



    public function index()
    {
        try {
            $chat_bots = ChatBot::with('chats')->get();
            $current_plan = auth()->user()->subscription_plan;

            return Inertia::render('AiChats/ChatBots', compact('chat_bots', 'current_plan'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function ai_bot(Request $request, $id)
    {
        try {
            $active = $request->chat;
            $user = User::where('id', auth()->user()->id)->first();
            
            if ($user->role == 'admin') {
                $chat_bot = ChatBot::where('id', $id)->first();
                $chats = $this->chat_bot_handler($chat_bot);

                return Inertia::render('AiChats/Chat', compact('chat_bot', 'chats', 'active'));
            }

            if($user->subscription_plan->access_template == 'Premium'){
                $chat_bot = ChatBot::where('id', $id)->first();
                $chats = $this->chat_bot_handler($chat_bot);

                return Inertia::render('AiChats/Chat', compact('chat_bot', 'chats', 'active'));
            }
            elseif($user->subscription_plan->access_template == 'Standard'){
                $chat_bot = ChatBot::where('id', $id)->first();
                
                if($chat_bot->access_plan == 'Free' || $chat_bot->access_plan == 'Standard'){
                    $chats = $this->chat_bot_handler($chat_bot);
                    return Inertia::render('AiChats/Chat', compact('chat_bot', 'chats', 'active'));
                }
                else{
                    return back()->with('warning', 'You need to update your current plan to access this.');
                }
            }
            elseif($user->subscription_plan->access_template == 'Free'){
                $chat_bot = ChatBot::where('id', $id)->first();

                if($chat_bot->access_plan == 'Free'){
                    $chats = $this->chat_bot_handler($chat_bot);
                    return Inertia::render('AiChats/Chat', compact('chat_bot', 'chats', 'active'));
                }
                else{
                    return back()->with('warning', 'You need to update your current plan to access this.');
                }
            }            
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function chat_create(Request $request)
    {
        try {
            $user = auth()->user();
            $chat = ChatBotChat::create([
                'user_id' => $user->id,
                'chat_bot_id' => $request->chat_bot_id,
                'title' => 'New Conversation',
            ]);
            return $chat;
        } catch (\Throwable $th) {
            //throw $th;
            return response(['error'=> $th->getMessage()]);
        }
    }


    public function chat_update(Request $request, $id)
    {
        $request->validate([
            'value' => ['required', 'string', 'max:20', new XSSPurifier]
        ]);

        try {
            $chat = ChatBotChat::where('id', $id)->first();
            $chat->title = $request->value;
            $chat->save();

            return response(['success'=> true, 'result' => $chat]);
        } catch (\Throwable $th) {
            return response(['error'=> $th->getMessage()]);
        }
    }


    public function chats(Request $request)
    {
        try {
            $user = auth()->user();
            $bot_id = $request->bot_id;
            $chats = ChatBotChat::orderBy('created_at', 'desc')
                ->where('user_id', $user->id)
                ->where('chat_bot_id', $bot_id)
                ->with('messages')
                ->paginate(8);

            return $chats;
        } catch (\Throwable $th) {
            return response(['error'=> $th->getMessage()]);
        }
    }


    public function chat_messages($botId, $chatId)
    {
        try {
            $user = auth()->user();
            $messages = ChatMessage::orderBy('created_at', 'desc')
                ->where('user_id', $user->id)
                ->where('chat_bot_id', $botId)
                ->where('chat_bot_chat_id', $chatId)
                ->paginate(20);

            return $messages;
        } catch (\Throwable $th) {
            return response(['error'=> $th->getMessage()]);
        }
    }

    public function search(Request $request)
    {
        try {
            $query = $request->value;
            $chats = ChatBotChat::where('title', 'LIKE', '%'.$query.'%')->get();

            return response($chats);
        } catch (\Throwable $th) {
            return response(['error'=> $th->getMessage()]);
        }
    }
}
