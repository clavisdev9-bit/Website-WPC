<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubmenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $submenus = [
            [
                'id_menu' => 1, // Administrator
                'url' => '/administrator/users',
                'icon' => 'fa fa-users',
                'title' => 'Manage Users',
                'noted' => 'CRUD users',
                'parent_id' => null,
            ],
            [
                'id_menu' => 2, // Admin_Cms_Website
                'url' => '/cms/pages',
                'icon' => 'fa fa-file',
                'title' => 'Manage Pages',
                'noted' => 'CRUD pages',
                'parent_id' => null,
            ],
            [
                'id_menu' => 3, // Admin_Quotation_system
                'url' => '/quotation/create',
                'icon' => 'fa fa-file-invoice',
                'title' => 'Create Quotation',
                'noted' => 'Add new quotation',
                'parent_id' => null,
            ],
            [
                'id_menu' => 4, // Customers
                'url' => '/customers/list',
                'icon' => 'fa fa-address-book',
                'title' => 'Customer List',
                'noted' => 'Manage customers',
                'parent_id' => null,
            ],
            [
                'id_menu' => 5, // Setting_General
                'url' => '/settings/general',
                'icon' => 'fa fa-cog',
                'title' => 'General Settings',
                'noted' => 'System settings',
                'parent_id' => null,
            ],
        ];

        foreach ($submenus as $submenu) {
            DB::table('submenus')->insert([
                'id_menu' => $submenu['id_menu'],
                'url' => $submenu['url'],
                'icon' => $submenu['icon'],
                'title' => $submenu['title'],
                'noted' => $submenu['noted'],
                'parent_id' => $submenu['parent_id'],
                'is_active' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
