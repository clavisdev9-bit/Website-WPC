<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class AccessMenuModel extends Model
{
    use HasFactory;
   
    protected $table = 'access_menus';
    protected $primaryKey = 'id_access_menu';
    public    $incrementing = true;
    public    $timestamps = true;
    
     protected $fillable = [
        'id_role',
        'id_menu'
    ];
}
