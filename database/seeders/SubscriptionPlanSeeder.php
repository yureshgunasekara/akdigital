<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubscriptionPlan::create([
            'title' => 'Free',
            'type' => 'Free',
            'status' => 'active',
            'description' => 'Free plan for basic use',
            'monthly_price' => 0,
            'yearly_price' => 0,
            'currency' => 'USD',
            'prompt_generation' => 5,
            'image_generation' => 5,
            'code_generation' => 2,
            'content_token_length' => 2000,
            'text_to_speech_generation' => 1,
            'text_character_length' => 1000,
            'speech_to_text_generation' => 1,
            'speech_duration' => 1,
            'support_request' => 50,
            'access_template' => 'Free',
            'access_chat_bot' => 'Free'
        ]);

        SubscriptionPlan::create([
            'title' => 'Standard',
            'type' => 'Standard',
            'status' => 'active',
            'description' => 'Standard plan for standard use',
            'monthly_price' => 10,
            'yearly_price' => 100,
            'currency' => 'USD',
            'prompt_generation' => 250,
            'image_generation' => 400,
            'code_generation' => 250,
            'content_token_length' => 20000,
            'text_to_speech_generation' => 50,
            'text_character_length' => 20000,
            'speech_to_text_generation' => 30,
            'speech_duration' => 4,
            'support_request' => 250,
            'access_template' => 'Standard',
            'access_chat_bot' => 'Standard'
        ]);

        SubscriptionPlan::create([
            'title' => 'Premium',
            'type' => 'Premium',
            'status' => 'active',
            'description' => 'Premium plan for business use',
            'monthly_price' => 25,
            'yearly_price' => 280,
            'currency' => 'USD',
            'prompt_generation' => 'Unlimited',
            'image_generation' => 'Unlimited',
            'code_generation' => 'Unlimited',
            'content_token_length' => 'Unlimited',
            'text_to_speech_generation' => 'Unlimited',
            'text_character_length' => 'Unlimited',
            'speech_to_text_generation' => 'Unlimited',
            'speech_duration' => 6,
            'support_request' => 'Unlimited',
            'access_template' => 'Premium',
            'access_chat_bot' => 'Premium'
        ]);
    }
}
