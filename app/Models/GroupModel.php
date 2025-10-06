<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
class GroupModel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'group_companies';
    protected $primaryKey = 'id_group';
    public    $incrementing = true;
    public    $timestamps = true;
}
