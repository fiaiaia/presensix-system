<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class AllData extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'all_data';
    protected $fillable = [
        'credential_number',
        'name',
        'class',
        'position',
        'birthdate',
        'status',
        'no_telp',
        'nama_ortu_siswa',
        'no_telp_ortu',
        'device_id',
        'device_uid',
        'add_fingerid',
        'del_fingerid',
        'fingerprint_id',
        'fingerprint_select',
        'created_at',
        'updated_at',
        'deleted_at',
        'no_telp_tendik',
        'jenis_kelamin'
    ];
}
