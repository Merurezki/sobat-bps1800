<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PegawaiController extends Controller
{
    // Harus Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    // tampil pegawai
    public function index()
    {
        $pegawais = DB::table('users')
        ->leftjoin('ckpt6832_pegawai.m_user as m_user','users.id','=','m_user.id')
        ->leftjoin('ckpt6832_pegawai.m_pegawai as m_pegawai','m_user.id_pegawai','=','m_pegawai.id')
        ->leftjoin('ckpt6832_pegawai.m_golongan_pangkat as m_golongan_pangkat','m_pegawai.id_golongan_pangkat','=','m_golongan_pangkat.id')
        ->leftjoin('ckpt6832_pegawai.m_sub_fungsi as m_sub_fungsi','m_pegawai.id_sub_fungsi','=','m_sub_fungsi.id')
        ->leftjoin('ckpt6832_pegawai.m_fungsi as m_fungsi','m_sub_fungsi.id_fungsi','=','m_fungsi.id')
        ->leftjoin('ckpt6832_pegawai.m_struktural as m_struktural','m_pegawai.id_struktural','=','m_struktural.id')
        ->leftjoin('ckpt6832_pegawai.m_fungsional as m_fungsional','m_pegawai.id_fungsional','=','m_fungsional.id')
        ->leftjoin('ckpt6832_pegawai.m_jenjang_fungsional as m_jenjang_fungsional','m_pegawai.id_jenjang_fungsional','=','m_jenjang_fungsional.id')
        ->leftjoin('ckpt6832_pegawai.m_wilayah as m_wilayah','m_pegawai.id_wilayah','=','m_wilayah.id')
        ->leftjoin('ckpt6832_pegawai.m_status_pegawai as m_status_pegawai','m_pegawai.id_status_pegawai','=','m_status_pegawai.id')
        ->leftjoin('ckpt6832_pegawai.m_user_level as m_user_level','m_user.id_user_level','=','m_user_level.id')
        ->leftjoin('users_role','users.role','=','users_role.id_role')
        ->leftjoin('bmn_master_ruangan','users.ruang','=','bmn_master_ruangan.kode_ruangan')
        ->select('*', 'users.id as id_sobat', 'm_user.id as id_user', 'm_pegawai.id as id_pegawai', 'm_pegawai.nama as nama_pegawai',
                    'm_sub_fungsi.nama as nama_sub_fungsi', 'm_fungsi.nama as nama_fungsi', 'm_struktural.nama as nama_struktural', 
                    'm_fungsional.nama as nama_fungsional', 'm_jenjang_fungsional.nama as nama_jenjang_fungsional', 'm_wilayah.nama as nama_wilayah',
                    'm_status_pegawai.nama as nama_status_pegawai', 'm_user_level.nama as nama_user_level', 'm_jenjang_fungsional.nama as nama_jenjang_fungsional',
                    'm_wilayah.nama as nama_wilayah', 'm_status_pegawai.nama as nama_status_pegawai', 'users.is_show as is_show')
        ->orderby('users.role', 'asc')
        ->orderby('m_pegawai.nama', 'asc')
        ->get();

        $golpangkats = DB::table('ckpt6832_pegawai.m_golongan_pangkat')
        ->get();

        $subfungsis = DB::table('ckpt6832_pegawai.m_sub_fungsi')
        ->leftjoin('ckpt6832_pegawai.m_fungsi as m_fungsi','m_sub_fungsi.id_fungsi','=','m_fungsi.id')
        ->select('*', 'm_sub_fungsi.id as id_sub_fungsi', 'm_sub_fungsi.nama as nama_sub_fungsi', 'm_fungsi.nama as nama_fungsi')
        ->get();

        $strukturals = DB::table('ckpt6832_pegawai.m_struktural')
        ->get();

        $fungsionals = DB::table('ckpt6832_pegawai.m_fungsional')
        ->get();

        $jenjangs = DB::table('ckpt6832_pegawai.m_jenjang_fungsional')
        ->get();

        $wilayahs = DB::table('ckpt6832_pegawai.m_wilayah')
        ->get();

        $statuss = DB::table('ckpt6832_pegawai.m_status_pegawai')
        ->get();

        $roles = DB::table('users_role')
        ->get();

        $ruangans = DB::table('bmn_master_ruangan')
        ->where('is_show', 1)
        ->get();

        return view('page.master.pegawai')
        ->with('pegawais',$pegawais)
        ->with('golpangkats',$golpangkats)
        ->with('subfungsis',$subfungsis)
        ->with('strukturals',$strukturals)
        ->with('fungsionals',$fungsionals)
        ->with('jenjangs',$jenjangs)
        ->with('wilayahs',$wilayahs)
        ->with('statuss',$statuss)
        ->with('roles',$roles)
        ->with('ruangans',$ruangans);
    }

    // tambah pegawai
    public function tambahPegawai(Request $pegawai)
    {
        $nip_lama     = $pegawai -> nip_lama;
        $nip_baru     = $pegawai -> nip_baru;
        $nama_pegawai = $pegawai -> nama_pegawai;
        $email        = $pegawai -> email;
        $golpangkat   = $pegawai -> golpangkat;
        $subfungsi    = $pegawai -> subfungsi;
        $struktural   = $pegawai -> struktural;
        $fungsional   = $pegawai -> fungsional;
        $jenjang      = $pegawai -> jenjang;
        $wilayah      = $pegawai -> wilayah;
        $status       = $pegawai -> status;
        $username     = $pegawai -> username;
        $password     = $pegawai -> password;
        $ruangan      = $pegawai -> ruangan;
        $role         = $pegawai -> role;

        if(DB::table('ckpt6832_pegawai.m_pegawai')->where('nip_lama', $nip_lama)->count() > 0){
            $id = 'fail';
            $msg = 'NIP lama '.$nip_lama.' sudah terdaftar';
            return response()->json(['msg'=>$msg,'id'=>$id]);
        }

        else if(DB::table('ckpt6832_pegawai.m_pegawai')->where('nip_baru', $nip_baru)->count() > 0){
            $id = 'fail';
            $msg = 'NIP baru '.$nip_baru.' sudah terdaftar';
            return response()->json(['msg'=>$msg,'id'=>$id]);
        }

        else if(DB::table('ckpt6832_pegawai.m_pegawai')->where('email_bps', $email)->count() > 0){
            $id = 'fail';
            $msg = 'Email BPS '.$email.' sudah terdaftar';
            return response()->json(['msg'=>$msg,'id'=>$id]);
        }

        else if(DB::table('ckpt6832_pegawai.m_user')->where('username', $username)->count() > 0){
            $id = 'fail';
            $msg = 'Username '.$username.' sudah terdaftar';
            return response()->json(['msg'=>$msg,'id'=>$id]);
        }

        else {
            $id_pegawai = DB::table('ckpt6832_pegawai.m_pegawai')
            ->insertGetId([
                'nip_lama'             => $nip_lama,
                'nip_baru'             => $nip_baru,
                'nama'                 => $nama_pegawai,
                'email_bps'            => $email,
                'id_golongan_pangkat'  => $golpangkat,
                'id_sub_fungsi'        => $subfungsi,
                'id_struktural'        => $struktural,
                'id_fungsional'        => $fungsional,
                'id_jenjang_fungsional'=> $jenjang,
                'id_wilayah'           => $wilayah,
                'id_status_pegawai'    => $status,           
            ]);

            $id_user = DB::table('ckpt6832_pegawai.m_user')
            ->insertGetId([
                'id_pegawai'           => $id_pegawai,
                'id_user_level'        => 2,
                'username'             => $username,
                'password'             => $password,
                'status'               => 1,   
            ]);

            DB::table('users')
            ->insertGetId([
                'id'                   => $id_user,
                'role'                 => $role,
                'ruang'                => $ruangan,     
            ]);

            $id = 'success';
            $msg = 'Data pegawai '.$nama_pegawai.' telah ditambahkan';
            return response()->json(['msg'=>$msg,'id'=>$id]);
        }
    }

    // edit pegawai
    public function editPegawai(Request $pegawai)
    {
        $id_pegawai   = $pegawai -> id_pegawai;
        $id_user      = $pegawai -> id_user;
        $id_sobat     = $pegawai -> id_sobat;
        $nip_lama     = $pegawai -> nip_lama;
        $nip_lama_0   = $pegawai -> nip_lama_0;
        $nip_baru     = $pegawai -> nip_baru;
        $nip_baru_0   = $pegawai -> nip_baru_0;
        $nama_pegawai = $pegawai -> nama_pegawai;
        $email        = $pegawai -> email;
        $email_0      = $pegawai -> email_0;
        $golpangkat   = $pegawai -> golpangkat;
        $subfungsi    = $pegawai -> subfungsi;
        $struktural   = $pegawai -> struktural;
        $fungsional   = $pegawai -> fungsional;
        $jenjang      = $pegawai -> jenjang;
        $wilayah      = $pegawai -> wilayah;
        $status       = $pegawai -> status;
        $username     = $pegawai -> username;
        $username_0   = $pegawai -> username_0;
        $password     = $pegawai -> password;
        $ruangan      = $pegawai -> ruangan;
        $role         = $pegawai -> role;

        if($nip_lama != $nip_lama_0 AND DB::table('ckpt6832_pegawai.m_pegawai')->where('nip_lama', $nip_lama)->count() > 0){
            $id = 'fail';
            $msg = 'NIP lama '.$nip_lama.' sudah terdaftar';
            return response()->json(['msg'=>$msg,'id'=>$id]);
        }

        else if($nip_baru != $nip_baru_0 AND DB::table('ckpt6832_pegawai.m_pegawai')->where('nip_baru', $nip_baru)->count() > 0){
            $id = 'fail';
            $msg = 'NIP baru '.$nip_baru.' sudah terdaftar';
            return response()->json(['msg'=>$msg,'id'=>$id]);
        }

        else if($email != $email_0 AND DB::table('ckpt6832_pegawai.m_pegawai')->where('email_bps', $email)->count() > 0){
            $id = 'fail';
            $msg = 'Email BPS '.$email.' sudah terdaftar';
            return response()->json(['msg'=>$msg,'id'=>$id]);
        }

        else if($username != $username_0 AND  DB::table('ckpt6832_pegawai.m_user')->where('username', $username)->count() > 0){
            $id = 'fail';
            $msg = 'Username '.$username.' sudah terdaftar';
            return response()->json(['msg'=>$msg,'id'=>$id]);
        }

        else{
            DB::table('ckpt6832_pegawai.m_pegawai')
            ->where('id', $id_pegawai)
            ->update([
                'nip_lama'             => $nip_lama,
                'nip_baru'             => $nip_baru,
                'nama'                 => $nama_pegawai,
                'email_bps'            => $email,
                'id_golongan_pangkat'  => $golpangkat,
                'id_sub_fungsi'        => $subfungsi,
                'id_struktural'        => $struktural,
                'id_fungsional'        => $fungsional,
                'id_jenjang_fungsional'=> $jenjang,
                'id_wilayah'           => $wilayah,
                'id_status_pegawai'    => $status,
            ]);

            DB::table('ckpt6832_pegawai.m_user')
            ->where('id', $id_user)
            ->update([
                'username'             => $username,
                'password'             => $password, 
            ]);

            DB::table('users')
            ->where('id', $id_sobat)
            ->update([
                'role'                 => $role,
                'ruang'                => $ruangan,
            ]);

            $id = 'success';
            $msg = 'Data pegawai '.$nama_pegawai.' berhasil diedit';
            return response()->json(['msg'=>$msg,'id'=>$id]);
        }
    }

    // show pegawai
    public function showPegawai(Request $pegawai)
    {
        $id   = $pegawai -> id_sobat;
        $nama = $pegawai -> nama_pegawai;
        $show = $pegawai -> show_pegawai;

        DB::table('users')
        ->where('id', $id)
        ->update([
            'is_show'     => $show,
        ]);

        if($show==0){
            $msg = 'Data pegawai '.$nama.' disembunyikan';
        }

        else{
            $msg = 'Data pegawai '.$nama.' ditampilkan';
        }
        
        return response()->json(['msg'=>$msg]);
    }
}
