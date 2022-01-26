<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruang extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'bmn_master_ruangan';
    protected $primaryKey = 'kode_ruangan';

    protected $fillable = [
        'nama_ruangan',
        'pj_ruangan',
    ];

    public function userSobat() {
        return $this->belongsToMany('App\Models\UserSobat', 'kode_ruangan', 'ruang');
    }
}
