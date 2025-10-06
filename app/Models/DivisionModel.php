<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
class DivisionModel extends Model
{
      use HasFactory;
    use SoftDeletes;
    protected $table = 'division';
    protected $primaryKey = 'id';
    public    $incrementing = true;
    public    $timestamps = true;

}
