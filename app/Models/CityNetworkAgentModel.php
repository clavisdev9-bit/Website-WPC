<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CityNetworkAgentModel extends Model
{
    use HasFactory;
    protected $table = 'cities_network_agent';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $fillable = ['country_id', 'name', 'lat', 'lng'];

    public static function isNameCityExists($name)
    {
        return self::where('name', $name)->exists();
    }


    public static function isNameCityExistsUpdate($name, $id)
{
    return self::where('name', $name)
        ->where('id', '!=', $id)
        ->exists();
}

}
