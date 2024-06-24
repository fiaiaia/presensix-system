<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataIzinLogs extends Model
{
    use HasFactory;

    protected $table = 'data_perizinan_logs';
    protected $fillable = ['id','ticket_id','status','description','created_by','updated_by','is_active','created_at','updated_at'];

}
