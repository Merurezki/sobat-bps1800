@extends('layouts.drawer')

@section('title', 'Admin | Keluhan')

@section('content')

<!-- Table -->
<div class="card p-2">
    <div class="row">
        <div class="col-8">
            <h1>Tabel Keluhan Admin</h1>
        </div>
    </div>

    <table id="datatable" class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Unique Code</th>
                <th scope="col">Pelapor</th>
                <th scope="col">Permintaan</th>
                <th scope="col">Type</th>
                <th scope="col">Permasalahan</th>
                <th scope="col">Tanggal Laporan</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                <th scope="col">Visible</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($keluhans as $i => $keluhan)
            <tr>
                <td>
                    {{ ++$i }}

                    @php
                        $notifAdmin[$i] = DB::table('notifikasi_ipds')
                        ->leftjoin('bmn_keluhan','notifikasi_ipds.id_keluhan','=','bmn_keluhan.id_keluhan')
                        ->where('notifikasi_ipds.id_keluhan', $keluhan->id_keluhan)
                        ->where('is_read', 0)
                        ->count();
                    @endphp
                    
                    @if ($notifAdmin[$i]>0)
                        <span id="notifAdmin{{ $i }}" class="badge rounded-pill bg-danger float-right">new</span>
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

                        @include('fragment.tampil_status')

                        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                        @include('fragment.status_ipds')

                        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                        @include('fragment.hapus_keluhan')

                        <!-- ----------------------------------------------------------------------------------------------------------------------------------------------------------- -->

                        @include('fragment.edit_keluhan')

                    </div>
                </td>

                {{-- ------------------------------------------------------------------------------------------------ --}}

                <td>
                    <!-- Tombol untuk menampilkan/menyembunyikan keluhan -->
                    <button id="buttonShow{{ $i }}" type="button" class="btn" value="{{ $keluhan->is_show }}"><i id="logoShow{{ $i }}" class="fa"></i></button>

                    <div id="modalShow{{ $i }}" class="modal fade">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-warning">
                                    <p id="modalMsg{{ $i }}" class="modal-title"></p>
                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script type="text/javascript">
                        if ($('#buttonShow{{ $i }}').val() == 0){
                            document.getElementById("buttonShow{{ $i }}").classList.add("btn-secondary");
                            document.getElementById("logoShow{{ $i }}").classList.add("fa-eye-slash");
                        }
                        if ($('#buttonShow{{ $i }}').val() == 1){
                            document.getElementById("buttonShow{{ $i }}").classList.add("btn-info");
                            document.getElementById("logoShow{{ $i }}").classList.add("fa-eye");
                        }

                        $('#buttonShow{{ $i }}').click(function(e){
                            e.preventDefault();
                            var id_keluhan   = "{{ $keluhan->id_keluhan }}";

                            if ($('#buttonShow{{ $i }}').val() == 0){
                                var show_keluhan = 1;
                            }

                            if ($('#buttonShow{{ $i }}').val() == 1){
                                var show_keluhan = 0;
                            }
                    
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                    
                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin/keluhan/show') }}",
                                data: {
                                    id_keluhan: id_keluhan,
                                    show_keluhan: show_keluhan,
                                },
                                success: function (response) {
                                    if (response.msg != ''){
                                        $("#modalMsg{{ $i }}").html(response.msg);
                                        $("#modalShow{{ $i }}").modal('show');
                                        $('#buttonShow{{ $i }}').val(show_keluhan)

                                        if (show_keluhan == 0){
                                            document.getElementById("buttonShow{{ $i }}").classList.remove("btn-info");
                                            document.getElementById("logoShow{{ $i }}").classList.remove("fa-eye");
                                            document.getElementById("buttonShow{{ $i }}").classList.add("btn-secondary");
                                            document.getElementById("logoShow{{ $i }}").classList.add("fa-eye-slash");
                                        }
                                        if (show_keluhan == 1){
                                            document.getElementById("buttonShow{{ $i }}").classList.remove("btn-secondary");
                                            document.getElementById("logoShow{{ $i }}").classList.remove("fa-eye-slash");
                                            document.getElementById("buttonShow{{ $i }}").classList.add("btn-info");
                                            document.getElementById("logoShow{{ $i }}").classList.add("fa-eye");
                                        }
                                    }
                                }
                            });
                        });
                    </script>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<!-- Table end -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#adminPage').addClass("active");
    });
</script>
@endsection