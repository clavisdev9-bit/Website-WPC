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
            ['name' => 'Eropa', 'code' => 'EU', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Afrika', 'code' => 'AF', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Amerika', 'code' => 'AM', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Oseania', 'code' => 'OC', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
