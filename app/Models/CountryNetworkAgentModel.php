<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CountryNetworkAgentModel extends Model
{
    use HasFactory;
    protected $table = 'countries_network_agent';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'iso_code',
        'flag',
        'subcontinent_id'
    ];
}
