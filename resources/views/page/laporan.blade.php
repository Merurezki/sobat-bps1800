@extends('layouts.drawer')

@section('title', App\Models\Role::find(Auth::user()->userSobat->role)->nama_role.' | Laporan')

@section('content')
<!-- Table -->
<div class="card p-2">
    <div class="row mb-2">
        <div class="col-6">
            <h1>Tabel Laporan</h1>
            <span>
                <form id="formGantiStatus" method="post" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" name="bulan_laporan" value="{{ \Carbon\Carbon::parse($monYears)->format('Y-m') }}">
                    <select id="idStatus" name="id_status" required>
                        <option value="0" selected>Semua status</option>
                        @foreach ($statuss as $k => $status)
                            @if ($status->id_status == $id_status)
                                <option value="{{ $status->id_status }}" selected>{{ $status->nama_status }}</option>
                            @else
                                <option value="{{ $status->id_status }}">{{ $status->nama_status }}</option>
                            @endif
                        @endforeach
                    </select>
                </form>
            </span>
        </div>
        <div class="col-6 clearfix">
            <span class="float-right pr-1">
                <form id="formCetakBulanan" method="post" target="_blank" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" name="bulan_laporan" value="{{ \Carbon\Carbon::parse($monYears)->format('Y-m') }}">
                    <button type="submit" class="btn btn-success">
                        <b>Cetak Laporan Bulanan</b>
                    </button>
                </form>
            </span>
            </br></br>
            <span class="float-right mr-2">
                <form id="formGantiBulan" method="post" enctype="multipart/form-data">
                @csrf
                    <input id="bulanLaporan" type="month" name="bulan_laporan" value="{{ \Carbon\Carbon::parse($monYears)->format('Y-m') }}">
                </form>
            </span>
        </div>
    </div>

    <table id="datatable" class="table table-striped table-hover">
        <thead style="font-size:80%;">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Unique Code</th>
                @foreach ($statuss as $i => $status)
                    @if ($status->id_status!=1)
                    <th scope="col">{{ $status->nama_status }}</th>
                    @endif
                @endforeach
                <th scope="col">Biaya</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody style="font-size:80%;">
        @foreach ($keluhans as $i => $keluhan)
            <tr>
                <td>{{ ++$i }}</td>

                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#infoKeluhan{{ $i }}">
                        {{ $keluhan->unique_code }}
                    </button>
                </td>

                <!-- Modal -->
                <div id="infoKeluhan{{ $i }}" class="modal fade">
                    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Keluhan #{{ $keluhan->unique_code }}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Pelapor</label>
                                    <input class="form-control" type="text" value="{{ $keluhan->pelapor }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Permintaan</label>
                                    @if (is_null($keluhan->permintaan_lainnya))
                                        <input class="form-control" type="text" value="{{ $keluhan->nama_kategori_permintaan }} - {{ $keluhan->nama_permintaan }}" disabled>
                                    @else
                                        <input class="form-control" type="text" value="{{ $keluhan->nama_kategori_permintaan }} - {{ $keluhan->permintaan_lainnya }}" disabled>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if (!is_null($keluhan->id_type))
                                        <label>Type Barang</label>
                                        @if (is_null($keluhan->type_lainnya))
                                            <input class="form-control" type="text" value="{{ $keluhan->nama_merk }} - {{ $keluhan->nama_type }}" disabled>
                                        @else
                                            <input class="form-control" type="text" value="{{ $keluhan->type_lainnya }}" disabled>
                                        @endif
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>Permasalahan</label>
                                    <input class="form-control" type="text" value="{{ $keluhan->masalah }}" disabled>
                                </div>
                                <div class="form-group">
                                    @if (!is_null($keluhan->id_umum))
                                        <label>Admin Subfungsi Umum</label>
                                        <input class="form-control" type="text" value="{{ $keluhan->umum }}" disabled>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if (!is_null($keluhan->catatan_umum))
                                        <label>Catatan Subfungsi Umum</label>
                                        <input class="form-control" type="text" value="{{ $keluhan->catatan_umum }}" disabled>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if (!is_null($keluhan->id_ipds))
                                        <label>Admin Fungsi IPDS</label>
                                        <input class="form-control" type="text" value="{{ $keluhan->ipds }}" disabled>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if (!is_null($keluhan->catatan_ipds))
                                        <label>Catatan Fungsi IPDS</label>
                                        <input class="form-control" type="text" value="{{ $keluhan->catatan_ipds }}" disabled>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if (!is_null($keluhan->id_rekanan))
                                        <label>Rekanan</label>
                                        <input class="form-control" type="text" value="{{ $keluhan->nama_rekanan }}" disabled>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if (!is_null($keluhan->catatan_rekanan))
                                        <label>Catatan Rekanan</label>
                                        <input class="form-control" type="text" value="{{ $keluhan->catatan_rekanan }}" disabled>
                                    @endif
                                </div>
                                <div class="form-group">
                                    @if (!is_null($keluhan->biaya))
                                        <label>Biaya (Rp)</label>
                                        <input class="form-control" type="text" value="{{ $keluhan->biaya }}" disabled>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Tanggal Laporan---------------------------------------------------------------------------------- -->
                
                @if ($keluhan->id_status==1 AND is_null($keluhan->id_umum))
                    <td>{{ \Carbon\Carbon::parse($keluhan->tgl_laporan)->isoFormat('DD MMMM Y') }}<br><b class="text-danger">ditolak pj</b></td>
                @else
                    <td>{{ \Carbon\Carbon::parse($keluhan->tgl_laporan)->isoFormat('DD MMMM Y') }}</td>
                @endif

                <!-- Tanggal Approve PJ------------------------------------------------------------------------------- -->

                @if (is_null($keluhan->tgl_approve_pj) OR ($keluhan->id_status==1 AND is_null($keluhan->tgl_approve_umum)))
                    <td>-</td>
                @elseif ($keluhan->id_status==1 AND is_null($keluhan->tgl_proses_ipds))
                    <td>{{ \Carbon\Carbon::parse($keluhan->tgl_approve_pj)->isoFormat('DD MMMM Y') }}<br><b class="text-danger">ditolak umum</b></td>
                @else
                    <td>{{ \Carbon\Carbon::parse($keluhan->tgl_approve_pj)->isoFormat('DD MMMM Y') }}</td>
                @endif

                <!-- Tanggal Approve Umum----------------------------------------------------------------------------- -->

                @if (is_null($keluhan->tgl_approve_umum) OR $keluhan->id_status==1)
                    <td>-</td>
                @elseif (is_null($keluhan->tgl_approve_umum) AND !is_null($keluhan->tgl_selesai))
                    <td>{{ \Carbon\Carbon::parse($keluhan->tgl_selesai)->format('Y-m-d H:i:s') }}</td>
                @else
                    <td>{{ \Carbon\Carbon::parse($keluhan->tgl_approve_umum)->format('Y-m-d H:i:s') }}</td>
                @endif

                <!-- Tanggal Proses IPDS------------------------------------------------------------------------------ -->

                @if (is_null($keluhan->tgl_proses_ipds))
                    <td>-</td>
                @else
                    <td>{{ \Carbon\Carbon::parse($keluhan->tgl_proses_ipds)->format('Y-m-d H:i:s') }}</td>
                @endif

                <!-- Tanggal Kirim Rekanan---------------------------------------------------------------------------- -->

                @if (is_null($keluhan->tgl_kirim_rekanan))
                    <td>-</td>
                @else
                    <td>{{ \Carbon\Carbon::parse($keluhan->tgl_kirim_rekanan)->format('Y-m-d H:i:s') }}</td>
                @endif

                <!-- Tanggal Selesai di IPDS-------------------------------------------------------------------------- -->

                @if (is_null($keluhan->tgl_selesai) OR (!is_null($keluhan->tgl_selesai) AND is_null($keluhan->id_ipds)))
                    <td>-</td>
                @else
                    <td>{{ \Carbon\Carbon::parse($keluhan->tgl_selesai)->format('Y-m-d H:i:s') }}</td>
                @endif

                <!-- Tanggal Selesai di Umum-------------------------------------------------------------------------- -->

                @if (is_null($keluhan->tgl_selesai))
                    <td>-</td>
                @else
                    <td>{{ \Carbon\Carbon::parse($keluhan->tgl_selesai)->format('Y-m-d H:i:s') }}</td>
                @endif

                <!-- Tanggal Diambil Pemegang BMN--------------------------------------------------------------------- -->

                @if (is_null($keluhan->tgl_diambil))
                    <td>-</td>
                @else
                    <td>{{ \Carbon\Carbon::parse($keluhan->tgl_diambil)->format('Y-m-d H:i:s') }}</td>
                @endif

                <!-- Biaya-------------------------------------------------------------------------------------------- -->

                @if (is_null($keluhan->biaya))
                    <td>-</td>
                @else
                    <td>{{ $keluhan->biaya }}</td>
                @endif

                <!-- Cetak-------------------------------------------------------------------------------------------- -->

                <td>
                    @if ($keluhan->id_status == 9)
                        <form id="formCetakKeluhan{{ $i }}" method="post" target="_blank" enctype="multipart/form-data">
                        @csrf
                            <input type="hidden" name="id_keluhan" value="{{ $keluhan->id_keluhan }}">
                            <button type="submit" class="btn btn-info">
                                <i class="fa fa-print p-0"></i>
                            </button>
                        </form>

                        <script type="text/javascript">    
                            $(document).ready(function() {
                                @if (Auth::user()->userSobat->role == 1)
                                    document.getElementById("formCetakKeluhan{{ $i }}").action = "{{ route('admin/laporan/cetak_keluhan') }}";
                                @elseif (Auth::user()->userSobat->role == 2)
                                    document.getElementById("formCetakKeluhan{{ $i }}").action = "{{ route('ipds/laporan/cetak_keluhan') }}";
                                @endif
                            });
                        </script>
                    @else
                        <button class="btn btn-secondary" disabled>
                            <i class="fa fa-print p-0"></i>
                        </button>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- Table end -->

<script type="text/javascript">    
    $(document).ready(function() {
        document.getElementById("laporanPage").classList.add('active');

        @if (Auth::user()->userSobat->role == 1)
            document.getElementById("formGantiStatus").action = "{{ route('admin/laporan/ganti_status') }}";
            document.getElementById("formGantiBulan").action  = "{{ route('admin/laporan/ganti_bulan') }}";
            document.getElementById("formCetakBulanan").action = "{{ route('admin/laporan/cetak_bulanan') }}";
        @elseif (Auth::user()->userSobat->role == 2)
            document.getElementById("formGantiStatus").action = "{{ route('ipds/laporan/ganti_status') }}";
            document.getElementById("formGantiBulan").action  = "{{ route('ipds/laporan/ganti_bulan') }}";
            document.getElementById("formCetakBulanan").action = "{{ route('ipds/laporan/cetak_bulanan') }}";
        @endif
        
        $('#bulanLaporan').change(function () {
            this.form.submit();        
        });

        $('#idStatus').change(function () {
            this.form.submit();        
        });
    });
</script>
@endsection