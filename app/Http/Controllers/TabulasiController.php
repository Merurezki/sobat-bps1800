<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TabulasiController extends Controller
{
    // HARUS LOGIN
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function gantiBulanTahun(Request $bulanTahun)
    {
        $bulan = date('m', strtotime($bulanTahun -> bulan_tahun_tabulasi));
        $tahun = date('Y', strtotime($bulanTahun -> bulan_tahun_tabulasi));
        if (Auth::user()->userSobat->role == 1){
            return redirect('admin/tabulasi/'.$tahun.'/'.$bulan.'');
        }
        else if (Auth::user()->userSobat->role == 2){
            return redirect('ipds/tabulasi/'.$tahun.'/'.$bulan.'');
        }
    }

    public function index($tahun,$bulan)
    {
        $monYears = $tahun.'-'.$bulan;
        $monYears = date('Y-m', strtotime($monYears));

        $permintaans = DB::table('bmn_master_permintaan')
        ->leftjoin('bmn_master_kategori_permintaan','bmn_master_permintaan.id_kategori_permintaan','=','bmn_master_kategori_permintaan.id_kategori_permintaan')
        ->orderBy('bmn_master_kategori_permintaan.id_kategori_permintaan', 'asc')
        ->orderBy('bmn_master_permintaan.nama_permintaan', 'asc')
        ->get();

        $statuss = DB::table('bmn_master_status')
        ->get();

        $fungsis = DB::table('ckpt6832_pegawai.m_fungsi')
        ->whereNotIn('id', [0,8])
        ->get();

        foreach($permintaans as $i => $permintaan){
            $jumlahByPermintaan[$i+1] = DB::table('bmn_keluhan')
            ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->where('id_permintaan',$permintaan->id_permintaan)
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
            ->count();
        }

        foreach($statuss as $i => $status){
            $jumlahByStatus[$i+1] = DB::table('bmn_keluhan')
            ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->where('id_status',$status->id_status)
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
            ->count();
        }

        foreach($fungsis as $i => $fungsi){
            $jumlahByFungsi[$i+1] = DB::table('bmn_keluhan')
            ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
            ->where('m_sub_fungsi.id_fungsi',$fungsi->id)
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
            ->count();
        }

        return view('page.tabulasi')
        ->with('monYears', $monYears)
        ->with('permintaans', $permintaans)
        ->with('statuss', $statuss)
        ->with('fungsis', $fungsis)
        ->with('jumlahByPermintaan', $jumlahByPermintaan)
        ->with('jumlahByStatus', $jumlahByStatus)
        ->with('jumlahByFungsi', $jumlahByFungsi);
    }
}
