<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class DataPerizinan extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'data_perizinan';
    protected $fillable = ['id','kode_izin','id_kelas','id_wali_kelas','waktu_izin','status_izin','description','status_dokumen','approval_walikelas','approval_guru_bk','approval_data_walikelas','approval_data_guru_bk','created_by','updated_by','deleted_at','is_active','created_at','updated_at'];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
