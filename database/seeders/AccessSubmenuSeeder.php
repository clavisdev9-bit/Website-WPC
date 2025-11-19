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

        // Semua submenu (1 sampai 73)
        $submenuIds = range(1, 73);

        foreach ($submenuIds as $submenuId) {
            DB::table('access_submenus')->insert([
                'id_user'    => 1, // user admin
                'id_submenu' => $submenuId,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
