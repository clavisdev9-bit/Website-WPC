<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('cek_akses_submenu')) {
    /**
     * Cek apakah akses submenu diizinkan untuk user tertentu.
     *
     * @param int $user_id
     * @param int $submenu_id
     * @return string
     */
    function cek_akses_submenu($id_user, $id_submenu)
    {
        // Menggunakan Query Builder Laravel
        $count = DB::table('access_submenus')
                    ->where('id_user', $id_user)
                    ->where('id_submenu', $id_submenu)
                    ->count();

        // Cek hasil query
        if ($count > 0) {
            return "checked='checked'";
        }

        return ""; // Tambahkan return default jika tidak ditemukan
    }
}