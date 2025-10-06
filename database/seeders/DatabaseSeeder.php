<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GroupCompanySeeder::class,
            DivisionSeeder::class,
            MenuSeeder::class,
            RoleSeeder::class,
            MsUserSeeder::class,
            BlogCategorySeeder::class,
            SubmenuSeeder::class,
            AccessMenuSeeder::class,
            AccessSubmenuSeeder::class,
            BlogSeeder::class,
            AppSettingsBackendSeeder::class,
            AppSettingsFrontendSeeder::class,
            SocialMediaSeeder::class,
        ]);
    }
}
