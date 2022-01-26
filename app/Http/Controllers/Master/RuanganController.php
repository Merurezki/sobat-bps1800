<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RuanganController extends Controller
{
    // Harus Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    // tampil ruangan
    public function index()
    {
        $ruangans = DB::table('bmn_master_ruangan')
        ->leftjoin('users','bmn_master_ruangan.pj_ruangan','=','users.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id','=','m_pegawai.id')
        ->select('*','bmn_master_ruangan.is_show as is_show', 'users.id as id_user')
        ->orderby('kode_ruangan', 'asc')
        ->get();

        $pegawais = DB::table('users')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id','=','m_pegawai.id')
        ->select('*', 'users.id as id_user')
        ->where('users.pj_ruang',0)
        ->orderby('m_pegawai.nama', 'asc')
        ->get();

        return view('page.master.ruangan')
        ->with('ruangans',$ruangans)
        ->with('pegawais',$pegawais);
    }

    // tambah ruangan
    public function tambahRuangan(Request $ruangan)
    {
        $kode = $ruangan -> kode_ruangan;
        $nama = $ruangan -> nama_ruangan;
        $pj   = $ruangan -> pj_ruangan;

        if(DB::table('bmn_master_ruangan')->where('kode_ruangan', $kode)->count() > 0){
            $id = 'fail';
            $msg = 'Kode ruangan '.$kode.' sudah terdaftar';
            return response()->json(['msg'=>$msg,'id'=>$id]);
        }

        else{
            DB::table('bmn_master_ruangan')
            ->insert([
                'kode_ruangan'  => $kode,
                'nama_ruangan'  => $nama,
                'pj_ruangan'    => $pj,
            ]);

            DB::table('users')
            ->where('id', $pj)
            ->update([
                'pj_ruang' => 1,    
            ]);

            $id = 'success';
            $msg = 'Ruangan '.$nama.' berhasil ditambahkan';
            return response()->json(['msg'=>$msg,'id'=>$id]);

            // Session::flash('success', 'Ruangan '.$nama.' berhasil ditambahkan');
            // return redirect()->back();
        }
    }

    // edit ruangan
    public function editRuangan(Request $ruangan)
    {
        $kode_lama = $ruangan -> kode_ruangan_lama;
        $kode_baru = $ruangan -> kode_ruangan_baru;
        $nama      = $ruangan -> nama_ruangan;
        $pj_lama   = $ruangan -> pj_ruangan_lama;
        $pj_baru   = $ruangan -> pj_ruangan_baru;

        DB::table('bmn_master_ruangan')
        ->where('kode_ruangan', $kode_lama)
        ->update([
            'kode_ruangan'  => $kode_baru,
            'nama_ruangan'  => $nama,
            'pj_ruangan'    => $pj_baru,
        ]);

        DB::table('users')
        ->where('id', $pj_lama)
        ->update([
            'pj_ruang' => 0,    
        ]);

        DB::table('users')
        ->where('id', $pj_baru)
        ->update([
            'pj_ruang' => 1,    
        ]);

        Session::flash('success', 'Data ruangan '.$nama.' berhasil diedit');
        return redirect()->back();
    }

    // show ruangan
    public function showRuangan(Request $ruangan)
    {
        $id   = $ruangan -> kode_ruangan;
        $nama = $ruangan -> nama_ruangan;
        $show = $ruangan -> show_ruangan;

        DB::table('bmn_master_ruangan')
        ->where('kode_ruangan', $id)
        ->update([
            'is_show'     => $show,
        ]);

        if($show==0){
            $msg = 'Data ruangan '.$nama.' disembunyikan';
        }

        else{
            $msg = 'Data ruangan '.$nama.' ditampilkan';
        }
        
        return response()->json(['msg'=>$msg]);
    }
}
