<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuModel extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'menus';
    protected $primaryKey = 'id_menu';
    public    $incrementing = true;
    public    $timestamps = true;
    
     protected $fillable = [
        'menu'
    ];

    //cek apakah ada name menu yang sama  untuk add
    public static function isMenuExistsAdd($menu)
    {
        return self::where('menu', $menu)->exists();
    }

    //cek apakah ada name menu yang sama  untuk update
    public static function isMenuExists($menu, $excludeId = null)
    {
        return self::where('menu', $menu)
            ->where('id_menu', '!=', $excludeId)
            ->exists();
    }
}
