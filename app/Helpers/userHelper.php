<?php

use Illuminate\Support\Facades\Session;
use App\Models\usersModel;

if (! function_exists('getUserData')) {
    function getUserData()
    {
        $userId = session()->get('id_user'); // ambil dari session
        if ($userId) {
            return UsersModel::find($userId); // langsung find user
        }
        return null;
    }
}