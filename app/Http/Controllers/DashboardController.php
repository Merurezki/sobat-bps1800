<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // HARUS LOGIN
    public function __construct()
    {
        $this->middleware('auth');
    }

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // BULAN
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function gantiBulan(Request $bulanDashboard)
    {
        $bulan = date('m', strtotime($bulanDashboard -> bulan_dashboard));
        $tahun = date('Y', strtotime($bulanDashboard -> bulan_dashboard));
        return redirect('dashboard/'.$tahun.'/'.$bulan.'');
    }

    public function bulan($tahun,$bulan)
    {
        $monYears = $tahun.'-'.$bulan;
        $monYears = date('Y-m', strtotime($monYears));

        $fungsis = DB::table('ckpt6832_pegawai.m_fungsi')
        ->whereIn('id',[1,2,3,4,5,6,7])
        ->get();

        $permintaans = DB::table('bmn_master_permintaan')
        ->where('id_kategori_permintaan', 1)
        ->orderBy('nama_permintaan', 'asc')
        ->get();

        $merks = DB::table('bmn_master_merk')
        ->orderBy('nama_merk', 'asc')
        ->get();

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan kartu rangkuman
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $card = [];
        
        // jumlah unit yang telah di-approve
        $card[10] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereNotIn('id_status',[1,2,3])
        ->count();

        // jumlah unit yang sedang diproses
        $card[20] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereIn('id_status',[4,5,6])
        ->count();

        // jumlah unit yang telah selesai
        $card[30] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereIn('id_status',[7,8,9])
        ->count();

        // jumlah unit yang ditolak
        $card[11] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereIn('id_status',[1])
        ->count();

        // jumlah unit belum di-approve
        $card[12] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereIn('id_status',[2,3])
        ->count();

        // jumlah unit yang sudah di-approve
        $card[13] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereNotIn('id_status',[1,2,3])
        ->count();

        // jumlah unit masuk ipds tapi belum diproses
        $card[21] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereIn('id_status',[4])
        ->count();

        // jumlah unit sedang dicek ipds
        $card[22] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereIn('id_status',[5])
        ->count();

        // jumlah unit sedang di rekanan
        $card[23] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereIn('id_status',[6])
        ->count();

        // jumlah unit selesai di ipds
        $card[31] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereIn('id_status',[7])
        ->count();

        // jumlah unit selesai di umum
        $card[32] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereIn('id_status',[8])
        ->count();

        // jumlah unit sudah diambil pemegang bmn
        $card[33] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
        ->whereIn('id_status',[9])
        ->count();

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan tabel rangkuman dan bar chart
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $rusakF = [];
        $prosesF = [];
        $selesaiF = [];

        for($i=1; $i<=7; $i++){
			$rusakF[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
            ->where('m_sub_fungsi.id_fungsi',$i)
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
            ->whereNotIn('id_status',[1,2,3])
			->count();

            $prosesF[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
            ->where('m_sub_fungsi.id_fungsi',$i)
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
            ->whereNotIn('id_status',[1,2,3,7,8,9])
			->count();

            $selesaiF[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
            ->where('m_sub_fungsi.id_fungsi',$i)
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
            ->whereIn('id_status',[7,8,9])
			->count();
		}

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan pie chart 1
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $permintaanX = [];

        foreach($permintaans as $i => $permintaan){
            $permintaanX[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->where('id_permintaan',$permintaan->id_permintaan)
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
            ->whereNotIn('id_status',[1,2,3])
			->count();
        }

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan pie chart 2
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $merkX = [];

        foreach($merks as $i => $merk){
            $merkX[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
            ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
            ->where('bmn_master_merk.id_merk',$merk->id_merk)
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
            ->whereNotIn('id_status',[1,2,3])
			->count();
        }

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan bubble chart 1
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $pegawais = [];
        $pegawaiX = [];

        foreach($fungsis as $i => $fungsi){
            $pegawais[$i] = DB::table('users')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
            ->select('*', 'users.id as id', 'm_pegawai.nama as nama_pegawai')
            ->where('m_sub_fungsi.id_fungsi', $fungsi->id)
            ->get();

            foreach($pegawais[$i] as $j => $pegawai){
                $pegawaiX[$i][$j] = DB::table('bmn_keluhan')
                ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
                ->leftjoin('bmn_master_permintaan','bmn_keluhan.id_permintaan','=','bmn_master_permintaan.id_permintaan')
                ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
                ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
                ->whereNotIn('id_status',[1,2,3])
                ->where('bmn_master_permintaan.id_kategori_permintaan',1)
                ->where('bmn_grup_keluhan.id_pelapor',$pegawai->id)
                ->count();
            }
        }

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan bubble chart 2
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $types = [];
        $typeX = [];

        foreach($permintaans as $i => $permintaan){
            $types[$i] = DB::table('bmn_master_type')
            ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
            ->where('id_permintaan', $permintaan->id_permintaan)
            ->get();

            foreach($types[$i]->unique('id_merk') as $j => $type){
                $typeX[$i][$j] = DB::table('bmn_keluhan')
                ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
                ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
                ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
                ->where('bmn_keluhan.id_type',$type->id_type)
                ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
                ->whereMonth('bmn_grup_keluhan.tgl_laporan',$bulan)
                ->whereNotIn('id_status',[1,2,3])
                ->count();
            }
        }

        return view('page.dashboard_bulan')
        ->with('monYears', $monYears)
        ->with('card', $card)
        ->with('fungsis', $fungsis)
        ->with('rusakF', $rusakF)
        ->with('prosesF', $prosesF)
        ->with('selesaiF', $selesaiF)
        ->with('permintaans', $permintaans)
        ->with('permintaanX', $permintaanX)
        ->with('merks', $merks)
        ->with('merkX', $merkX)
        ->with('pegawais', $pegawais)
        ->with('pegawaiX', $pegawaiX)
        ->with('types', $types)
        ->with('typeX', $typeX);
    }

    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // TAHUN
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function gantiTahun(Request $tahunDashboard)
    {
        $tahun = date('Y', strtotime($tahunDashboard -> tahun_dashboard.' January'));
        return redirect('dashboard/'.$tahun.'');
    }

    public function tahun($tahun)
    {
        $years = $tahun.'-01';
        $years = date('Y', strtotime($years));

        $fungsis = DB::table('ckpt6832_pegawai.m_fungsi')
        ->whereIn('id',[1,2,3,4,5,6,7])
        ->get();

        $permintaans = DB::table('bmn_master_permintaan')
        ->where('id_kategori_permintaan', 1)
        ->orderBy('nama_permintaan', 'asc')
        ->get();

        $merks = DB::table('bmn_master_merk')
        ->orderBy('nama_merk', 'asc')
        ->get();

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan kartu rangkuman
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $card = [];
        
        // jumlah unit yang telah di-approve
        $card[10] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereNotIn('id_status',[1,2,3])
        ->count();

        // jumlah unit yang sedang diproses
        $card[20] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereNotIn('id_status',[1,2,3,7,8,9])
        ->count();

        // jumlah unit yang telah selesai
        $card[30] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereIn('id_status',[7,8,9])
        ->count();

        // jumlah unit yang ditolak
        $card[11] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereIn('id_status',[1])
        ->count();

        // jumlah unit belum di-approve
        $card[12] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereIn('id_status',[2,3])
        ->count();

        // jumlah unit yang sudah di-approve
        $card[13] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereNotIn('id_status',[1,2,3])
        ->count();

        // jumlah unit masuk ipds tapi belum diproses
        $card[21] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereIn('id_status',[4])
        ->count();

        // jumlah unit sedang dicek ipds
        $card[22] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereIn('id_status',[5])
        ->count();

        // jumlah unit sedang di rekanan
        $card[23] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereIn('id_status',[6])
        ->count();

        // jumlah unit selesai di ipds
        $card[31] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereIn('id_status',[7])
        ->count();

        // jumlah unit selesai di umum
        $card[32] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereIn('id_status',[8])
        ->count();

        // jumlah unit sudah diambil pemegang bmn
        $card[33] = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
        ->whereIn('id_status',[9])
        ->count();

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan tabel rangkuman dan bar chart
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $rusakF = [];
        $prosesF = [];
        $selesaiF = [];

        for($i=1; $i<=7; $i++){
			$rusakF[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
            ->where('m_sub_fungsi.id_fungsi',$i)
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereNotIn('id_status',[1,2,3])
			->count();

            $prosesF[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
            ->where('m_sub_fungsi.id_fungsi',$i)
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereNotIn('id_status',[1,2,3,7,8,9])
			->count();

            $selesaiF[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
            ->where('m_sub_fungsi.id_fungsi',$i)
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereIn('id_status',[7,8,9])
			->count();
		}

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan area chart
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $rusakB = [];
        $prosesB = [];
        $selesaiB = [];

        for($i=1; $i<=12; $i++){
			$rusakB[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereMonth('bmn_grup_keluhan.tgl_laporan',$i)
            ->whereNotIn('id_status',[1,2,3])
			->count();

            $prosesB[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereMonth('bmn_grup_keluhan.tgl_laporan',$i)
            ->whereNotIn('id_status',[1,2,3,7,8,9])
			->count();

            $selesaiB[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereMonth('bmn_grup_keluhan.tgl_laporan',$i)
            ->whereIn('id_status',[7,8,9])
			->count();
		}

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan pie chart 1
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $permintaanX = [];

        foreach($permintaans as $i => $permintaan){
            $permintaanX[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereNotIn('id_status',[1,2,3])
            ->where('id_permintaan',$permintaan->id_permintaan)
			->count();
        }

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan pie chart 2
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $merkX = [];

        foreach($merks as $i => $merk){
            $merkX[$i] = DB::table('bmn_keluhan')
			->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
            ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
            ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
            ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
            ->whereNotIn('id_status',[1,2,3])
            ->where('bmn_master_merk.id_merk',$merk->id_merk)
			->count();
        }

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan bubble chart 1
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $pegawais = [];
        $pegawaiX = [];

        foreach($fungsis as $i => $fungsi){
            $pegawais[$i] = DB::table('users')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
            ->select('*', 'users.id as id', 'm_pegawai.nama as nama_pegawai')
            ->where('m_sub_fungsi.id_fungsi', $fungsi->id)
            ->get();

            foreach($pegawais[$i] as $j => $pegawai){
                $pegawaiX[$i][$j] = DB::table('bmn_keluhan')
                ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
                ->leftjoin('bmn_master_permintaan','bmn_keluhan.id_permintaan','=','bmn_master_permintaan.id_permintaan')
                ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
                ->whereNotIn('id_status',[1,2,3])
                ->where('bmn_master_permintaan.id_kategori_permintaan',1)
                ->where('bmn_grup_keluhan.id_pelapor',$pegawai->id)
                ->count();
            }
        }

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // menampilkan bubble chart 2
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        $types = [];
        $typeX = [];

        foreach($permintaans as $i => $permintaan){
            $types[$i] = DB::table('bmn_master_type')
            ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
            ->where('id_permintaan', $permintaan->id_permintaan)
            ->get();

            foreach($types[$i]->unique('id_merk') as $j => $type){
                $typeX[$i][$j] = DB::table('bmn_keluhan')
                ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
                ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
                ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
                ->whereYear('bmn_grup_keluhan.tgl_laporan',$tahun)
                ->whereNotIn('id_status',[1,2,3])
                ->where('bmn_keluhan.id_type',$type->id_type)
                ->count();
            }
        }

        return view('page.dashboard_tahun')
        ->with('years', $years)
        ->with('card', $card)
        ->with('fungsis', $fungsis)
        ->with('rusakF', $rusakF)
        ->with('prosesF', $prosesF)
        ->with('selesaiF', $selesaiF)
        ->with('rusakB', $rusakB)
        ->with('prosesB', $prosesB)
        ->with('selesaiB', $selesaiB)
        ->with('permintaans', $permintaans)
        ->with('permintaanX', $permintaanX)
        ->with('merks', $merks)
        ->with('merkX', $merkX)
        ->with('pegawais', $pegawais)
        ->with('pegawaiX', $pegawaiX)
        ->with('types', $types)
        ->with('typeX', $typeX);
    }
}
