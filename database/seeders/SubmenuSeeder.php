<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SubmenuSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        $submenus = [
            // ================================
            // DASHBOARD
            // ================================
            [
                'id_menu' => 1,
                'url' => 'Administrator/Dashboard',
                'icon' => 'nav-icon fa fa-home',
                'title' => 'Dashboard Admin IT',
                'noted' => '(main) Dashboard Administrator',
                'is_active' => true,
                'parent_id' => null,
            ],
            // ================================
            // MENU MANAGEMENT
            // ================================
            [
                'id_menu' => 1,
                'url' => 'Administrator/Menu',
                'icon' => 'nav-icon fa fa-tasks',
                'title' => 'Menu Management',
                'noted' => '(main) Menu Data Management',
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/Get-menu-management',
                'icon' => null,
                'title' => '(action) url Get Menu',
                'noted' => '(action) url Get Menu',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/create-menu-management',
                'icon' => null,
                'title' => '(action) Add Data Menu',
                'noted' => '(action) Add Data Menu',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/store-menu-management',
                'icon' => null,
                'title' => '(action) add store menu management',
                'noted' => '(action) add store menu management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/view-menu-update',
                'icon' => null,
                'title' => '(action) view-menu-update',
                'noted' => '(action) view-menu-update',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/store-update-menu-management',
                'icon' => null,
                'title' => '(action) store-update-menu-management',
                'noted' => '(action) store-update-menu-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/menu-delete-management',
                'icon' => null,
                'title' => '(Action) menu-delete-management',
                'noted' => '(Action) menu-delete-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            // ================================
            // ROLE MANAGEMENT
            // ================================
            [
                'id_menu' => 1,
                'url' => 'Administrator/Roles-management',
                'icon' => 'nav-icon fa fa-cog',
                'title' => 'Role Management',
                'noted' => '(main) Role Data Management',
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/Get-role-management',
                'icon' => null,
                'title' => '(action) URL Get Role',
                'noted' => '(action) URL Get Role',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/create-role-management',
                'icon' => null,
                'title' => '(action) create-role-management',
                'noted' => '(action) create-role-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/Store-role-management',
                'icon' => null,
                'title' => '(action) Store-role-management',
                'noted' => '(action) Store-role-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/view-role-update',
                'icon' => null,
                'title' => '(action) view-role-update',
                'noted' => '(action) view-role-update',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/store-update-role-management',
                'icon' => null,
                'title' => '(action) store-update-role-management',
                'noted' => '(action) store-update-role-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/role-delete-management',
                'icon' => null,
                'title' => '(action) role-delete-management',
                'noted' => '(action) role-delete-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/role-access-menu',
                'icon' => null,
                'title' => '(action) View role-access-menu',
                'noted' => '(action) role-access-menu',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/change-access-menu',
                'icon' => null,
                'title' => '(action) change-access-menu',
                'noted' => '(action) change-access-menu',
                'is_active' => false,
                'parent_id' => null,
            ],
            // ================================
            // USER MANAGEMENT
            // ================================
            [
                'id_menu' => 1,
                'url' => 'Administrator/Users-management',
                'icon' => 'nav-icon fa fa-users',
                'title' => 'User Management',
                'noted' => '(main) User Management',
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/Get-user-management',
                'icon' => null,
                'title' => '(action) Get User Management',
                'noted' => '(action) Get User Management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/create-user-management',
                'icon' => null,
                'title' => '(action) create-user-management',
                'noted' => '(action) create-user-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/Store-user-management',
                'icon' => null,
                'title' => '(action) store-update-user-management',
                'noted' => '(action) store-update-user-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/view-user-update',
                'icon' => null,
                'title' => '(action) view-user-update',
                'noted' => '(action) view-user-update',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/update-user-management',
                'icon' => null,
                'title' => '(action) store-update-user-management',
                'noted' => '(action) store-update-user-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/user-delete-management',
                'icon' => null,
                'title' => '(action) user-delete-management',
                'noted' => '(action) user-delete-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/access-user-submenu',
                'icon' => null,
                'title' => '(action) view-access-user-submenu',
                'noted' => '(action) view-access-user-submenu',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/change-access-submenu',
                'icon' => null,
                'title' => '(action) change-access-user-to-submenu',
                'noted' => '(action) change-access-user-to-submenu',
                'is_active' => false,
                'parent_id' => null,
            ],
            // ================================
            // SUB MENU MANAGEMENT
            // ================================
            [
                'id_menu' => 1,
                'url' => 'Administrator/Sub-Menu-management',
                'icon' => 'nav-icon fa fa-sitemap',
                'title' => 'Sub menu Management',
                'noted' => '(main) Sub-Menu Data Management',
                'is_active' => true,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/Get-submenu-management',
                'icon' => null,
                'title' => '(action) Get-submenu-management',
                'noted' => '(action) Get-submenu-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/create-submenu-management',
                'icon' => null,
                'title' => '(action) create-submenu-management',
                'noted' => '(action) create-submenu-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/Store-submenu-management',
                'icon' => null,
                'title' => '(action) Store-submenu-management',
                'noted' => '(action) Store-submenu-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/view-submenu-update',
                'icon' => null,
                'title' => '(action) view-submenu-update',
                'noted' => '(action) view-submenu-update',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/store-update-submenu-management',
                'icon' => null,
                'title' => '(action) store-update-submenu-management',
                'noted' => '(action) store-update-submenu-management',
                'is_active' => false,
                'parent_id' => null,
            ],
            [
                'id_menu' => 1,
                'url' => 'Administrator/submenu-delete-management',
                'icon' => null,
                'title' => '(action) submenu-delete-management',
                'noted' => '(action) submenu-delete-management',
                'is_active' => false,
                'parent_id' => null,
            ],


            [
                'id_menu' => 1,
                'url' => 'Administrator/Master-network',
                'icon' => 'nav-icon fa fa-network-wired',
                'title' => 'Master Network',
                'noted' => '(main) Master Network',
                'is_active' => true,
                'parent_id' => null,
            ],


            [
                'id_menu' => 1,
                'url' => 'Administrator/Master-continent-agent',
                'icon' => 'nav-icon fa fa-minus',
                'title' => 'Master Continent',
                'noted' => '(main) Master Continent',
                'is_active' => true,
                'parent_id' => 34,
            ],


            [
                'id_menu' => 1,
                'url' => 'Administrator/Master-subcontinent-agent',
                'icon' => 'nav-icon fa fa-minus',
                'title' => 'Master SubContinent',
                'noted' => '(main) Master SubContinent',
                'is_active' => true,
                'parent_id' => 34,
            ],


            [
                'id_menu' => 1,
                'url' => 'Administrator/Agent-network-country',
                'icon' => 'nav-icon fa fa-minus',
                'title' => 'Master Country ',
                'noted' => '(main) Master Country',
                'is_active' => true,
                'parent_id' => 34,
            ],

            [
                'id_menu' => 1,
                'url' => 'Administrator/Agent-network-city',
                'icon' => 'nav-icon fa fa-minus',
                'title' => 'Master City',
                'noted' => '(main) Master City',
                'is_active' => true,
                'parent_id' => 34,
            ],


            [
                'id_menu' => 1,
                'url' => 'Administrator/Master-agent-network',
                'icon' => 'nav-icon fa fa-minus',
                'title' => 'Master Agent',
                'noted' => '(main) Master Agent',
                'is_active' => true,
                'parent_id' => 34,
            ],


            [
                'id_menu' => 1,
                'url' => 'Administrator/Master-Sync',
                'icon' => 'nav-icon fa fa-rotate',
                'title' => 'Master Sync',
                'noted' => '(main) Master Sync',
                'is_active' => true,
                'parent_id' => null,
            ],


            [
                'id_menu' => 1,
                'url' => 'Administrator/Data-Sync-Commodities',
                'icon' => 'nav-icon fa fa-database',
                'title' => 'Master Commodity',
                'noted' => '(main) Master Commodity',
                'is_active' => true,
                'parent_id' => 40,
            ],


             [
                'id_menu' => 1,
                'url' => 'Administrator/Data-Sync-Uom',
                'icon' => 'nav-icon fa fa-database',
                'title' => 'Master UOM',
                'noted' => '(main) Master UOM',
                'is_active' => true,
                'parent_id' => 40,
            ],



             // ================================
            // General Menu Setting MANAGEMENT
            // ================================
            [
                'id_menu' => 5,
                'url' => 'Setting_General/Change-password',
                'icon' => 'nav-icon fa fa-key',
                'title' => 'Change password',
                'noted' => '(main) Change-password',
                'is_active' => true,
                'parent_id' => null,
            ],

            [
                'id_menu' => 5,
                'url' => 'Setting_General/Change-password-user',
                'icon' => null,
                'title' => '(action) Change-password-user',
                'noted' => '(action) Change-password-user',
                'is_active' => false,
                'parent_id' => null,
            ],

            [
                'id_menu' => 5,
                'url' => 'Setting_General/Change-profile',
                'icon' => 'nav-icon fa fa-user-circle',
                'title' => 'Change profile',
                'noted' => '(main) Change-profile',
                'is_active' => true,
                'parent_id' => null,
            ],

            [
                'id_menu' => 5,
                'url' => 'Setting_General/Change-profile-user',
                'icon' => null,
                'title' => '(action) Change-profile-user',
                'noted' => '(action) Change-profile-user',
                'is_active' => false,
                'parent_id' => null,
            ],

            [
                'id_menu' => 5,
                'url' => 'Setting_General/Logout',
                'icon' => 'nav-icon fa fa-upload',
                'title' => 'Logout',
                'noted' => '(main) Logout',
                'is_active' => true,
                'parent_id' => null,
            ],


            // ================================
            //  Costumers submenu
            // ================================

            [
                'id_menu' => 4,
                'url' => 'Costumers/Home',
                'icon' => 'nav-icon fa fa-home',
                'title' => 'Costumers Home',
                'noted' => '(main) Costumers-Home',
                'is_active' => true,
                'parent_id' => null,
            ],

            [
                'id_menu' => 4,
                'url' => 'Costumers/Costumer-Document',
                'icon' => 'nav-icon fa fa-file-export',
                'title' => 'Costumer Document',
                'noted' => '(main) Costumer-Document',
                'is_active' => true,
                'parent_id' => null,
            ],

            // ================================
            //  submenu web Admin_Quotation_system
            // ================================

            [
                'id_menu' => 3,
                'url' => 'Admin_Quotation_system/Home',
                'icon' => 'nav-icon fa fa-home',
                'title' => 'Home Admin Qoute',
                'noted' => '(main) Home Admin Qoute',
                'is_active' => true,
                'parent_id' => null,
            ],

            [
                'id_menu' => 3,
                'url' => 'Admin_Quotation_system/List-Request-Quotation',
                'icon' => 'nav-icon fa fa-retweet',
                'title' => 'List Request  Inquiry',
                'noted' => '(main) List Request  Inquiry',
                'is_active' => true,
                'parent_id' => null,
            ],

            [
                'id_menu' => 3,
                'url' => 'Admin_Quotation_system/Get-quotation',
                'icon' => null,
                'title' => '(action) Get-quotation',
                'noted' => '(action) Get-quotation',
                'is_active' => false,
                'parent_id' => null,
            ],


            [
                'id_menu' => 3,
                'url' => 'Admin_Quotation_system/System-contact-sync',
                'icon' => 'nav-icon fa fa-list-alt',
                'title' => 'System Contact Sync',
                'noted' => '(main) System Contact Sync',
                'is_active' => true,
                'parent_id' => null,
            ],

            [
                'id_menu' => 3,
                'url' => 'Admin_Quotation_system/Get-contact-sync',
                'icon' => null,
                'title' => '(action) Get-contact-sync',
                'noted' => '(action) Get-contact-sync',
                'is_active' => false,
                'parent_id' => null,
            ],


             [
                'id_menu' => 3,
                'url' => 'Admin_Quotation_system/Get-contact-log-sync',
                'icon' => null,
                'title' => '(action) Get-contact-log-sync',
                'noted' => '(action) Get-contact-log-sync',
                'is_active' => false,
                'parent_id' => null,
            ],




            // admin website

            [
                'id_menu'    => 2,
                'url'        => 'Admins/Homes',
                'icon'       => 'nav-icon fa fa-home',
                'title'      => 'Home Admin Website',
                'noted'      => '(main) Home Page Admin Website',
                'is_active'  => true,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/Master-Category-Blogs',
                'icon'       => 'nav-icon fa fa-table',
                'title'      => 'Master Category Blogs',
                'noted'      => '(main) Master-Category-Blogs',
                'is_active'  => true,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/Get-category-blog',
                'icon'       => null,
                'title'      => '(action)',
                'noted'      => '(action)',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/add-category-blogs',
                'icon'       => null,
                'title'      => '(action) add-category-blogs',
                'noted'      => '(action) add-category-blogs',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/store-category-blogs',
                'icon'       => null,
                'title'      => '(action) store-category-blogs',
                'noted'      => '(action) store-category-blogs',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/Get-blogs-category-update',
                'icon'       => null,
                'title'      => '(action) Get-blogs-category-update',
                'noted'      => '(action) Get-blogs-category-update',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/store-update-category-blogs',
                'icon'       => null,
                'title'      => '(action) store-update-category-blogs',
                'noted'      => '(action) store-update-category-blogs',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/delete-category-blogs',
                'icon'       => null,
                'title'      => '(action) delete-category-blogs',
                'noted'      => '(action) delete-category-blogs',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/List-contact-request',
                'icon'       => 'nav-icon fa fa-question',
                'title'      => 'List-contact-request',
                'noted'      => '(main) List-contact-request',
                'is_active'  => true,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/Get-List-contact-request',
                'icon'       => null,
                'title'      => '(action) Get-List-contact-request',
                'noted'      => '(action) Get-List-contact-request',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/Contact-form-delete',
                'icon'       => null,
                'title'      => '(action) Contact-form-delete',
                'noted'      => '(action) Contact-form-delete',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],

            [
                'id_menu'    => 2,
                'url'        => 'Admins/List-blogs-company',
                'icon'       => 'nav-icon fa fa-newspaper',
                'title'      => 'List-blogs-company',
                'noted'      => '(main) List-blogs-company',
                'is_active'  => true,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],


            [
                'id_menu'    => 2,
                'url'        => 'Admins/Get-blogs',
                'icon'       => null,
                'title'      => '(action) Get-blogs',
                'noted'      => '(action) Get-blogs',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/add-content-blogs',
                'icon'       => null,
                'title'      => '(action) add-content-blogs',
                'noted'      => '(action) add-content-blogs',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/store-content-blogs',
                'icon'       => null,
                'title'      => '(action) store-content-blogs',
                'noted'      => '(action) store-content-blogs',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/delete-content-blogs',
                'icon'       => null,
                'title'      => '(action) delete-content-blogs',
                'noted'      => '(action) delete-content-blogs',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/Get-blogs-update',
                'icon'       => null,
                'title'      => '(action) Get-blogs-update',
                'noted'      => '(action) Get-blogs-update',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id_menu'    => 2,
                'url'        => 'Admins/store-update-blogs',
                'icon'       => null,
                'title'      => '(action) store-update-blogs',
                'noted'      => '(action) store-update-blogs',
                'is_active'  => false,
                'parent_id'  => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],


        ];

        foreach ($submenus as $submenu) {
            DB::table('submenus')->insert([
                'id_menu' => $submenu['id_menu'],
                'url' => $submenu['url'],
                'icon' => $submenu['icon'],
                'title' => $submenu['title'],
                'noted' => $submenu['noted'],
                'is_active' => $submenu['is_active'],
                'parent_id' => $submenu['parent_id'],
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }
}
