<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usersModel extends Model
{
    use HasFactory;
    protected $table = 'ms_users';
    protected $primaryKey = 'id_user';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'fullname',
        'username',
        'email',
        'image',
        'password',
        'role_id',
        'group_id',
        'is_active',
        'divisi_id',
    ];


    public static function isUsernameExistsAdd($username)
    {
        return self::where('username', $username)->exists();
    }

    public static function isUsernameExistsEdit($username, $excludeId = null)
    {
        return self::where('username', $username)
            ->where('id_user', '!=', $excludeId)
            ->exists();
    }


    public static function isUsernameExists($username, $excludeId = null)
    {
        return self::where('username', $username)
            ->where('id_user', '!=', $excludeId)
            ->exists();
    }
}
