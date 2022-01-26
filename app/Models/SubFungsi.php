<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFungsi extends Model
{
    use HasFactory;

    protected $connection = 'mysql2';
    protected $table      = 'm_sub_fungsi';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_fungsi',
        'nama',
        'alias',
        'id_group_wilayah',
    ];

    public function pegawai() {
        return $this->belongsToMany('App\Models\Pegawai', 'id', 'id_sub_fungsi');
    }
}
