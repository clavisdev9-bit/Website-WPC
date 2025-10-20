<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcontinentNetworkAgentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('subcontinents_network_agent')->insert([
            // Asia
            ['name' => 'Asia Tenggara', 'code' => 'SEA', 'continent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Asia Timur', 'code' => 'EAS', 'continent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Asia Tengah', 'code' => 'CAS', 'continent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Asia Selatan', 'code' => 'SAS', 'continent_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Eropa
            ['name' => 'Eropa Barat', 'code' => 'WEU', 'continent_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Eropa Timur', 'code' => 'EEU', 'continent_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Afrika
            ['name' => 'Afrika Utara', 'code' => 'NAF', 'continent_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Afrika Sub-Sahara', 'code' => 'SSA', 'continent_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // Amerika
            ['name' => 'Amerika Utara', 'code' => 'NA', 'continent_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Amerika Selatan', 'code' => 'SA', 'continent_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // Oseania
            ['name' => 'Australia dan Oseania', 'code' => 'AUS', 'continent_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
