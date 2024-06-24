<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterHoliday extends Model
{
    use HasFactory;

    protected $table = 'master_holidays';
    protected $fillable = [
        'id',
        'date',
        'is_active',
        'description',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
