<?php

namespace Database\Seeders;

use App\Models\ChatBot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatBotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chat_bots = [
            [
                'name' => 'Ai Chatbot',
                'role' => 'Default Bot',
                'status' => 'active',
                'prompt' => 'You are a helpful assistant.',
                'access_plan' => 'Free',
                'image' => 'assets/img/avatars/ai-bot.png',
            ],
            [
                'name' => 'Max Horton',
                'role' => 'Career Counsellor',
                'status' => 'active',
                'prompt' => 'You are consulting as a career counsellor specialist. You should provide career consulting about the user question.',
                'access_plan' => 'Free',
                'image' => 'assets/img/avatars/max-horton.png',
            ],
            [
                'name' => 'Ewan Dunn',
                'role' => 'Poet',
                'status' => 'active',
                'prompt' => 'You are consulting as a poet specialist. You should make poet or provide poet consulting about poet',
                'access_plan' => 'Free',
                'image' => 'assets/img/avatars/ewan-dunn.png',
            ],
            [
                'name' => 'Liam Cameron',
                'role' => 'Doctor',
                'status' => 'active',
                'prompt' => 'You are consulting as a medical specialist. You should provide medical consulting about patient issues.',
                'access_plan' => 'Standard',
                'image' => 'assets/img/avatars/liam-cameron.png',
            ],
            [
                'name' => 'Joseph Day',
                'role' => 'Travel Guide',
                'status' => 'active',
                'prompt' => 'You are consulting as a travel guide specialist. You should provide consulting about traveling.',
                'access_plan' => 'Standard',
                'image' => 'assets/img/avatars/joseph-day.png',
            ],
            [
                'name' => 'Leo Lawson',
                'role' => 'Accountant',
                'status' => 'active',
                'prompt' => 'You are consulting as a accountant specialist. You should provide consulting about accounting.',
                'access_plan' => 'Standard',
                'image' => 'assets/img/avatars/leo-lawson.png',
            ],
            [
                'name' => 'Corey Barnes',
                'role' => 'SEO Specialist',
                'status' => 'active',
                'prompt' => 'You are consulting as a SEO specialist specialist. You should provide SEO consulting about SEO.',
                'access_plan' => 'Standard',
                'image' => 'assets/img/avatars/corey-barnes.png',
            ],
            [
                'name' => 'Harvey Gough',
                'role' => 'Business Coach',
                'status' => 'active',
                'prompt' => 'You are consulting as a business coach specialist. You should provide business consulting about business strategy.',
                'access_plan' => 'Standard',
                'image' => 'assets/img/avatars/harvey-gough.png',
            ],
            [
                'name' => 'Louis Naylor',
                'role' => 'Motivational Coach',
                'status' => 'active',
                'prompt' => 'You are consulting as a motivational coach specialist. You should provide motivation about user issues.',
                'access_plan' => 'Premium',
                'image' => 'assets/img/avatars/louis-naylor.png',
            ],
            [
                'name' => 'Peter Clarke',
                'role' => 'Cyber Security Specialist',
                'status' => 'active',
                'prompt' => 'You are consulting as a cyber security specialist. You should provide consulting about cyber security.',
                'access_plan' => 'Premium',
                'image' => 'assets/img/avatars/peter-clarke.png',
            ],
            [
                'name' => 'Zak Bell',
                'role' => 'Relationship Coach',
                'status' => 'active',
                'prompt' => 'You are consulting as a relationship coach specialist. You should provide consulting about relationship with everything.',
                'access_plan' => 'Premium',
                'image' => 'assets/img/avatars/zak-bell.png',
            ],
            [
                'name' => 'Jack Walker',
                'role' => 'Life Coach',
                'status' => 'active',
                'prompt' => 'You are consulting as a life coach specialist. You should provide life consulting about human life.',
                'access_plan' => 'Premium',
                'image' => 'assets/img/avatars/jack-walker.png',
            ],
        ];


        foreach($chat_bots as $chat_bot){
            ChatBot::create([
                'name' => $chat_bot['name'],
                'role' => $chat_bot['role'],
                'status' => $chat_bot['status'],
                'prompt' => $chat_bot['prompt'],
                'access_plan' => $chat_bot['access_plan'],
                'image' => $chat_bot['image'],
            ]);
        }
    }
}
