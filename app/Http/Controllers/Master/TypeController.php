<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TypeController extends Controller
{
    // Harus Login
    public function __construct()
    {
        $this->middleware('auth');
    }

    // tampil type
    public function index()
    {
        $types = DB::table('bmn_master_type')
        ->leftjoin('bmn_master_permintaan','bmn_master_type.id_permintaan','=','bmn_master_permintaan.id_permintaan')
        ->leftjoin('bmn_master_merk','bmn_master_type.id_merk','=','bmn_master_merk.id_merk')
        ->select('*', 'bmn_master_type.is_show as is_show')
        ->orderby('nama_merk', 'asc')
        ->get();

        $permintaans = DB::table('bmn_master_permintaan')
        ->where('id_kategori_permintaan', 1)
        ->where('is_show', 1)
        ->orderBy('nama_permintaan','asc')
        ->get();

        $merks = DB::table('bmn_master_merk')
        ->where('is_show', 1)
        ->orderBy('nama_merk','asc')
        ->get();

        return view('page.master.type')
        ->with('types',$types)
        ->with('permintaans',$permintaans)
        ->with('merks',$merks);
    }

    // tambah type
    public function tambahType(Request $type)
    {
        $id_permintaan = $type -> id_permintaan;
        $id_merk       = $type -> id_merk;
        $nama          = $type -> nama_type;

        DB::table('bmn_master_type')
        ->insert([
            'id_permintaan'  => $id_permintaan,
            'id_merk'        => $id_merk,
            'nama_type'      => $nama,
        ]);

        Session::flash('success', 'Type '.$nama.' berhasil ditambahkan');
        return redirect()->back();
    }

    // edit type
    public function editType(Request $type)
    {
        $id_permintaan = $type -> id_permintaan;
        $id_type       = $type -> id_type;
        $id_merk       = $type -> id_merk;
        $nama          = $type -> nama_type;

        DB::table('bmn_master_type')
        ->where('id_type', $id_type)
        ->update([
            'id_permintaan'  => $id_permintaan,
            'id_merk'        => $id_merk,
            'nama_type'      => $nama,
        ]);

        Session::flash('success', 'Data type '.$nama.' berhasil diedit');
        return redirect()->back();
    }

    // show type
    public function showType(Request $type)
    {
        $id   = $type -> id_type;
        $nama = $type -> nama_type;
        $show = $type -> show_type;

        DB::table('bmn_master_type')
        ->where('id_type', $id)
        ->update([
            'is_show'     => $show,
        ]);

        if($show==0){
            $msg = 'Data type '.$nama.' disembunyikan';
        }

        else{
            $msg = 'Data type '.$nama.' ditampilkan';
        }
        
        return response()->json(['msg'=>$msg]);
    }
}
