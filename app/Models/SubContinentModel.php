<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubContinentModel extends Model
{
   use HasFactory;
    protected $table = 'subcontinents_network_agent';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'code',
        'continent_id',
    ];

    //cek apakah ada name menu yang sama  untuk add
    public static function isNameAgentSubContinentExists($name)
    {
        return self::where('name', $name)->exists();
    }

    //cek apakah ada name menu yang sama  untuk update
    public static function isNameAgentContinentExistsUpdate($name, $excludeId = null)
    {
        return self::where('name', $name)
            ->where('id', '!=', $excludeId)
            ->exists();
    }

}
