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
}
