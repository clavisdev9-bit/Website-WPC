<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;

class CheckSubmenuAccess
{
    public function handle($request, Closure $next)
    {

        // Mendapatkan ID pengguna dari sesi
        // $user_id = Auth::id(); // Menggunakan Auth::id() jika menggunakan sistem autentikasi
        $id_user = session()->get('id_user'); 
        // Mendapatkan segmen URL
        $segments = $request->segments();
        $menu = $segments[0] ?? '';
        $submenu = $segments[1] ?? '';
        $gabungan = $menu . '/' . $submenu;

      

        // Query untuk mendapatkan submenu
        $querysubmenu = DB::table('submenus')
            ->where('url', $gabungan)
            ->first();


          

        if (!$querysubmenu) {
            return Redirect::to('/Error/CheckAccessSubMenu');
        }

        $submenuid = $querysubmenu->id_submenu;
      

        // Query untuk memeriksa akses pengguna ke submenu
        $useraccesssubmenu = DB::table('access_submenus')
            ->where('id_user', $id_user)
            ->where('id_submenu', $submenuid)
            ->exists();

        if (!$useraccesssubmenu) {
            return Redirect::to('/Error/CheckAccessSubMenu');
        }

        return $next($request);
    }
}