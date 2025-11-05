<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContinentNetworkAgentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('continents_network_agent')->insert([
            ['name' => 'Asia', 'code' => 'AS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Europe', 'code' => 'EU', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Africa', 'code' => 'AF', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'America', 'code' => 'AM', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Oceania', 'code' => 'OC', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
