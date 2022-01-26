@extends('layouts.drawer')

@section('title', 'PJ Ruang | Keluhan')

@section('content')

<!-- Table -->
<div class="card p-2">
    <div class="row">
        <div class="col-8">
            <h1>Tabel Keluhan PJ Ruang {{ App\Models\Ruang::find(Auth::user()->userSobat->ruang)->nama_ruangan }}</h1>
        </div>
    </div>

    <table id="datatable" class="table table-striped table-hover">

        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Approve</th>
                <th scope="col">Unique Code</th>
                <th scope="col">Pelapor</th>
                <th scope="col">Permintaan</th>
                <th scope="col">Type</th>
                <th scope="col">Permasalahan</th>
                <th scope="col">Tanggal Laporan</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($keluhans as $i => $keluhan)
            <tr>
                <td>
                    {{ ++$i }}

                    @php
                        $notifPj[$i] = DB::table('notifikasi_pjruang')
                        ->leftjoin('bmn_keluhan','notifikasi_pjruang.id_keluhan','=','bmn_keluhan.id_keluhan')
                        ->where('notifikasi_pjruang.id_keluhan', $keluhan->id_keluhan)
                        ->where('is_read', 0)
                        ->count();
                    @endphp
                    
                    @if ($notifPj[$i]>0)
                        <span id="notifPj{{ $i }}" class="badge rounded-pill bg-danger float-right">new</span>
                    @endif
                </td>

                {{-- ------------------------------------------------------------------------------------------------ --}}

                <td>
                    @if ($keluhan->id_status==2)
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#tolakKeluhan{{ $i }}"><i class="fa fa-times p-0"></i></button>

                            <!-- Modal tolak keluhan -->
                            <div class="modal fade" id="tolakKeluhan{{ $i }}">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">

                                        <!-- Modal header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Tolak Keluhan</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('pj_ruang/keluhan/approve') }}" enctype="multipart/form-data">
                                            @csrf
                                                <input type="hidden" value="{{ $keluhan->id_keluhan }}" name="id_keluhan">
                                                <input type="hidden" value="1" name="id_status">
                                                Anda yakin menolak permintaan ini?
                                        </div>
                                
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal end -->

                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#terimaKeluhan{{ $i }}"><i class="fa fa-check p-0"></i></button>

                            <!-- Modal terima keluhan -->
                            <div class="modal fade" id="terimaKeluhan{{ $i }}">
                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">

                                        <!-- Modal header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Terima Keluhan</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('pj_ruang/keluhan/approve') }}" enctype="multipart/form-data">
                                            @csrf
                                                <input type="hidden" value="{{ $keluhan->id_keluhan }}" name="id_keluhan">
                                                <input type="hidden" value="3" name="id_status">
                                                Anda yakin menerima permintaan ini dan melanjutkan ke Subfungsi Umum?
                                        </div>
                                
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal end -->
                        </div>
                    @endif

                    @if ($keluhan->id_status==1)
                        <b class="text-danger">Ditolak</b>
                    @endif

                    @if ($keluhan->id_status>=3)
                        <b class="text-success">Diterima</b>
                    @endif
                </td>

                {{-- ------------------------------------------------------------------------------------------------ --}}

                <td>{{ $keluhan->unique_code }}</td>

                {{-- ------------------------------------------------------------------------------------------------ --}}

                <td>{{ $keluhan->pelapor }}</td>

                {{-- ------------------------------------------------------------------------------------------------ --}}

                <td>
                    <b>{{ $keluhan->nama_kategori_permintaan }}</b> </br> 
                    @if (is_null($keluhan->permintaan_lainnya))
                        {{ $keluhan->nama_permintaan }}
                    @else
                        {{ $keluhan->permintaan_lainnya }}
                    @endif
                </td>

                {{-- ------------------------------------------------------------------------------------------------ --}}

                @if (is_null($keluhan->id_type))
                    <td>-</td>
                @elseif (is_null($keluhan->type_lainnya))
                    <td>{{ $keluhan->nama_merk }} - {{ $keluhan->nama_type }}</td>
                @else
                    <td>{{ $keluhan->type_lainnya }}</td>
                @endif

                {{-- ------------------------------------------------------------------------------------------------ --}}

                <td>{{ $keluhan->masalah }}</td>

                {{-- ------------------------------------------------------------------------------------------------ --}}

                <td>{{ \Carbon\Carbon::parse($keluhan->tgl_laporan)->format('Y-m-d H:i:s') }}</td>

                {{-- ------------------------------------------------------------------------------------------------ --}}

                <td>{{ $keluhan->nama_status }}</td>

                {{-- ------------------------------------------------------------------------------------------------ --}}
                
                <td>
                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                        @include('fragment.tampil_status')

                        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                        @if (in_array($keluhan->id_status,array(2)))

                            @include('fragment.edit_keluhan')

                        @else

                            <button class="btn btn-secondary" disabled><i class="fas fa-edit p-0"></i></button>

                        @endif

                        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
<!-- Table end -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#pjRuangPage').addClass("active");
    });
</script>
@endsection