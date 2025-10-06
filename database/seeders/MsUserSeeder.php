<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class MsUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('ms_users')->insert([
            'fullname' => 'apregi pratayuda',
            'username' => 'administrator',
            'email' => 'administrator@example.com',
            'password' => Hash::make('password123'), // password default
            'image' => 'default.png',
            'role_id' => 1,      // sesuai id role dari RoleSeeder
            'group_id' => 1,     // sesuai id group dari GroupCompanySeeder
            'divisi_id' => 1,    // sesuai id divisi dari DivisionSeeder
            'is_active' => true,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
