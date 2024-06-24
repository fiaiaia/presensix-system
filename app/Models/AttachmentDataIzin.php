<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttachmentDataIzin extends Model
{
    use HasFactory;

    protected $table = 'attachment_bukti_izin';
    protected $fillable = ['id','ticket_id', 'name','created_by','updated_by','deleted_at','is_active','created_at','updated_at'];

}
