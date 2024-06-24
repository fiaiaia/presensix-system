<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterKelas extends Model
{
    protected $table = 'master_kelas';
    protected $fillable = ['id','kelas','tahun_ajar','created_at','updated_at','deleted_at'];
}
