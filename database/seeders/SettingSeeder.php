<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        Setting::create([
            "banner_img" => null,
            "background_img" => null,
            "logo" => null,
            "code" => 'SNCBC',
            "instagram_link" => 'https://www.instagram.com/slotsnchill/profilecard/?igsh=MTE1dWpmZTVuMG0zeA==Kick.com/slotsnchill',
            "discord_link" => 'https://discord.com/invite/9hWuUDQXjJ',
            "youtube_link" => 'https://youtube.com/@slotsnchill?si=wJkprzg2SWsAWMj0',
            "bcgame_link" => 'https://bc.game/i-sncbc-n/',
            "shadow_color" => '#32cd32',
            "countdown_color" => '#32cd32',
            "table_title_color" => '#32cd32',
            "table_border_color" => '#32cd32',
            "table_prizes_color" => '#32cd32',
            "table_text_color" => '#ffffff',
            "text_color" => '#ffffff',
            "button_text_color" => '#ffffff',
            "button_background_color" => '#222',
            "button_background_hover_color" => '#32cd32',
        ]);
    }
}
