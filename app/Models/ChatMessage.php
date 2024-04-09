<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chat_bot_id',
        'chat_bot_chat_id',
        'message',
        'role',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function bot(){
        return $this->belongsTo(ChatBot::class);
    }

    public function chat(){
        return $this->hasMany(ChatMessage::class);
    }
}
