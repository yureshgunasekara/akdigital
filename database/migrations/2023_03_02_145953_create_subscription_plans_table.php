<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type');
            $table->string('status');
            $table->string('description');
            $table->float('monthly_price');
            $table->float('yearly_price');
            $table->string('currency');
            $table->string('prompt_generation');
            $table->string('image_generation');
            $table->string('code_generation');
            $table->string('content_token_length');
            $table->string('text_to_speech_generation');
            $table->string('text_character_length');
            $table->string('speech_to_text_generation');
            $table->integer('speech_duration');
            $table->string('support_request');
            $table->string('access_template');
            $table->string('access_chat_bot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_plans');
    }
};
