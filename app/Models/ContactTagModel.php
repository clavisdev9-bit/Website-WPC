<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactTagModel extends Model
{
    // use HasFactory;
    // protected $table = 'contact_tags';
    // protected $primaryKey = 'id';
    // public    $incrementing = true;
    // public    $timestamps = true;
    // protected $fillable = ['contact_id', 'tag_id', 'tag_name'];
     use HasFactory;
    protected $table = 'contact_tags';
    protected $fillable = [
        'contact_id',
        'tag_id',
        'tag_name',
    ];

    public function contact()
    {
        return $this->belongsTo(ContactModel::class);
    }
}
