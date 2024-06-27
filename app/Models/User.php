<?php

// User.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'created_at',
        'updated_at',
        'credential_number',
        'kelas_id',
        'deleted_at',
        'position',
        'fingerprint_id',
        'add_fingerid',
        'no_telp',
        'nama_ortu_siswa',
        'no_telp_ortu',
        'jenis_kelamin'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Define the relationship to get the user's roles
    public function userRoles()
    {
        return $this->belongsToMany(Role::class, 'model_has_roles', 'model_id', 'role_id')
                    ->where('model_type', User::class);
    }

    public function dataPerizinan()
    {
        return $this->hasMany(DataPerizinan::class, 'created_by');
    }

    public function userLogs()
    {
        return $this->hasMany(UserLog::class, 'user_id');
    }
}
?>
