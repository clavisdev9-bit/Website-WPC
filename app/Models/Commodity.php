<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{

    protected $table = 'commodities';
    protected $primaryKey = 'id';
    public    $incrementing = true;
    public    $timestamps = true;
    protected $fillable = [
        'external_id',
        'name',
        'code'
    ];
}
