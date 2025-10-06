<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
class CheckMenuAccess
{
    public function handle(Request $request, Closure $next)
    {
        // $user = Auth::user();
        $getRole = session()->get('role_id');
        $menu = $request->segment(1); // Mengambil segmen pertama dari URL
        // dd($getRole);
        if (!$getRole) {
            return redirect('/');
        }
        // Query untuk mendapatkan menu
        $menuData = DB::table('menus')->where('menu', $menu)->first();
        
        if (!$menuData) {
            return redirect('/Error/CheckAccessMenu');
        }

        $menuId = $menuData->id_menu;

        // $roleId = $user->role_id;
        $roleId = $getRole;

        // Query untuk mendapatkan akses user
        $userAccess = DB::table('access_menus')
                       ->where(['id_role' => $roleId, 'id_menu' => $menuId])
                       ->exists();

        if (!$userAccess) {
            return redirect('/Error/CheckAccessMenu');
        }
        
        return $next($request);
    }
}