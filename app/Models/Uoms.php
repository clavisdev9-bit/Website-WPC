<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Uoms extends Model
{
    protected $table = 'uoms';
    protected $primaryKey = 'id';
    public    $incrementing = true;
    public    $timestamps = true;
    protected $fillable = [
    'external_id',
    'name',
    'factor'
];

}
