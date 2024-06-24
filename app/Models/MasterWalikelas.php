<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterWalikelas extends Model
{
    protected $table = 'master_walikelas';

    protected $fillable = [
        'id',
        'id_walikelas',
        'id_kelas',
        'is_active',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
