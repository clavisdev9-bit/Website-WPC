<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoleModel extends Model
{
     use HasFactory;
    // use SoftDeletes;
    protected $table = 'roles';
    protected $primaryKey = 'id_role';
    public    $incrementing = true;
    public    $timestamps = true;

    protected $fillable = [
        'role',
        'description_role'
    ];


    //cek apakah ada name menu yang sama  untuk add
    public static function isRoleExists($role)
    {
        return self::where('role', $role)->exists();
    }

    //cek apakah ada name menu yang sama  untuk update
    public static function isRoleExistsEdit($role, $excludeId = null)
    {
        return self::where('role', $role)
            ->where('id_role', '!=', $excludeId)
            ->exists();
    }
}
