<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Asumsi app_settings_frontend id = 1
        $appSettingId = 1;

        $socials = [
            [
                'platform' => 'Facebook',
                'url' => 'https://facebook.com/mycompany',
                'icon' => 'fab fa-facebook',
            ],
            [
                'platform' => 'Twitter',
                'url' => 'https://twitter.com/mycompany',
                'icon' => 'fab fa-twitter',
            ],
            [
                'platform' => 'Instagram',
                'url' => 'https://instagram.com/mycompany',
                'icon' => 'fab fa-instagram',
            ],
            [
                'platform' => 'LinkedIn',
                'url' => 'https://linkedin.com/company/mycompany',
                'icon' => 'fab fa-linkedin',
            ],
        ];

        foreach ($socials as $social) {
            DB::table('social_medias')->insert([
                'app_setting_id' => $appSettingId,
                'platform' => $social['platform'],
                'url' => $social['url'],
                'icon' => $social['icon'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
