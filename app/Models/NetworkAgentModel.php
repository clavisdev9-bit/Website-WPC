<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class NetworkAgentModel extends Model
{
    use HasFactory;
    protected $table = 'agents_network';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
     protected $fillable = [
        'name',
        'code',
        'country_id',
        'city_id',
        'address',
        'lat',
        'lng',
        'phone',
        'email',
        'image',
        'status',
    ];


    public function scopeSearch($query, $search)
{
    if ($search) {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%");
        });
    }
    return $query;
}



// Scope untuk sorting dinamis
public function scopeSort($query, $sortBy, $sortDir)
{
    return $query->orderBy($sortBy ?? 'created_at', $sortDir ?? 'asc');
}

public static function isDuplicate(array $data, $id = null): array
{
    $errors = [];

    $query = static::where('name', $data['name']);

    if ($id) {
        $query->where('id', '!=', $id); // Kecualikan ID yang sedang diupdate
    }

    if ($query->exists()) {
        $errors['name'] = ['Name Agent Already Exist.'];
    }

    return $errors;
}
}
