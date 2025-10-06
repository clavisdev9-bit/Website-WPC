<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccessMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Menu yang boleh diakses role Administrator
        $menuIds = [1, 2, 3, 4, 5];

        foreach ($menuIds as $menuId) {
            DB::table('access_menus')->insert([
                'id_role' => 1, // Administrator
                'id_menu' => $menuId,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
