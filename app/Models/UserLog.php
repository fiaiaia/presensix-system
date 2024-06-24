<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use HasFactory;

    protected $table = 'user_log';
    protected $fillable = [
        'id',
        'name',
        'credential_number',
        'fingerprint_id',
        'device_uid',
        'device_kelas',
        'checkindate',
        'timein',
        'timeout',
        'fingerout',
        'created_at',
        'updated_at',
        'user_id',
        'remark'
    ];

    protected $dates = ['checkindate'];
}
