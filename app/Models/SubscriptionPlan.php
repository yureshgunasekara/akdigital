<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'status',
        'description',
        'monthly_price',
        'yearly_price',
        'currency',
        'prompt_generation',
        'image_generation',
        'code_generation',
        'content_token_length',
        'text_to_speech_generation',
        'text_character_length',
        'speech_to_text_generation',
        'speech_duration',
        'support_request',
        'access_template',
        'access_chat_bot',
    ];
}
