<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccesssubMenuModel extends Model
{
     use HasFactory;
 
    protected $table = 'access_submenus';
    protected $primaryKey = 'id_access_submenu';
    public    $incrementing = true;
    public    $timestamps = true;
    
     protected $fillable = [
        'id_user',
        'id_submenu'
    ];
}
