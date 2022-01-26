<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'bmn_keluhan';
    protected $primaryKey = 'id_keluhan';

    protected $fillable = [
        'id_permintaan',
        'permintaan_lainnya',
        'id_type',
        'type_lainnya',
        'id_pemegang_bmn',
        'masalah',
        'id_status',
        'id_umum',
        'catatan_umum',
        'id_ipds',
        'catatan_ipds',
        'id_rekanan',
        'catatan_rekanan',
        'tgl_approve_pj',
        'tgl_approve_umum',
        'tgl_proses_ipds',
        'tgl_kirim_rekanan',
        'tgl_selesai',
        'tgl_diambil',
        'biaya',
    ];
}
