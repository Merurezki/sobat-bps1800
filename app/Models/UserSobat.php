<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSobat extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $fillable = [
        'role',
        'ruang',
        'pj_ruang',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'id', 'id');
    }

    public function role() {
        return $this->belongsTo('App\Models\Role', 'role', 'id_role');
    }

    public function ruang() {
        return $this->belongsTo('App\Models\Ruang', 'ruang', 'kode_ruangan');
    }
}
