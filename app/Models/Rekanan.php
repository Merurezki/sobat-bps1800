<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekanan extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table      = 'bmn_master_rekanan';
    protected $primaryKey = 'id_rekanan';

    protected $fillable = [
        'nama_rekanan',
        'alamat_rekanan',
        'contact_person',
        'no_contact_person',
    ];
}
