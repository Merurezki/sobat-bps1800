<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table      = 'm_pegawai';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama',
        'nip_baru',
        'nip_lama',
        'email_bps',
        'id_golongan_pangkat',
        'id_sub_fungsi',
        'id_struktural',
        'id_fungsional',
        'id_jenjang_fungsional',
        'id_wilayah',
        'id_status_pegawai',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'id', 'id_pegawai');
    }

    public function subFungsi() {
        return $this->belongsTo('App\Models\SubFungsi', 'id_sub_fungsi', 'id');
    }
}
