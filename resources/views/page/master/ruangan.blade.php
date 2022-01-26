@extends('layouts.drawer')

@section('title', App\Models\Role::find(Auth::user()->userSobat->role)->nama_role.' | Master Ruangan')

@section('content')

@include('fragment.nav_master')

<!-- Awal table -->
<div class="card p-3">
    <div class="row">
        <div class="col-8">
            <h1>Ruangan</h1>
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-end">
                <!-- Tombol untuk menambahkan ruangan -->
                <button class="btn btn-success text-nowrap" data-toggle="modal" data-target="#tambahRuangan">
                Tambah Ruangan (+)
                </button>

                <!-- Modal tambah ruangan -->
                <div class="modal fade" id="tambahRuangan">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">

                            <!-- Modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Ruangan</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                    
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form id="formTambahRuangan" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="kodeRuangan">Kode Ruangan</label>
                                        <input id="kodeRuangan" name="kode_ruangan" class="form-control" type="number" maxlength="3" placeholder="-Tulis Kode Ruangan-" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="namaRuangan">Nama Ruangan</label>
                                        <input id="namaRuangan" name="nama_ruangan" class="form-control" type="text" maxlength="35" placeholder="-Tulis Nama Ruangan-" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="pjRuangan">PJ Ruangan</label>
                                        <div class="row">
                                            <div class="col-3 pr-2">
                                                <input id="pjRuangan" name="pj_ruangan" list="pjRuangan_list" placeholder="-NIP-" class="form-control" required>
                                            </div>
                                            <div class="col pl-0">
                                                <input id="pjRuangan_text" type="text" value="-Nama PJ Ruangan-" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <datalist id="pjRuangan_list">
                                            @foreach ($pegawais as $k => $pegawai)
                                            <option value="{{ $pegawai->id_user }}">{{ $pegawai->nip_lama }} - {{ $pegawai->nama }}</option>
                                            @endforeach
                                        </datalist>
                
                                        <script type="text/javascript">
                                            $(document).on('change', '#pjRuangan', function () {
                                                var v = $("#pjRuangan_list option[value='" + $("#pjRuangan").val() + "']").text();
                                                $("#pjRuangan_text").val(v);
                                            });
                                        </script>
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

                <div id="alertModal" class="modal fade">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <p id="alertMsg" class="modal-title text-center text-white"></p>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $('#formTambahRuangan').submit(function(e){
                        e.preventDefault();
                
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin/master/ruangan/tambah') }}",
                            data: {
                                kode_ruangan  : document.getElementById("kodeRuangan").value,
                                nama_ruangan  : document.getElementById("namaRuangan").value,
                                pj_ruangan    : document.getElementById("pjRuangan").value,
                            },
                            success: function (response) {
                                if (response.id == 'fail'){
                                    alert(response.msg);
                                }
                                if (response.id == 'success'){
                                    $("#alertMsg").html(response.msg);
                                    $("#alertModal").modal('show');
                                    setTimeout( function() { 
                                        window.location = "{{ route('admin/master/ruangan') }}";
                                    }, 1500);
                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>

    <div>
        <table id="datatable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Kode Ruangan</th>
                    <th scope="col">Nama Ruangan</th>
                    <th scope="col">PJ Ruangan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($ruangans as $i => $ruangan)
                <tr>
                    <td>{{ $ruangan->kode_ruangan }}</td>
                    <td>{{ $ruangan->nama_ruangan }}</td>
                    <td>{{ $ruangan->nama }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            
                            <!-- Tombol untuk mengedit ruangan -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editRuangan{{ $i }}"><i class="fas fa-edit"></i></button>

                            <!-- Modal edit ruangan -->
                            <div class="modal fade" id="editRuangan{{ $i }}">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">

                                        <!-- Modal header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Ruangan</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('admin/master/ruangan/edit') }}" enctype="multipart/form-data">
                                            @csrf
                                                <input name="kode_ruangan_lama" type="hidden" value="{{ $ruangan->kode_ruangan }}">

                                                <div class="form-group">
                                                    <label for="kodeRuangan{{ $i }}">Kode Ruangan</label>
                                                    <input id="kodeRuangan{{ $i }}" name="kode_ruangan_baru" class="form-control" type="number" maxlength="3" value="{{ $ruangan->kode_ruangan }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="namaRuangan{{ $i }}">Nama Ruangan</label>
                                                    <input id="namaRuangan{{ $i }}" name="nama_ruangan" class="form-control" type="text" maxlength="35" value="{{ $ruangan->nama_ruangan }}" required>
                                                </div>

                                                <input name="pj_ruangan_lama" type="hidden" value="{{ $ruangan->id_user }}">

                                                <div class="form-group">
                                                    <label for="pjRuangan{{ $i }}">PJ Ruangan</label>
                                                    <div class="row">
                                                        <div class="col-3 pr-2">
                                                            <input id="pjRuangan{{ $i }}" name="pj_ruangan_baru" list="pjRuangan_list{{ $i }}" value="{{ $ruangan->id_user }}" class="form-control" required>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <input id="pjRuangan_text{{ $i }}" type="text" value="{{ $ruangan->nip_lama }} - {{ $ruangan->nama }}" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <datalist id="pjRuangan_list{{ $i }}">
                                                        @foreach ($pegawais as $k => $pegawai)
                                                            @if ($pegawai->ruang == $ruangan->kode_ruangan)
                                                                <option value="{{ $pegawai->id_user }}">{{ $pegawai->nip_lama }} - {{ $pegawai->nama }}</option>
                                                            @endif
                                                        @endforeach
                                                    </datalist>
                            
                                                    <script type="text/javascript">
                                                        $(document).on('change', '#pjRuangan{{ $i }}', function () {
                                                            var v = $("#pjRuangan_list{{ $i }} option[value='" + $("#pjRuangan{{ $i }}").val() + "']").text();
                                                            $("#pjRuangan_text{{ $i }}").val(v);
                                                        });
                                                    </script>
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

                            <!-- Tombol untuk menampilkan/menyembunyikan ruangan -->
                            <button id="buttonShow{{ $i }}" type="button" class="btn" value="{{ $ruangan->is_show }}"><i id="logoShow{{ $i }}" class="fa"></i></button>

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
                                    var kode_ruangan = "{{ $ruangan->kode_ruangan }}";
                                    var nama_ruangan = "{{ $ruangan->nama_ruangan }}";

                                    if ($('#buttonShow{{ $i }}').val() == 0){
                                        var show_ruangan = 1;
                                    }

                                    if ($('#buttonShow{{ $i }}').val() == 1){
                                        var show_ruangan = 0;
                                    }
                            
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                            
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin/master/ruangan/show') }}",
                                        data: {
                                            kode_ruangan: kode_ruangan,
                                            nama_ruangan: nama_ruangan,
                                            show_ruangan: show_ruangan,
                                        },
                                        success: function (response) {
                                            if (response.msg != ''){
                                                $("#modalMsg{{ $i }}").html(response.msg);
                                                $("#modalShow{{ $i }}").modal('show');
                                                $('#buttonShow{{ $i }}').val(show_ruangan)

                                                if (show_ruangan == 0){
                                                    document.getElementById("buttonShow{{ $i }}").classList.remove("btn-info");
                                                    document.getElementById("logoShow{{ $i }}").classList.remove("fa-eye");
                                                    document.getElementById("buttonShow{{ $i }}").classList.add("btn-secondary");
                                                    document.getElementById("logoShow{{ $i }}").classList.add("fa-eye-slash");
                                                }
                                                if (show_ruangan == 1){
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
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<!-- Table end -->

<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById("ruanganButton").classList.add('active');
    });
</script>
@endsection