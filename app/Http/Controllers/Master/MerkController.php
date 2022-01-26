<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class MerkController extends Controller
{
    // Harus Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    // tampil merk
    public function index()
    {
        $merks = DB::table('bmn_master_merk')
        ->orderby('nama_merk', 'asc')
        ->get();

        return view('page.master.merk')
        ->with('merks',$merks);
    }

    // tambah merk
    public function tambahMerk(Request $merk)
    {
        $nama     = $merk -> nama_merk;

        DB::table('bmn_master_merk')
        ->insert([
            'nama_merk'     => $nama,
        ]);

        Session::flash('success', 'Merk '.$nama.' berhasil ditambahkan');
        return redirect()->back();
    }

    // edit merk
    public function editMerk(Request $merk)
    {
        $id   = $merk -> id_merk;
        $nama = $merk -> nama_merk;

        DB::table('bmn_master_merk')
        ->where('id_merk', $id)
        ->update([
            'nama_merk'     => $nama,
        ]);

        Session::flash('success', 'Data merk '.$nama.' berhasil diedit');
        return redirect()->back();
    }

    // show merk
    public function showMerk(Request $merk)
    {
        $id   = $merk -> id_merk;
        $nama = $merk -> nama_merk;
        $show = $merk -> show_merk;

        DB::table('bmn_master_merk')
        ->where('id_merk', $id)
        ->update([
            'is_show'     => $show,
        ]);

        DB::table('bmn_master_type')
        ->where('id_merk', $id)
        ->update([
            'is_show'     => $show,
        ]);

        if($show==0){
            $msg = 'Data merk '.$nama.' disembunyikan';
        }

        else{
            $msg = 'Data merk '.$nama.' ditampilkan';
        }

        return response()->json(['msg'=>$msg]);
    }
}
