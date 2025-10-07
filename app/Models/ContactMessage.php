<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactMessage extends Model
{
    use HasFactory;
    protected $table = 'contact_messages';
    protected $primaryKey = 'id';
    public    $incrementing = true;
    public    $timestamps = true;
    protected $fillable = ['name', 'email', 'phone', 'interested_in',
     'subject','message','agree_privacy'];
}
