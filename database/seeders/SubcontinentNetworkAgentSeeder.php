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
            ['name' => 'Southeast Asia', 'code' => 'SEA', 'continent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'East Asia', 'code' => 'EAS', 'continent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Central Asia', 'code' => 'CAS', 'continent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'South Asia', 'code' => 'SAS', 'continent_id' => 1, 'created_at' => now(), 'updated_at' => now()],

            // Eropa
            ['name' => 'Western Europe', 'code' => 'WEU', 'continent_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Eastern Europe', 'code' => 'EEU', 'continent_id' => 2, 'created_at' => now(), 'updated_at' => now()],

            // Afrika
            ['name' => 'North Africa', 'code' => 'NAF', 'continent_id' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sub-Saharan Africa', 'code' => 'SSA', 'continent_id' => 3, 'created_at' => now(), 'updated_at' => now()],

            // Amerika
            ['name' => 'North America', 'code' => 'NA', 'continent_id' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'South America', 'code' => 'SA', 'continent_id' => 4, 'created_at' => now(), 'updated_at' => now()],

            // Oseania
            ['name' => 'Australia and Oceania', 'code' => 'AUS', 'continent_id' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
