<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $menus = [
            'Administrator',
            'Admin_Cms_Website',
            'Admin_Quotation_system',
            'Costumers',
            'Setting_General',
        ];

        foreach ($menus as $menu) {
            DB::table('menus')->insert([
                'menu' => $menu,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
