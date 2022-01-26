<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'users_role';
    protected $primaryKey = 'id_role';

    protected $fillable = [
        'nama_role',
    ];

    public function userSobat() {
        return $this->belongsToMany('App\Models\UserSobat', 'id_role', 'role');
    }
}
