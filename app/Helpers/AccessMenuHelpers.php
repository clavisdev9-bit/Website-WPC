<?php 
// app/Helpers/AccessHelper.php
use Illuminate\Support\Facades\DB;

if (!function_exists('cek_akses')) {
    function cek_akses($role_id, $menu_id)
    {
        // Query untuk mengecek akses
        $exists = DB::table('access_menus')
                    ->where('id_role', $role_id)
                    ->where('id_menu', $menu_id)
                    ->exists();

        // Cek hasil query
        if ($exists) {
            return "checked='checked'";
        }
        return ""; // Tambahkan return default jika tidak ditemukan
    }
}