<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactStateModel extends Model
{
    //  use HasFactory;
    // protected $table = 'contact_states';
    // protected $primaryKey = 'id';
    // public    $incrementing = true;
    // public    $timestamps = true;
    // protected $fillable = ['contact_id', 'state_id', 'state_name'];
    use HasFactory;
    protected $table = 'contact_states';
    protected $fillable = [
        'contact_id',
        'state_id',
        'state_name',
    ];

    public function contact()
    {
        return $this->belongsTo(ContactModel::class);
    }
}
