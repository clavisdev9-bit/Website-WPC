<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactModel extends Model
{
    // old code maintenance rumit
    // use HasFactory;
    // protected $table = 'contacts';
    // protected $primaryKey = 'id';
    // public    $incrementing = true;
    // public    $timestamps = true;
    // protected $fillable = ['contact_id', 'name', 'street',
    // 'street2','city','zip','npwp','your_business','job_position',
    // 'phone','mobile','email','website','title','language','company_type'];

    // new code lebih simple
     use HasFactory;
         protected $table = 'contacts';

    protected $fillable = [
        'id',
        'contact_id',
        'name',
        'street',
        'street2',
        'city',
        'zip',
        'npwp',
        'your_business',
        'job_position',
        'phone',
        'mobile',
        'email',
        'website',
        'title',
        'language',
        'company_type',
    ];

    // Laravel secara default pakai auto-increment, padahal id kita dari API
    public $incrementing = false;

    protected $keyType = 'int';

    // Relasi ke country
 public function countries()
{
    return $this->hasMany(ContactCountryModel::class, 'contact_id');
}

public function states()
{
    return $this->hasMany(ContactStateModel::class, 'contact_id');
}

public function tags()
{
    return $this->hasMany(ContactTagModel::class, 'contact_id');
}

}
