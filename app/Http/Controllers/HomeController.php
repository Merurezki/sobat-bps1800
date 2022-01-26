<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect() -> route('login');
    }
    
    public function register()
    {
        return redirect() -> route('login');
    }

    public function setting(Request $user)
    {
        $uname   = $user -> username;
        $pw_old  = $user -> pwdlama;
        $pw_new  = $user -> pwdbaru;

        $un = DB::table('ckpt6832_pegawai.m_user')
        ->whereNotIn('id', [Auth::user()->id])
        ->where('username', $uname)
        ->count();

        $msg1s = '';
        $msg1f = '';
        if($uname != Auth::user()->username){
            if($un < 1){
                DB::table('ckpt6832_pegawai.m_user')
                ->where('id', Auth::user()->id)
                ->update([
                    'username' => $uname,
                ]);

                $msg1s = 'Username berhasil diganti.';
            }else{
                $msg1f = 'Username sudah dipakai.';
            }
        }

        $msg2s = '';
        $msg2f = '';
        if($pw_old != '' AND $pw_new != ''){
            if(Auth::user()->pegawai->password == $pw_old){
                DB::table('ckpt6832_pegawai.m_user')
                ->where('id', Auth::user()->id)
                ->update([
                    'password'   => $pw_new,
                ]);

                $msg2s = 'Password berhasil diganti.';
            }else{
                $msg2f = 'Password lama salah.';
            }
        }

        return response()->json(['msg1s'=>$msg1s,'msg1f'=>$msg1f,'msg2s'=>$msg2s,'msg2f'=>$msg2f]);
    }
}
