<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $roles = [
            'Administrator',
            'Admin_Cms_Website',
            'Admin_Quotation_system',
            'Costumers',
            'Setting_General',
        ];

        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'role' => $role,
                'description' => $role . ' role',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
