<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(RoleSeeder::class);
        // $this->call(EnvSeeder::class);
        
        $this->call(AppSettingsSeeder::class);
        $this->call(PaymentGatewaySeeder::class);
        $this->call(SmtpSettingsSeeder::class);
        $this->call(SocialLoginSeeder::class);
        $this->call(TemplateSeeder::class);
        $this->call(SubscriptionPlanSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(ChatBotSeeder::class);
        $this->call(IntroPageSeeder::class);
        $this->call(TestimonialSeeder::class);
    }
}
