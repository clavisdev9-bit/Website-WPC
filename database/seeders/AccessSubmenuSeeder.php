<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccessSubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Daftar submenu yang boleh diakses user 1
        $submenuIds = [1, 2, 3, 4, 5];

        foreach ($submenuIds as $submenuId) {
            DB::table('access_submenus')->insert([
                'id_user' => 1,          // user admin
                'id_submenu' => $submenuId,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
