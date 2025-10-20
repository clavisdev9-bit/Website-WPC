<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class ContinentAgentModel extends Model
{
    use HasFactory;
    protected $table = 'continents_network_agent';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'code',
    ];

    //cek apakah ada name menu yang sama  untuk add
    public static function isNameAgentContinentExists($name)
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
