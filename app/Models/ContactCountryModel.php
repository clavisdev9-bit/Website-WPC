<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactCountryModel extends Model
{
    // use HasFactory;
    // protected $table = 'contact_countries';
    // protected $primaryKey = 'id';
    // public    $incrementing = true;
    // public    $timestamps = true;
    // protected $fillable = ['contact_id', 'country_id', 'country_name'];

    use HasFactory;
    protected $table = 'contact_countries';
    protected $fillable = [
        'contact_id',
        'country_id',
        'country_name',
    ];

    public function contact()
    {
        return $this->belongsTo(ContactModel::class);
    }
}
