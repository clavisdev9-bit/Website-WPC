<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GroupCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('group_companies')->insert([
            [
                'name_group' => 'Clavis',
                'description_group' => 'Clavis Berjaya',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name_group' => 'WPC Logistic',
                'description_group' => 'WPC Logistic',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
