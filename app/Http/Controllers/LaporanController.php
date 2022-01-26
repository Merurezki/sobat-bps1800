<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    // Harus Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show another month
    public function gantiBulan(Request $bulanLaporan)
    {
        $bulan = date('m', strtotime($bulanLaporan -> bulan_laporan));
        $tahun = date('Y', strtotime($bulanLaporan -> bulan_laporan));
        
        if (Auth::user()->userSobat->role == 1){
            return redirect('admin/laporan/'.$tahun.'/'.$bulan.'/0');
        }
        else if (Auth::user()->userSobat->role == 2){
            return redirect('ipds/laporan/'.$tahun.'/'.$bulan.'/0');
        }
    }

    // show another status
    public function gantiStatus(Request $statusLaporan)
    {
        $bulan = date('m', strtotime($statusLaporan -> bulan_laporan));
        $tahun = date('Y', strtotime($statusLaporan -> bulan_laporan));
        $id_status = $statusLaporan -> id_status;        

        if (Auth::user()->userSobat->role == 1){
            return redirect('admin/laporan/'.$tahun.'/'.$bulan.'/'.$id_status.'');
        }
        else if (Auth::user()->userSobat->role == 2){
            return redirect('ipds/laporan/'.$tahun.'/'.$bulan.'/'.$id_status.'');
        }
    }

    public function index($tahun, $bulan, $status)
    {
        $monYears = $tahun.'-'.$bulan;
        $monYears = date('Y-m', strtotime($monYears));

        // $month = date('m', strtotime($monYears));
        // $year  = date('Y', strtotime($monYears));

        if($status == 0){
            $id_status = [1,2,3,4,5,6,7,8,9];
        }else{
            $id_status = [$status];
        }

        $keluhans = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('bmn_master_permintaan','bmn_keluhan.id_permintaan','=','bmn_master_permintaan.id_permintaan')
        ->leftjoin('bmn_master_kategori_permintaan','bmn_master_permintaan.id_kategori_permintaan','=','bmn_master_kategori_permintaan.id_kategori_permintaan')
        ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
		->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
        ->leftjoin('bmn_master_rekanan','bmn_master_rekanan.id_rekanan','=','bmn_keluhan.id_rekanan')

        ->leftjoin('users as u1','bmn_grup_keluhan.id_pelapor','=','u1.id')
        ->leftjoin('ckpt6832_pegawai.m_user as s1','u1.id','=','s1.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as p1','s1.id_pegawai','=','p1.id')

        ->leftjoin('users as u2','bmn_keluhan.id_pemegang_bmn','=','u2.id')
        ->leftjoin('ckpt6832_pegawai.m_user as s2','u2.id','=','s2.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as p2','s2.id_pegawai','=','p2.id')

        ->leftjoin('users as u3','bmn_keluhan.id_umum','=','u3.id')
        ->leftjoin('ckpt6832_pegawai.m_user as s3','u3.id','=','s3.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as p3','s3.id_pegawai','=','p3.id')

        ->leftjoin('users as u4','bmn_keluhan.id_ipds','=','u4.id')
        ->leftjoin('ckpt6832_pegawai.m_user as s4','u4.id','=','s4.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as p4','s4.id_pegawai','=','p4.id')
        
		->select('*', 'p1.nama as pelapor', 'p2.nama as pemegang_bmn', 'p3.nama as umum', 'p4.nama as ipds')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereIn('bmn_keluhan.id_status',$id_status)
        ->orderby('bmn_grup_keluhan.tgl_laporan', 'desc')
        ->get();

        $statuss = DB::table('bmn_master_status')
        ->get();

        return view('page.laporan')
        ->with('statuss', $statuss)
        ->with('keluhans', $keluhans)
        ->with('monYears', $monYears)
        ->with('id_status', $status);
    }

    public function cetakBulanan(Request $bulan)
    {
        $monYears = date('Y-m', strtotime($bulan -> bulan_laporan));

        $month = date('m', strtotime($monYears));
        $year  = date('Y', strtotime($monYears));

        $keluhans = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('bmn_master_permintaan','bmn_keluhan.id_permintaan','=','bmn_master_permintaan.id_permintaan')
        ->leftjoin('bmn_master_kategori_permintaan','bmn_master_permintaan.id_kategori_permintaan','=','bmn_master_kategori_permintaan.id_kategori_permintaan')
        ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
		->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')

        ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
        ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
        ->leftjoin('ckpt6832_pegawai.m_fungsi as m_fungsi','m_sub_fungsi.id_fungsi','=','m_fungsi.id')
        
		->select('*', 'm_fungsi.nama as nama_fungsi', 'm_pegawai.nama as pelapor')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$year)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$month)
        ->orderby('bmn_grup_keluhan.tgl_laporan', 'asc')
        ->get();

        $statuss = DB::table('bmn_master_status')
        ->get();
 
        return view('template.laporan_bulanan')
        ->with('statuss', $statuss)
        ->with('keluhans', $keluhans)
        ->with('monYears', $monYears);
    }

    public function cetakKeluhan(Request $keluhan)
    {
        $id = $keluhan -> id_keluhan;

        $statuss = DB::table('bmn_master_status')
        ->get();

        $keluhans = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('bmn_master_permintaan','bmn_keluhan.id_permintaan','=','bmn_master_permintaan.id_permintaan')
        ->leftjoin('bmn_master_kategori_permintaan','bmn_master_permintaan.id_kategori_permintaan','=','bmn_master_kategori_permintaan.id_kategori_permintaan')
        ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
		->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
        ->leftjoin('bmn_master_rekanan','bmn_keluhan.id_rekanan','=','bmn_master_rekanan.id_rekanan')

        ->leftjoin('users as u1','bmn_grup_keluhan.id_pelapor','=','u1.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user1','u1.id','=','m_user1.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai1','m_user1.id_pegawai','=','m_pegawai1.id')
        ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi1','m_pegawai1.id_sub_fungsi','=','m_sub_fungsi1.id')
        ->leftjoin('ckpt6832_pegawai.m_fungsi as m_fungsi1','m_sub_fungsi1.id_fungsi','=','m_fungsi1.id')
        ->leftjoin('bmn_master_ruangan','u1.ruang','=','bmn_master_ruangan.kode_ruangan')

        ->leftjoin('users as u2','bmn_master_ruangan.pj_ruangan','=','u2.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user2','u2.id','=','m_user2.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai2','m_user2.id_pegawai','=','m_pegawai2.id')

        ->leftjoin('users as u3','bmn_keluhan.id_pemegang_bmn','=','u3.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user3','u3.id','=','m_user3.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai3','m_user3.id_pegawai','=','m_pegawai3.id')

        ->leftjoin('users as u4','bmn_keluhan.id_umum','=','u4.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user4','u4.id','=','m_user4.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai4','m_user4.id_pegawai','=','m_pegawai4.id')

        ->leftjoin('users as u5','bmn_keluhan.id_ipds','=','u5.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user5','u5.id','=','m_user5.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai5','m_user5.id_pegawai','=','m_pegawai5.id')

		->select('*', 'm_fungsi1.nama as nama_fungsi',
                    'm_pegawai1.nama as pelapor', 'm_pegawai1.nip_baru as nip_pelapor',
                    'm_pegawai2.nama as pj_ruang', 'm_pegawai2.nip_baru as nip_pj_ruang',
                    'm_pegawai3.nama as pemegang_bmn', 'm_pegawai3.nip_baru as nip_pemegang_bmn',
                    'm_pegawai4.nama as umum', 'm_pegawai4.nip_baru as nip_umum',
                    'm_pegawai5.nama as ipds', 'm_pegawai5.nip_baru as nip_ipds',)
        ->where('bmn_keluhan.id_keluhan', $id)
        ->get();
 
        return view('template.laporan_keluhan')
        ->with('statuss', $statuss)
        ->with('keluhans', $keluhans);
    }
}
