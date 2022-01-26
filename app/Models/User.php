<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $connection = 'mysql2';
    protected $table      = 'm_user';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_pegawai',
        'id_user_level',
        'username',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function getAuthPassword()
    {
        return $this->attributes['password'];
    }

    public function userSobat() {
        return $this->belongsTo('App\Models\UserSobat', 'id', 'id');
    }

    public function pegawai() {
        return $this->belongsTo('App\Models\Pegawai', 'id_pegawai', 'id');
    }
}
