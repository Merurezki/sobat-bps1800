@extends('layouts.drawer')

@section('title', 'Umum | Keluhan')

@section('content')

<!-- Table -->
<div class="card p-2">
    <div class="row">
        <div class="col-8">
            <h1>Tabel Keluhan Umum</h1>
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
                        $notifUmum[$i] = DB::table('notifikasi_umum')
                        ->leftjoin('bmn_keluhan','notifikasi_umum.id_keluhan','=','bmn_keluhan.id_keluhan')
                        ->where('notifikasi_umum.id_keluhan', $keluhan->id_keluhan)
                        ->where('is_read', 0)
                        ->count();
                    @endphp
                    
                    @if ($notifUmum[$i]>0)
                        <span id="notifUmum{{ $i }}" class="badge rounded-pill bg-danger float-right">new</span>
                    @endif
                </td>

                <td>
                    @if ($keluhan->id_status==3)
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
                                            <form method="post" action="{{ route('umum/keluhan/approve') }}" enctype="multipart/form-data">
                                            @csrf
                                                <input type="hidden" value="{{ $keluhan->id_keluhan }}" name="id_keluhan">
                                                <input type="hidden" value="1" name="id_status">
                                                <div class="form-group">
                                                    <label for="catatanUmum2{{ $i }}" style="font-size:85%;">Tuliskan mengapa anda menolak keluhan ini?</label>
                                                    <textarea id="catatanUmum2{{ $i }}" name="catatan_umum" class="form-control" rows="2" required></textarea>
                                                </div>
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
                                            <form method="post" action="{{ route('umum/keluhan/approve') }}" enctype="multipart/form-data">
                                            @csrf
                                                <input type="hidden" value="{{ $keluhan->id_keluhan }}" name="id_keluhan">

                                                <div class="radio">
                                                    <label><input id="chkNo{{ $i }}" type="radio" name="id_status" value="4" class="mr-1" onclick="showBiaya{{ $i }}()" checked>Kirim form ke Fungsi IPDS</label>
                                                </div>

                                                <div class="radio">
                                                    <label><input id="chkYes{{ $i }}" type="radio" name="id_status" value="8" class="mr-1" onclick="showBiaya{{ $i }}()">Sudah selesai di Subfungsi Umum</label>
                                                </div>

                                                <div class="form-group">
                                                    <label for="catatanUmum1{{ $i }}" style="font-size:85%;">Tuliskan beberapa catatan pada keluhan ini? (jika tidak ada tulis '-')</label>
                                                    <textarea id="catatanUmum1{{ $i }}" name="catatan_umum" class="form-control" rows="2" required></textarea>
                                                </div>

                                                <div id="biayaDiv{{ $i }}" class="form-group" style="display:none;">
                                                    <label for="biaya{{ $i }}">Biaya (Rp)</label>
                                                    <input id="biaya{{ $i }}" name="biaya" class="form-control" type="number" min="0">
                                                </div>
                                        </div>
                                
                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>

                                        <script type="text/javascript">
                                            function showBiaya{{ $i }}(){
                                                var chkYes = document.getElementById("chkYes{{ $i }}");
                                                var div = document.getElementById("biayaDiv{{ $i }}");
                                                div.style.display = chkYes.checked ? "block" : "none";
                                                var input = document.getElementById("biaya{{ $i }}");
                                                input.required = chkYes.checked ? true : false;
                                            }
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal end -->
                        </div>
                    @endif

                    @if ($keluhan->id_status==1)
                        <b class="text-danger">Ditolak</b>
                    @endif

                    @if ($keluhan->id_status>=4)
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

                        <!-- Tampil Status---------------------------------------------------------------------------------------------------------------------------------------------- -->

                        @include('fragment.tampil_status')

                        <!-- Ubah Status------------------------------------------------------------------------------------------------------------------------------------------------- -->

                        @if (in_array($keluhan->id_status,array(7,8)))

                            <!-- Tombol ubah status keluhan -->
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ubahStatus{{ $i }}">
                                <i class="fas fa-tasks p-0"></i>
                            </button>                      

                            <!-- Modal ubah status keluhan -->
                            <div class="modal fade" id="ubahStatus{{ $i }}">
                                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">

                                        <!-- Modal header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Ubah Status</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('umum/keluhan/status') }}" enctype="multipart/form-data">
                                            @csrf
                                                <input type="hidden" value="{{ $keluhan->id_keluhan }}" name="id_keluhan">

                                                <div class="form-group">
                                                    <label>Nama Pelapor</label>
                                                    <input class="form-control" type="text" value="{{ $keluhan->pelapor }}" disabled></input>
                                                </div>

                                                <div class="form-group">
                                                    <label>Permintaan</label>
                                                    <input class="form-control" type="text" value="{{ $keluhan->nama_kategori_permintaan }} / {{ $keluhan->nama_permintaan }}" disabled></input>
                                                </div>

                                                @if (($keluhan->id_kategori_permintaan)==1)
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <input class="form-control" type="text" value="{{ $keluhan->nama_merk }} / {{ $keluhan->nama_type }}" disabled></input>
                                                    </div>
                                                @endif

                                                <div id="divIdStatus{{ $i }}" class="form-group">
                                                    <label for="idStatus{{ $i }}">Status</label>
                                                    <select id="idStatus{{ $i }}" name="id_status" class="form-control" required>
                                                        @if ($keluhan->id_status == 7)
                                                            <option disabled selected>Sudah selesai di Fungsi IPDS</option>
                                                        @elseif ($keluhan->id_status == 8)
                                                            <option disabled selected>Sudah selesai di Subfungsi Umum</option>
                                                        @endif
                                                        <option value="9">Sudah diambil oleh pemegang BMN</option>
                                                    </select>
                                                </div>

                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        var doc = document.getElementById("idStatus{{ $i }}");
                                                        var div = document.getElementById("divIdStatus{{ $i }}");
                                                        doc.addEventListener('change', function () {
                                                            var html;
                                                            html = '<div class="form-group">';
                                                            html+= '<label for="pemegangBMN{{ $i }}">Nama Pemegang BMN</label>';
                                                            html+= '<input id="pemegangBMN{{ $i }}" class="form-control" type="text" value="{{ $keluhan->pemegang_bmn }}" disabled></input>';
                                                            html+= '</div>';
                                                            $($(html)).insertAfter(div);
                                                        });
                                                    });
                                                </script>
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
                        @else
                            <button class="btn btn-secondary" disabled>
                                <i class="fas fa-tasks p-0"></i>
                            </button> 
                        @endif

                        <!-- Edit------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                        @if (($keluhan->id_umum == Auth::user()->userSobat->id AND in_array($keluhan->id_status,array(1,5,6,7,8,9))) OR in_array($keluhan->id_status,array(3)))

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
        $('#umumPage').addClass("active");
    });
</script>
@endsection