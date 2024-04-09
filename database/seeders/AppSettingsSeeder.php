<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AppSetting::create([
            'name' => 'FastAI',
            'email' => 'aiwriter@mail.com',
            'logo' => 'assets/logo/fastai.png',
            'timezone' => 'Asia/Dhaka',
            'copyright' => 'Copyrights © 2023 FastAI. All rights reserved.',
            'openai_key' => '',
            'aws_key' => '',
            'aws_secret' => '',
        ]);
    }
}
