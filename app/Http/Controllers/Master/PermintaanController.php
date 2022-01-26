<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermintaanController extends Controller
{
    // Harus Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    // tampil permintaan
    public function index()
    {
        $permintaans = DB::table('bmn_master_permintaan')
        ->leftjoin('bmn_master_kategori_permintaan','bmn_master_permintaan.id_kategori_permintaan','=','bmn_master_kategori_permintaan.id_kategori_permintaan')
        ->orderby('bmn_master_permintaan.id_kategori_permintaan', 'asc')
        ->orderby('nama_permintaan', 'asc')
        ->get();

        $kat_permintaans = DB::table('bmn_master_kategori_permintaan')
        ->orderby('id_kategori_permintaan', 'asc')
        ->get();

        return view('page.master.permintaan')
        ->with('permintaans',$permintaans)
        ->with('kat_permintaans',$kat_permintaans);
    }

    // tambah permintaan
    public function tambahPermintaan(Request $permintaan)
    {
        $id_kategori = $permintaan -> id_kategori_permintaan;
        $nama        = $permintaan -> nama_permintaan;

        DB::table('bmn_master_permintaan')
        ->insert([
            'id_kategori_permintaan' => $id_kategori,
            'nama_permintaan'        => $nama,
        ]);

        Session::flash('success', 'Permintaan '.$nama.' berhasil ditambahkan');
        return redirect()->back();
    }

    // edit permintaan
    public function editPermintaan(Request $permintaan)
    {
        $id_permintaan = $permintaan -> id_permintaan;
        $id_kategori   = $permintaan -> id_kategori_permintaan;
        $nama          = $permintaan -> nama_permintaan;

        DB::table('bmn_master_permintaan')
        ->where('id_permintaan', $id_permintaan)
        ->update([
            'id_kategori_permintaan' => $id_kategori,
            'nama_permintaan'        => $nama,
        ]);

        Session::flash('success', 'Data permintaan '.$nama.' berhasil diedit');
        return redirect()->back();
    }

    // show merk
    public function showPermintaan(Request $permintaan)
    {
        $id   = $permintaan -> id_permintaan;
        $nama = $permintaan -> nama_permintaan;
        $show = $permintaan -> show_permintaan;

        DB::table('bmn_master_permintaan')
        ->where('id_permintaan', $id)
        ->update([
            'is_show'     => $show,
        ]);

        DB::table('bmn_master_type')
        ->where('id_permintaan', $id)
        ->update([
            'is_show'     => $show,
        ]);

        if($show==0){
            $msg = 'Data permintaan '.$nama.' disembunyikan';
        }

        else{
            $msg = 'Data permintaan '.$nama.' ditampilkan';
        }

        return response()->json(['msg'=>$msg]);
    }
}
