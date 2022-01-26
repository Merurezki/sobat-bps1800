<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Mail;
use App\Jobs\EmailSobatQueue;
use App\Mail\EmailSobat;

use App\Models\Keluhan;
use App\Models\Rekanan;

class KeluhanController extends Controller
{
    // harus Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk mengambil data keluhan yang masuk ke user sendiri
    public function keluhan()
    {
        $keluhan = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
        ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
        ->leftjoin('bmn_master_permintaan','bmn_keluhan.id_permintaan','=','bmn_master_permintaan.id_permintaan')
        ->leftjoin('bmn_master_kategori_permintaan','bmn_master_permintaan.id_kategori_permintaan','=','bmn_master_kategori_permintaan.id_kategori_permintaan')
        ->leftjoin('bmn_master_rekanan','bmn_keluhan.id_rekanan','=','bmn_master_rekanan.id_rekanan')
        ->leftjoin('bmn_master_status','bmn_keluhan.id_status','=','bmn_master_status.id_status')

        ->leftjoin('users as u1','bmn_grup_keluhan.id_pelapor','=','u1.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user1','u1.id','=','m_user1.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai1','m_user1.id_pegawai','=','m_pegawai1.id')
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

        ->select('*', 'm_pegawai1.nama as pelapor', 'm_pegawai2.nama as pj_ruang', 'm_pegawai3.nama as pemegang_bmn', 'm_pegawai4.nama as umum', 'm_pegawai5.nama as ipds')
        ->where('bmn_grup_keluhan.id_pelapor', Auth::user()->userSobat->id)
        ->where('bmn_keluhan.is_show',1)
        ->orderby('bmn_grup_keluhan.tgl_laporan', 'desc')
        ->get();

        $page = 'page.keluhan';
        return $this->viewKeluhan($keluhan, $page);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk mengambil data keluhan yang masuk ke ipds
    public function admin()
    {
        $keluhan = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
        ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
        ->leftjoin('bmn_master_permintaan','bmn_keluhan.id_permintaan','=','bmn_master_permintaan.id_permintaan')
        ->leftjoin('bmn_master_kategori_permintaan','bmn_master_permintaan.id_kategori_permintaan','=','bmn_master_kategori_permintaan.id_kategori_permintaan')
        ->leftjoin('bmn_master_rekanan','bmn_keluhan.id_rekanan','=','bmn_master_rekanan.id_rekanan')
        ->leftjoin('bmn_master_status','bmn_keluhan.id_status','=','bmn_master_status.id_status')

        ->leftjoin('users as u1','bmn_grup_keluhan.id_pelapor','=','u1.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user1','u1.id','=','m_user1.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai1','m_user1.id_pegawai','=','m_pegawai1.id')
        ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi1','m_pegawai1.id_sub_fungsi','=','m_sub_fungsi1.id')
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

        ->select('*', 'bmn_keluhan.is_show as is_show', 'm_pegawai1.nama as pelapor', 'm_pegawai2.nama as pj_ruang', 'm_pegawai3.nama as pemegang_bmn', 'm_pegawai4.nama as umum', 'm_pegawai5.nama as ipds')
        ->orderby('bmn_grup_keluhan.tgl_laporan', 'desc')
        ->get();

        $page = 'page.keluhan_admin';
        return $this->viewKeluhan($keluhan, $page);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk mengambil data keluhan yang masuk ke ipds
    public function ipds()
    {
        $keluhan = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
        ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
        ->leftjoin('bmn_master_permintaan','bmn_keluhan.id_permintaan','=','bmn_master_permintaan.id_permintaan')
        ->leftjoin('bmn_master_kategori_permintaan','bmn_master_permintaan.id_kategori_permintaan','=','bmn_master_kategori_permintaan.id_kategori_permintaan')
        ->leftjoin('bmn_master_rekanan','bmn_keluhan.id_rekanan','=','bmn_master_rekanan.id_rekanan')
        ->leftjoin('bmn_master_status','bmn_keluhan.id_status','=','bmn_master_status.id_status')

        ->leftjoin('users as u1','bmn_grup_keluhan.id_pelapor','=','u1.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user1','u1.id','=','m_user1.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai1','m_user1.id_pegawai','=','m_pegawai1.id')
        ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi1','m_pegawai1.id_sub_fungsi','=','m_sub_fungsi1.id')
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

        ->select('*', 'm_pegawai1.nama as pelapor', 'm_pegawai2.nama as pj_ruang', 'm_pegawai3.nama as pemegang_bmn', 'm_pegawai4.nama as umum', 'm_pegawai5.nama as ipds')
        ->whereNotIn('bmn_keluhan.id_status', [2,3])
        ->where('bmn_keluhan.is_show',1)
        ->orderby('bmn_grup_keluhan.tgl_laporan', 'desc')
        ->get();

        $page = 'page.keluhan_ipds';
        return $this->viewKeluhan($keluhan, $page);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk mengambil data keluhan yang masuk ke umum
    public function umum()
    {
        $keluhan = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
        ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
        ->leftjoin('bmn_master_permintaan','bmn_keluhan.id_permintaan','=','bmn_master_permintaan.id_permintaan')
        ->leftjoin('bmn_master_kategori_permintaan','bmn_master_permintaan.id_kategori_permintaan','=','bmn_master_kategori_permintaan.id_kategori_permintaan')
        ->leftjoin('bmn_master_rekanan','bmn_keluhan.id_rekanan','=','bmn_master_rekanan.id_rekanan')
        ->leftjoin('bmn_master_status','bmn_keluhan.id_status','=','bmn_master_status.id_status')

        ->leftjoin('users as u1','bmn_grup_keluhan.id_pelapor','=','u1.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user1','u1.id','=','m_user1.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai1','m_user1.id_pegawai','=','m_pegawai1.id')
        ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi1','m_pegawai1.id_sub_fungsi','=','m_sub_fungsi1.id')
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

        ->select('*', 'm_pegawai1.nama as pelapor', 'm_pegawai2.nama as pj_ruang', 'm_pegawai3.nama as pemegang_bmn', 'm_pegawai4.nama as umum', 'm_pegawai5.nama as ipds')
        ->whereNotIn('bmn_keluhan.id_status', [2])
        // ->whereNotIn('bmn_keluhan.id_keluhan', DB::table('bmn_keluhan')->where('id_status',1)->whereNull('id_umum')->pluck('id_keluhan'))
        ->where('bmn_keluhan.is_show',1)
        ->orderby('bmn_grup_keluhan.tgl_laporan', 'desc')
        ->get();

        $page = 'page.keluhan_umum';
        return $this->viewKeluhan($keluhan, $page);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk mengambil data keluhan yang masuk ke pj ruang
    public function pjRuang()
    {
        $keluhan = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('bmn_master_type','bmn_keluhan.id_type','=','bmn_master_type.id_type')
        ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
        ->leftjoin('bmn_master_permintaan','bmn_keluhan.id_permintaan','=','bmn_master_permintaan.id_permintaan')
        ->leftjoin('bmn_master_kategori_permintaan','bmn_master_permintaan.id_kategori_permintaan','=','bmn_master_kategori_permintaan.id_kategori_permintaan')
        ->leftjoin('bmn_master_rekanan','bmn_keluhan.id_rekanan','=','bmn_master_rekanan.id_rekanan')
        ->leftjoin('bmn_master_status','bmn_keluhan.id_status','=','bmn_master_status.id_status')

        ->leftjoin('users as u1','bmn_grup_keluhan.id_pelapor','=','u1.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user1','u1.id','=','m_user1.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai1','m_user1.id_pegawai','=','m_pegawai1.id')
        ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi1','m_pegawai1.id_sub_fungsi','=','m_sub_fungsi1.id')
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

        ->select('*', 'm_pegawai1.nama as pelapor', 'm_pegawai2.nama as pj_ruang', 'm_pegawai3.nama as pemegang_bmn', 'm_pegawai4.nama as umum', 'm_pegawai5.nama as ipds')
        ->where('bmn_master_ruangan.kode_ruangan', Auth::user()->userSobat->ruang)
        ->where('bmn_keluhan.is_show',1)
        ->orderby('bmn_grup_keluhan.tgl_laporan', 'desc')
        ->get();

        $page = 'page.keluhan_pj_ruang';
        return $this->viewKeluhan($keluhan, $page);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk menampilkan keluhan ipds, umum, user, pj ruang
    public function viewKeluhan($keluhans, $pages)
    {
        $merks = DB::table('bmn_master_merk')
        ->where('is_show', 1)
        ->get();

		$types = DB::table('bmn_master_type')
        ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
        ->where('bmn_master_type.is_show', 1)
        ->orderBy('bmn_master_merk.nama_merk', 'asc')
        ->get();

		$kat_permintaans = DB::table('bmn_master_kategori_permintaan')
        ->get();

		$permintaans = DB::table('bmn_master_permintaan')
        ->leftjoin('bmn_master_kategori_permintaan','bmn_master_permintaan.id_kategori_permintaan','=','bmn_master_kategori_permintaan.id_kategori_permintaan')
        ->where('is_show', 1)
        ->orderBy('nama_permintaan','asc')
        ->get();

        $statuss = DB::table('bmn_master_status')
        ->get();

		$ruangans = DB::table('bmn_master_ruangan')
        ->leftjoin('users','bmn_master_ruangan.pj_ruangan','=','users.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id','=','m_pegawai.id')
        ->where('kode_ruangan', Auth::user()->userSobat->ruang)
        ->where('bmn_master_ruangan.is_show', 1)
        ->select('kode_ruangan', 'nama_ruangan')
        ->get();

        $rekanans = DB::table('bmn_master_rekanan')
        ->where('is_show', 1)
		->orderby('nama_rekanan', 'asc')
        ->get();

		$pegawais = DB::table('users')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id','=','m_pegawai.id')
        ->where('is_show', 1)
        ->get();

        $ipdss = DB::table('users')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id','=','m_pegawai.id')
        ->where('is_show', 1)
        ->whereIn('role', [1,2])
        ->get();

        $notifKeluhan = DB::table('notifikasi_user')
        ->leftjoin('bmn_keluhan','notifikasi_user.id_keluhan','=','bmn_keluhan.id_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->where('bmn_grup_keluhan.id_pelapor', Auth::user()->userSobat->id)
        ->where('is_read', 0)
        ->count();

        return view($pages)
        ->with('keluhans',$keluhans)
        ->with('merks',$merks)
        ->with('types',$types)
        ->with('kat_permintaans',$kat_permintaans)
        ->with('permintaans',$permintaans)
        ->with('statuss',$statuss)
        ->with('ruangans',$ruangans)
        ->with('rekanans',$rekanans)
        ->with('pegawais',$pegawais)
        ->with('ipdss',$ipdss)
        ->with('notifKeluhan',$notifKeluhan);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // membangkitkan kode unik keluhan
    public function generate_code() 
    {  
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";  
        $size  = strlen( $chars );  

        $code = "";  
        for( $i = 0; $i < 5; $i++ ) {  
            $code = $code .  $chars[ rand( 0, $size - 1 ) ];  
        } 

        if(DB::table('bmn_keluhan')->where('unique_code',$code)->count() > 0){
            $this->generate_code();
        }else{
            return $code;
        }
    }       

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk ipds, umum, user
    public function tambahKeluhan(Request $keluhan)
    {
        $user      = Auth::user()->userSobat->id;
        $fungsi    = Auth::user()->pegawai->subFungsi->id_fungsi;
        $nama_user = Auth::user()->pegawai->nama;

        $pj = DB::table('bmn_master_ruangan')
            ->leftjoin('users','bmn_master_ruangan.pj_ruangan','=','users.id')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->where('kode_ruangan', Auth::user()->userSobat->ruang)
            ->pluck('m_pegawai.email_bps')->first();

        $month = Carbon::now()->format('m');
        $cntBulan = DB::table('bmn_grup_keluhan')
        ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
        ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
        ->whereMonth('tgl_laporan',$month)
        ->where('m_sub_fungsi.id_fungsi',$fungsi)
        ->count();

        $cntBulan += 1;

        $nomorLaporan = date("Y")."/".date("m")."/".$fungsi."/".$cntBulan;

        $idGrup = DB::table('bmn_grup_keluhan')
        ->insertGetId([
            'id_pelapor'    => $user,
            'nomor_laporan' => $nomorLaporan,
            'tgl_laporan'   => date("Y-m-d H:i:s"),
        ]);

        $jumlah = $keluhan -> jumlah_permintaan;

        $code_name = '';

        for($i=1; $i<=$jumlah; $i++)
        {
            $j = "$i";
            $a = "id_permintaan".$j;
            $b = "id_type".$j;
            $c = "pemegang_bmn".$j;
            $d = "masalah".$j;
            $e = "lainnya".$j;
            $f = "type_lainnya".$j;
            
            $jenis = $keluhan -> $a;
            $type  = $keluhan -> $b;
            $bmn   = $keluhan -> $c;
            $isi   = $keluhan -> $d;
            $lain  = $keluhan -> $e;
            $lain2 = $keluhan -> $f;
            $code  = $this->generate_code();

            $id = DB::table('bmn_keluhan')
            ->insertGetId([
                'id_grup_keluhan'    => $idGrup,
                'unique_code'        => $code,
                'id_permintaan'      => $jenis,
                'id_type'            => $type,
                'id_pemegang_bmn'    => $bmn,
                'masalah'            => $isi,
                'permintaan_lainnya' => $lain,
                'type_lainnya'       => $lain2,
            ]);

            DB::table('notifikasi_pjruang')
            ->insert([
                'id_keluhan'   => $id,
                'date_created' => date("Y-m-d H:i:s"),
            ]);

            $code_name = $code_name.' '.$code;
        }

        $details = [
            'receiver' => $pj,
            'subject' => 'Keluhan Barang TI Baru',
            'body'   => 'Permintaan baru oleh '.$nama_user.' dengan kode '.$code_name.' telah ditambahkan. PJ Ruangan harap segera meng-approve.'
        ];

        dispatch(new EmailSobatQueue($details));
       
        // Mail::to($pj)->send(new EmailSobat($details));

        Session::flash('success', 'Keluhan '.$code_name.' berhasil ditambahkan');
        return redirect()->back();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // hapus keluhan untuk ipds, umum, pj ruang
    public function hapusKeluhan(Request $keluhan)
    {
        $id_keluhan = $keluhan -> id_keluhan;
        $code       = Keluhan::find($id_keluhan)->unique_code;

        DB::table('notifikasi_user')
        ->where('id_keluhan', $id_keluhan)
        ->delete();

        DB::table('notifikasi_ipds')
        ->where('id_keluhan', $id_keluhan)
        ->delete();

        DB::table('notifikasi_umum')
        ->where('id_keluhan', $id_keluhan)
        ->delete();

        DB::table('notifikasi_pjruang')
        ->where('id_keluhan', $id_keluhan)
        ->delete();

        DB::table('bmn_keluhan')
        ->where('id_keluhan', $id_keluhan)
        ->delete();

        Session::flash('success', 'Keluhan '.$code.' berhasil dihapus');
        return redirect()->back();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // edit keluhan untuk ipds, umum, pj ruang
    public function editKeluhan(Request $keluhan)
    {
        $id_keluhan    = $keluhan -> id_keluhan;
        $id_permintaan = $keluhan -> id_permintaan;
        $lainnya       = $keluhan -> permintaan_lainnya;
        $id_type       = $keluhan -> id_type;
        $type_lainnya  = $keluhan -> type_lainnya;
        $pemegang_bmn  = $keluhan -> pemegang_bmn;
        $permasalahan  = $keluhan -> permasalahan;
        $ctt_umum      = $keluhan -> catatan_umum;
        $ipds          = $keluhan -> ipds;
        $ctt_ipds      = $keluhan -> catatan_ipds;
        $rekanan       = $keluhan -> rekanan;
        $ctt_rekanan   = $keluhan -> catatan_rekanan;
        $biaya         = $keluhan -> biaya;

        DB::table('bmn_keluhan')
        ->where('id_keluhan', $id_keluhan)
        ->update([
            'id_permintaan'      => $id_permintaan,
            'permintaan_lainnya' => $lainnya,
            'id_type'            => $id_type,
            'type_lainnya'       => $type_lainnya,
            'id_pemegang_bmn'    => $pemegang_bmn,
            'masalah'            => $permasalahan,
            'catatan_umum'       => $ctt_umum,
            'id_ipds'            => $ipds,
            'catatan_ipds'       => $ctt_ipds,
            'id_rekanan'         => $rekanan,
            'catatan_rekanan'    => $ctt_rekanan,
            'biaya'              => $biaya,
        ]);

        $code = Keluhan::find($id_keluhan)->unique_code;

        Session::flash('success', 'Data keluhan '.$code.' berhasil diedit');
        return redirect()->back();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // show keluhan untuk admin
    public function showKeluhan(Request $keluhan)
    {
        $id   = $keluhan -> id_keluhan;
        $show = $keluhan -> show_keluhan;
        $code = Keluhan::find($id)->unique_code;

        DB::table('bmn_keluhan')
        ->where('id_keluhan', $id)
        ->update([
            'is_show'     => $show,
        ]);

        if($show==0){
            $msg = 'Data keluhan '.$code.' disembunyikan';
        }

        else{
            $msg = 'Data keluhan '.$code.' ditampilkan';
        }
        
        return response()->json(['msg'=>$msg]);
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk PJ meng-approve keluhan
    public function approvePj(Request $keluhan)
    {
        $id_keluhan = $keluhan -> id_keluhan;
        $id_status  = $keluhan -> id_status;

        $code       = Keluhan::find($id_keluhan)->unique_code;

        DB::table('bmn_keluhan')
        ->where('id_keluhan', $id_keluhan)
        ->update([
            'id_status'      => $id_status,
            'tgl_approve_pj' => date("Y-m-d H:i:s"),
        ]);

        $nama_user = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
        ->where('id_keluhan',$id_keluhan)
        ->pluck('m_pegawai.nama')->first();

        $email_user = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
        ->where('id_keluhan',$id_keluhan)
        ->pluck('m_pegawai.email_bps')->first();

        if($id_status==1){
            $details = [
                'receiver' => $email_user,
                'subject' => 'Keluhan Barang TI Ditolak',
                'body'   => 'Permintaan dengan kode '.$code.' telah ditolak oleh PJ Ruangan Anda.'
            ];

            dispatch(new EmailSobatQueue($details));

            // Mail::cc($email_user)->send(new EmailSobat($details));

            Session::flash('fail', 'Data keluhan '.$code.' telah ditolak');
        }
        
        else{
            DB::table('notifikasi_umum')
            ->insert([
                'id_keluhan'   => $id_keluhan,
                'date_created' => date("Y-m-d H:i:s"),
            ]);

            // email ke umum
            $umum = DB::table('users')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->where('role', 3)
            ->pluck('m_pegawai.email_bps');

            $details = [
                'receiver' => $umum,
                'subject' => 'Keluhan Barang TI Baru',
                'body'   => 'Permintaan baru oleh '.$nama_user.' dengan kode '.$code.' telah ditambahkan. Subfungsi Umum harap segera meng-approve.'
            ];

            dispatch(new EmailSobatQueue($details));

            // Mail::cc($umum)->send(new EmailSobat($details));

            // email ke user
            $details = [
                'receiver' => $email_user,
                'subject' => 'Keluhan Barang TI Diapprove',
                'body'   => 'Permintaan dengan kode '.$code.' telah diapprove oleh PJ Ruangan Anda.'
            ];

            dispatch(new EmailSobatQueue($details));

            // Mail::cc($email_user)->send(new EmailSobat($details));
            
            Session::flash('success', 'Data keluhan '.$code.' telah diapprove dan dikirim ke Bagian Umum');
        }

        DB::table('notifikasi_pjruang')
        ->where('id_keluhan', $id_keluhan)
        ->update([
            'is_read' => 1,
        ]);

        DB::table('notifikasi_user')
        ->insert([
            'id_keluhan'   => $id_keluhan,
            'date_created' => date("Y-m-d H:i:s"),
        ]);

        return redirect()->back();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk umum meng-approve keluhan
    public function approveUmum(Request $keluhan)
    {
        $id_keluhan = $keluhan -> id_keluhan;
        $id_status  = $keluhan -> id_status;
        $catatan    = $keluhan -> catatan_umum;
        $biaya      = $keluhan -> biaya;

        $code       = Keluhan::find($id_keluhan)->unique_code;

        $nama_user = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
        ->where('id_keluhan',$id_keluhan)
        ->pluck('m_pegawai.nama')->first();

        $email_user = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
        ->where('id_keluhan',$id_keluhan)
        ->pluck('m_pegawai.email_bps')->first();

        if($id_status==1){
            DB::table('bmn_keluhan')
            ->where('id_keluhan', $id_keluhan)
            ->update([
                'id_status'        => $id_status,
                'id_umum'          => Auth::user()->userSobat->id,
                'catatan_umum'     => $catatan,
                'tgl_approve_umum' => date("Y-m-d H:i:s"),
            ]);

            // email ke user
            $details = [
                'receiver' => $email_user,
                'subject' => 'Keluhan Barang TI Ditolak',
                'body'   => 'Permintaan dengan kode '.$code.' telah ditolak oleh Subfungsi Umum.'
            ];

            dispatch(new EmailSobatQueue($details));

            // Mail::cc($email_user)->send(new EmailSobat($details));

            Session::flash('fail', 'Data keluhan '.$code.' telah ditolak');
        }
        
        else if($id_status==4){
            DB::table('bmn_keluhan')
            ->where('id_keluhan', $id_keluhan)
            ->update([
                'id_status'        => $id_status,
                'id_umum'          => Auth::user()->userSobat->id,
                'catatan_umum'     => $catatan,
                'tgl_approve_umum' => date("Y-m-d H:i:s"),
            ]);
            
            DB::table('notifikasi_ipds')
            ->insert([
                'id_keluhan'   => $id_keluhan,
                'date_created' => date("Y-m-d H:i:s"),
            ]);

            // email ke ipds dan admin
            $ipds = DB::table('users')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->whereIn('role', [1,2])
            ->pluck('m_pegawai.email_bps');

            $details = [
                'receiver' => $ipds,
                'subject' => 'Keluhan Barang TI Baru',
                'body'   => 'Permintaan baru oleh '.$nama_user.' dengan kode '.$code.' telah ditambahkan. Fungsi IPDS harap segera memprosesnya.'
            ];

            dispatch(new EmailSobatQueue($details));

            // Mail::cc($ipds)->send(new EmailSobat($details));

            // email ke user
            $details = [
                'receiver' => $email_user,
                'subject' => 'Keluhan Barang TI Diapprove',
                'body'   => 'Permintaan dengan kode '.$code.' telah diapprove oleh Subfungsi Umum dan dikirim ke Fungsi IPDS.'
            ];

            dispatch(new EmailSobatQueue($details));

            // Mail::cc($email_user)->send(new EmailSobat($details));

            Session::flash('success', 'Data keluhan '.$code.' telah diapprove dan dikirim ke Fungsi IPDS');
        }

        else if($id_status==8){
            DB::table('bmn_keluhan')
            ->where('id_keluhan', $id_keluhan)
            ->update([
                'id_status'        => $id_status,
                'id_umum'          => Auth::user()->userSobat->id,
                'catatan_umum'     => $catatan,
                'tgl_selesai'      => date("Y-m-d H:i:s"),
                'biaya'            => $biaya,
            ]);

            // email ke user
            $details = [
                'receiver' => $email_user,
                'subject' => 'Keluhan Barang TI Diapprove',
                'body'   => 'Permintaan dengan kode '.$code.' telah diapprove dan diselesaikan oleh Subfungsi Umum. Harap segera ambil barang Anda di Subfungsi Umum.'
            ];

            dispatch(new EmailSobatQueue($details));

            // Mail::cc($email_user)->send(new EmailSobat($details));

            Session::flash('success', 'Data keluhan '.$code.' telah diapprove dan diselesaikan');
        }

        DB::table('notifikasi_umum')
        ->where('id_keluhan', $id_keluhan)
        ->update([
            'is_read' => 1,
        ]);

        DB::table('notifikasi_user')
        ->insert([
            'id_keluhan'   => $id_keluhan,
            'date_created' => date("Y-m-d H:i:s"),
        ]);

        return redirect()->back();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk admin ipds mengubah status keluhan
    public function statusIpds(Request $keluhan)
    {
        $id_keluhan = $keluhan -> id_keluhan;
        $id_status  = $keluhan -> id_status;

        $code       = Keluhan::find($id_keluhan)->unique_code;

        $email_user = DB::table('bmn_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
        ->where('id_keluhan',$id_keluhan)
        ->pluck('m_pegawai.email_bps')->first();

        if($id_status==5){
            DB::table('bmn_keluhan')
            ->where('id_keluhan', $id_keluhan)
            ->update([
                'id_status'       => $id_status,
                'id_ipds'         => Auth::user()->userSobat->id,
                'tgl_proses_ipds' => date("Y-m-d H:i:s"),
            ]);

            // email ke user
            $details = [
                'receiver' => $email_user,
                'subject' => 'Barang TI Sedang Diproses',
                'body'   => 'Permintaan dengan kode '.$code.' sedang diproses dan dicek oleh '.Auth::user()->pegawai->nama.'.',
            ];

            dispatch(new EmailSobatQueue($details));

            // Mail::cc($email_user)->send(new EmailSobat($details));

            DB::table('notifikasi_ipds')
            ->where('id_keluhan', $id_keluhan)
            ->update([
                'is_read' => 1,
            ]);
        }
        
        else if($id_status==6){
            $catatan_ipds  = $keluhan -> catatan_ipds;
            $id_rekanan    = $keluhan -> id_rekanan;

            DB::table('bmn_keluhan')
            ->where('id_keluhan', $id_keluhan)
            ->update([
                'id_status'         => $id_status,
                'catatan_ipds'      => $catatan_ipds,
                'id_rekanan'        => $id_rekanan,
                'tgl_kirim_rekanan' => date("Y-m-d H:i:s"),
            ]);

            // email ke user
            $details = [
                'receiver' => $email_user,
                'subject' => 'Barang TI Dikirim Ke Rekanan',
                'body'   => 'Permintaan dengan kode '.$code.' sedang dikirim ke rekanan '.Rekanan::find($id_rekanan)->nama_rekanan.'.',
            ];

            dispatch(new EmailSobatQueue($details));

            // Mail::cc($email_user)->send(new EmailSobat($details));
        }
        
        else if($id_status==7){
            $catatan_rekanan = $keluhan -> catatan_rekanan;
            $catatan_ipds    = $keluhan -> catatan_ipds;
            $biaya           = $keluhan -> biaya;

            if(!is_null($catatan_rekanan)){
                DB::table('bmn_keluhan')
                ->where('id_keluhan', $id_keluhan)
                ->update([
                    'id_status'           => $id_status,
                    'catatan_rekanan'     => $catatan_rekanan,
                    'biaya'               => $biaya,
                    'tgl_selesai'         => date("Y-m-d H:i:s"),
                ]);
            }
            
            else{
                DB::table('bmn_keluhan')
                ->where('id_keluhan', $id_keluhan)
                ->update([
                    'id_status'           => $id_status,
                    'catatan_ipds'        => $catatan_ipds,
                    'biaya'               => $biaya,
                    'tgl_selesai'         => date("Y-m-d H:i:s"),
                ]);
            }

            DB::table('notifikasi_umum')
            ->insert([
                'id_keluhan'   => $id_keluhan,
                'date_created' => date("Y-m-d H:i:s"),
            ]);

            $umum = DB::table('bmn_keluhan')
            ->leftjoin('users','bmn_keluhan.id_umum','=','users.id')
            ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
            ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
            ->where('id_keluhan',$id_keluhan)
            ->pluck('m_pegawai.email_bps')->first();

            // email ke umum
            $details = [
                'receiver' => $umum,
                'subject' => 'Barang TI Sudah Selesai',
                'body'   => 'Permintaan dengan kode '.$code.' sudah selesai oleh Fungsi IPDS.',
            ];

            dispatch(new EmailSobatQueue($details));

            // Mail::cc($umum)->send(new EmailSobat($details));

            // email ke user
            $details = [
                'receiver' => $email_user,
                'subject' => 'Barang TI Sudah Selesai',
                'body'   => 'Permintaan dengan kode '.$code.' sudah selesai dan dapat diambil di Subfungsi Umum.',
            ];

            dispatch(new EmailSobatQueue($details));

            // Mail::cc($email_user)->send(new EmailSobat($details));
        }

        DB::table('notifikasi_user')
        ->insert([
            'id_keluhan'   => $id_keluhan,
            'date_created' => date("Y-m-d H:i:s"),
        ]);

        Session::flash('success', 'Status keluhan '.$code.' berhasil diubah');
        return redirect()->back();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // untuk admin umum mengubah status keluhan
    public function statusUmum(Request $keluhan)
    {
        $id_keluhan = $keluhan -> id_keluhan;
        $id_status  = $keluhan -> id_status;

        $code       = Keluhan::find($id_keluhan)->unique_code;
        
        DB::table('bmn_keluhan')
        ->where('id_keluhan', $id_keluhan)
        ->update([
            'id_status'       => $id_status,
            'tgl_diambil'     => date("Y-m-d H:i:s"),
        ]);
        
        DB::table('notifikasi_umum')
        ->where('id_keluhan', $id_keluhan)
        ->update([
            'is_read' => 1,
        ]);

        DB::table('notifikasi_user')
        ->insert([
            'id_keluhan'   => $id_keluhan,
            'date_created' => date("Y-m-d H:i:s"),
        ]);

        Session::flash('success', 'Status keluhan '.$code.' berhasil diubah');
        return redirect()->back();
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    // mengubah notif telah dibaca
    public function notifKeluhan(Request $notif)
    {
        $id = $notif -> id;

        DB::table('notifikasi_user')
        ->leftjoin('bmn_keluhan','notifikasi_user.id_keluhan','=','bmn_keluhan.id_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->where('bmn_grup_keluhan.id_pelapor', Auth::user()->userSobat->id)
        ->where('notifikasi_user.id_keluhan', $id)
        ->update([
            'is_read' => 1,
        ]);

        $result = DB::table('notifikasi_user')
        ->leftjoin('bmn_keluhan','notifikasi_user.id_keluhan','=','bmn_keluhan.id_keluhan')
        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
        ->where('bmn_grup_keluhan.id_pelapor', Auth::user()->userSobat->id)
        ->where('is_read', 0)
        ->count();

        return response()->json(['result'=>$result]);
    }
}
