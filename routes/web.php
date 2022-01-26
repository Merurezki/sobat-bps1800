<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']) -> name('/');
Route::get('register', [App\Http\Controllers\HomeController::class, 'register']) -> name('register');

// authorization
Route::middleware(['auth'])->group(function () {
    Route::post('setting', [App\Http\Controllers\HomeController::class, 'setting']) -> name('setting');

    Route::get('dashboard/{tahun}/{bulan}', [App\Http\Controllers\DashboardController::class, 'bulan']);
    Route::get('dashboard/{tahun}', [App\Http\Controllers\DashboardController::class, 'tahun']);
    Route::post('dashboard/ganti_bulan', [App\Http\Controllers\DashboardController::class, 'gantiBulan']) -> name('dashboard/ganti_bulan');
    Route::post('dashboard/ganti_tahun', [App\Http\Controllers\DashboardController::class, 'gantiTahun']) -> name('dashboard/ganti_tahun');

    Route::get('keluhan', [App\Http\Controllers\KeluhanController::class, 'keluhan']) -> name('keluhan');
    Route::post('keluhan', [App\Http\Controllers\KeluhanController::class, 'tambahKeluhan']) -> name('keluhan/tambah');

    Route::post('notif_keluhan', [App\Http\Controllers\KeluhanController::class, 'notifKeluhan']) -> name('notif_keluhan');
    
    // pj ruang
    Route::middleware(['pj.ruang:1'])->group(function () {
        Route::get('pj_ruang/keluhan', [App\Http\Controllers\KeluhanController::class, 'pjRuang']) -> name('pj_ruang/keluhan');
        Route::post('pj_ruang/keluhan/approve', [App\Http\Controllers\KeluhanController::class, 'approvePj']) -> name('pj_ruang/keluhan/approve');
        Route::post('pj_ruang/keluhan/hapus', [App\Http\Controllers\KeluhanController::class, 'hapusKeluhan']) -> name('pj_ruang/keluhan/hapus');
        Route::post('pj_ruang/keluhan/edit', [App\Http\Controllers\KeluhanController::class, 'editKeluhan']) -> name('pj_ruang/keluhan/edit');
    });

    // admin
    Route::middleware(['role:1'])->group(function () {
        Route::get('admin/keluhan', [App\Http\Controllers\KeluhanController::class, 'admin']) -> name('admin/keluhan');
        Route::post('admin/keluhan/hapus', [App\Http\Controllers\KeluhanController::class, 'hapusKeluhan']) -> name('admin/keluhan/hapus');
        Route::post('admin/keluhan/edit', [App\Http\Controllers\KeluhanController::class, 'editKeluhan']) -> name('admin/keluhan/edit');
        Route::post('admin/keluhan/show', [App\Http\Controllers\KeluhanController::class, 'showKeluhan']) -> name('admin/keluhan/show');

        Route::get('admin/tabulasi/{tahun}/{bulan}', [App\Http\Controllers\TabulasiController::class, 'index']);
        Route::post('admin/tabulasi/ganti_bulan_tahun', [App\Http\Controllers\TabulasiController::class, 'gantiBulanTahun']) -> name('admin/tabulasi/ganti_bulan_tahun');

        Route::get('admin/laporan/{tahun}/{bulan}/{status}', [App\Http\Controllers\LaporanController::class, 'index']);
        Route::post('admin/laporan/ganti_bulan', [App\Http\Controllers\LaporanController::class, 'gantiBulan']) -> name('admin/laporan/ganti_bulan');
        Route::post('admin/laporan/ganti_status', [App\Http\Controllers\LaporanController::class, 'gantiStatus']) -> name('admin/laporan/ganti_status');
        Route::post('admin/laporan/cetak_keluhan', [App\Http\Controllers\LaporanController::class, 'cetakKeluhan']) -> name('admin/laporan/cetak_keluhan');
        Route::post('admin/laporan/cetak_bulanan', [App\Http\Controllers\LaporanController::class, 'cetakBulanan']) -> name('admin/laporan/cetak_bulanan');

        Route::get('admin/master/pegawai', [App\Http\Controllers\Master\PegawaiController::class, 'index']) -> name('admin/master/pegawai');
        Route::post('admin/master/pegawai/tambah', [App\Http\Controllers\Master\PegawaiController::class, 'tambahPegawai']) -> name('admin/master/pegawai/tambah');
        Route::post('admin/master/pegawai/edit', [App\Http\Controllers\Master\PegawaiController::class, 'editPegawai']) -> name('admin/master/pegawai/edit');
        Route::post('admin/master/pegawai/show', [App\Http\Controllers\Master\PegawaiController::class, 'showPegawai']) -> name('admin/master/pegawai/show');

        Route::get('admin/master/permintaan', [App\Http\Controllers\Master\PermintaanController::class, 'index']) -> name('admin/master/permintaan');
        Route::post('admin/master/permintaan/tambah', [App\Http\Controllers\Master\PermintaanController::class, 'tambahPermintaan']) -> name('admin/master/permintaan/tambah');
        Route::post('admin/master/permintaan/edit', [App\Http\Controllers\Master\PermintaanController::class, 'editPermintaan']) -> name('admin/master/permintaan/edit');
        Route::post('admin/master/permintaan/show', [App\Http\Controllers\Master\PermintaanController::class, 'showPermintaan']) -> name('admin/master/permintaan/show');

        Route::get('admin/master/merk', [App\Http\Controllers\Master\MerkController::class, 'index']) -> name('admin/master/merk');
        Route::post('admin/master/merk/tambah', [App\Http\Controllers\Master\MerkController::class, 'tambahMerk']) -> name('admin/master/merk/tambah');
        Route::post('admin/master/merk/edit', [App\Http\Controllers\Master\MerkController::class, 'editMerk']) -> name('admin/master/merk/edit');
        Route::post('admin/master/merk/show', [App\Http\Controllers\Master\MerkController::class, 'showMerk']) -> name('admin/master/merk/show');

        Route::get('admin/master/type', [App\Http\Controllers\Master\TypeController::class, 'index']) -> name('admin/master/type');
        Route::post('admin/master/type/tambah', [App\Http\Controllers\Master\TypeController::class, 'tambahType']) -> name('admin/master/type/tambah');
        Route::post('admin/master/type/edit', [App\Http\Controllers\Master\TypeController::class, 'editType']) -> name('admin/master/type/edit');
        Route::post('admin/master/type/show', [App\Http\Controllers\Master\TypeController::class, 'showType']) -> name('admin/master/type/show');

        Route::get('admin/master/rekanan', [App\Http\Controllers\Master\RekananController::class, 'index']) -> name('admin/master/rekanan');
        Route::post('admin/master/rekanan/tambah', [App\Http\Controllers\Master\RekananController::class, 'tambahRekanan']) -> name('admin/master/rekanan/tambah');
        Route::post('admin/master/rekanan/edit', [App\Http\Controllers\Master\RekananController::class, 'editRekanan']) -> name('admin/master/rekanan/edit');
        Route::post('admin/master/rekanan/show', [App\Http\Controllers\Master\RekananController::class, 'showRekanan']) -> name('admin/master/rekanan/show');

        Route::get('admin/master/ruangan', [App\Http\Controllers\Master\RuanganController::class, 'index']) -> name('admin/master/ruangan');
        Route::post('admin/master/ruangan/tambah', [App\Http\Controllers\Master\RuanganController::class, 'tambahRuangan']) -> name('admin/master/ruangan/tambah');
        Route::post('admin/master/ruangan/edit', [App\Http\Controllers\Master\RuanganController::class, 'editRuangan']) -> name('admin/master/ruangan/edit');
        Route::post('admin/master/ruangan/show', [App\Http\Controllers\Master\RuanganController::class, 'showRuangan']) -> name('admin/master/ruangan/show');
    });

    // ipds
    Route::middleware(['role:2'])->group(function () {
        Route::get('ipds/keluhan', [App\Http\Controllers\KeluhanController::class, 'ipds']) -> name('ipds/keluhan');
        Route::post('ipds/keluhan/status', [App\Http\Controllers\KeluhanController::class, 'statusIpds']) -> name('ipds/keluhan/status');
        Route::post('ipds/keluhan/hapus', [App\Http\Controllers\KeluhanController::class, 'hapusKeluhan']) -> name('ipds/keluhan/hapus');
        Route::post('ipds/keluhan/edit', [App\Http\Controllers\KeluhanController::class, 'editKeluhan']) -> name('ipds/keluhan/edit');

        Route::get('ipds/tabulasi/{tahun}/{bulan}', [App\Http\Controllers\TabulasiController::class, 'index']);
        Route::post('ipds/tabulasi/ganti_bulan_tahun', [App\Http\Controllers\TabulasiController::class, 'gantiBulanTahun']) -> name('ipds/tabulasi/ganti_bulan_tahun');

        Route::get('ipds/laporan/{tahun}/{bulan}/{status}', [App\Http\Controllers\LaporanController::class, 'index']);
        Route::post('ipds/laporan/ganti_bulan', [App\Http\Controllers\LaporanController::class, 'gantiBulan']) -> name('ipds/laporan/ganti_bulan');
        Route::post('ipds/laporan/ganti_status', [App\Http\Controllers\LaporanController::class, 'gantiStatus']) -> name('ipds/laporan/ganti_status');
        Route::post('ipds/laporan/cetak_keluhan', [App\Http\Controllers\LaporanController::class, 'cetakKeluhan']) -> name('ipds/laporan/cetak_keluhan');
        Route::post('ipds/laporan/cetak_bulanan', [App\Http\Controllers\LaporanController::class, 'cetakBulanan']) -> name('ipds/laporan/cetak_bulanan');
    });

    // umum
    Route::middleware(['role:3'])->group(function () {
        Route::get('umum/keluhan', [App\Http\Controllers\KeluhanController::class, 'umum']) -> name('umum/keluhan');
        Route::post('umum/keluhan/approve', [App\Http\Controllers\KeluhanController::class, 'approveUmum']) -> name('umum/keluhan/approve');
        Route::post('umum/keluhan/status', [App\Http\Controllers\KeluhanController::class, 'statusUmum']) -> name('umum/keluhan/status');
        Route::post('umum/keluhan/hapus', [App\Http\Controllers\KeluhanController::class, 'hapusKeluhan']) -> name('umum/keluhan/hapus');
        Route::post('umum/keluhan/edit', [App\Http\Controllers\KeluhanController::class, 'editKeluhan']) -> name('umum/keluhan/edit');
    });
});