<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubmenuModel extends Model
{
    use HasFactory;
    // use SoftDeletes;
    protected $table = 'submenus';
    protected $primaryKey = 'id_submenu';
    public    $incrementing = true;
    public    $timestamps = true;
    
     protected $fillable = [
        'id_submenu','id_menu','url','icon','title','is_active','parent_id','noted'
    ];

    public static function isTitleExists($title)
    {
        return self::where('title', $title)->exists();
    }

    public static function isSubMenuExists($title, $excludeId = null)
    {
        return self::where('title', $title)
            ->where('id_submenu', '!=', $excludeId)
            ->exists();
    }
}
