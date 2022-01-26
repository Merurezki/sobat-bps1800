<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RekananController extends Controller
{
    // Harus Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    // tampil rekanan
    public function index()
    {
        $rekanans = DB::table('bmn_master_rekanan')
        ->orderby('nama_rekanan', 'asc')
        ->get();

        return view('page.master.rekanan')
        ->with('rekanans',$rekanans);
    }

    // tambah rekanan
    public function tambahRekanan(Request $rekanan)
    {
        $nama   = $rekanan -> nama_rekanan;
        $alamat = $rekanan -> alamat_rekanan;
        $cp     = $rekanan -> contact_person;
        $no_cp  = $rekanan -> no_contact_person;

        DB::table('bmn_master_rekanan')
        ->insert([
            'nama_rekanan'      => $nama,
            'alamat_rekanan'    => $alamat,
            'contact_person'    => $cp,
            'no_contact_person' => $no_cp,
        ]);

        Session::flash('success', 'Rekanan '.$nama.' berhasil ditambahkan');
        return redirect()->back();
    }

    // edit rekanan
    public function editRekanan(Request $rekanan)
    {
        $id     = $rekanan -> id_rekanan;
        $nama   = $rekanan -> nama_rekanan;
        $alamat = $rekanan -> alamat_rekanan;
        $cp     = $rekanan -> contact_person;
        $no_cp  = $rekanan -> no_contact_person;

        DB::table('bmn_master_rekanan')
        ->where('id_rekanan', $id)
        ->update([
            'nama_rekanan'      => $nama,
            'alamat_rekanan'    => $alamat,
            'contact_person'    => $cp,
            'no_contact_person' => $no_cp,
        ]);

        Session::flash('success', 'Data rekanan '.$nama.' berhasil diedit');
        return redirect()->back();
    }

    // show rekanan
    public function showRekanan(Request $rekanan)
    {
        $id   = $rekanan -> id_rekanan;
        $nama = $rekanan -> nama_rekanan;
        $show = $rekanan -> show_rekanan;

        DB::table('bmn_master_rekanan')
        ->where('id_rekanan', $id)
        ->update([
            'is_show'     => $show,
        ]);

        if($show==0){
            $msg = 'Data rekanan '.$nama.' disembunyikan';
        }

        else{
            $msg = 'Data rekanan '.$nama.' ditampilkan';
        }
        
        return response()->json(['msg'=>$msg]);
    }
}
