<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContactSyncLogModel extends Model
{
   use HasFactory;
protected $table = 'contact_sync_logs';

    protected $fillable = [
        'sync_time',
        'total_records',
        'status',
        'message',
    ];
}
