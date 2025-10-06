<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppSettingsFrontendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('app_settings_frontend')->insert([
            'app_name' => 'My Frontend App',
            'logo_path' => 'frontend_logo.png',
            'version' => '1.0.0',
            'copyright' => '© 2025 My Company',
            'year' => '2025',
            'company_name' => 'My Company',
            'email' => 'info@mycompany.com',
            'phone' => '+62 812 3456 7890',
            'address' => 'Jl. Contoh No.123, Jakarta',
            'description' => 'This is the frontend configuration of the application.',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
