<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $table = 'table_device';
    protected $fillable = ['id','device_name','device_kelas','device_uid','device_date','device_mode','is_active','created_by','updated_by','created_at','updated_at','deleted_at'];
}
