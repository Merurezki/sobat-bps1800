@extends('layouts.drawer')

@section('title', App\Models\Role::find(Auth::user()->userSobat->role)->nama_role.' | Master Rekanan')

@section('content')

@include('fragment.nav_master')

<!-- Awal table -->
<div class="card p-3">
    <div class="row">
        <div class="col-8">
            <h1>Rekanan</h1>
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-end">
                <!-- Tombol untuk menambahkan rekanan -->
                <button class="btn btn-success text-nowrap" data-toggle="modal" data-target="#tambahRekanan">
                Tambah Rekanan (+)
                </button>

                <!-- Modal tambah rekanan -->
                <div class="modal fade" id="tambahRekanan">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">

                            <!-- Modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Rekanan</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                    
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin/master/rekanan/tambah') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="nama">Nama Rekanan</label>
                                        <input id="nama" name="nama_rekanan" class="form-control" type="text" maxlength="100" placeholder="-Tulis Nama Rekanan-" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="alamat">Alamat Rekanan</label>
                                        <input id="alamat" name="alamat_rekanan" class="form-control" type="text" maxlength="255" placeholder="-Tulis Alamat Rekanan-" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="cp">Contact Person</label>
                                        <input id="cp" name="contact_person" class="form-control" type="text" maxlength="35" placeholder="-Tulis Contact Person-" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="no_cp">Nomor CP</label>
                                        <input id="no_cp" name="no_contact_person" class="form-control" type="text" maxlength="14" placeholder="-Tulis Nomor CP-" required>
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
            </div>
        </div>
    </div>

    <div>
        <table id="datatable" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Contact Person</th>
                    <th scope="col">Nomor CP</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($rekanans as $i => $rekanan)
                <tr>
                    <td>{{ ++$i }}</th>
                    <td>{{ $rekanan->nama_rekanan }}</td>
                    <td>{{ $rekanan->alamat_rekanan }}</td>
                    <td>{{ $rekanan->contact_person }}</td>
                    <td>{{ $rekanan->no_contact_person }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                            <!-- Tombol untuk mengedit rekanan -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editRekanan{{ $i }}"><i class="fas fa-edit"></i></button>

                            <!-- Modal edit rekanan -->
                            <div class="modal fade" id="editRekanan{{ $i }}">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">

                                        <!-- Modal header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Rekanan</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('admin/master/rekanan/edit') }}" enctype="multipart/form-data">
                                            @csrf
                                                <input name="id_rekanan" type="hidden" value="{{ $rekanan->id_rekanan }}">

                                                <div class="form-group">
                                                    <label for="nama{{ $i }}">Nama Rekanan</label>
                                                    <input id="nama{{ $i }}" name="nama_rekanan" class="form-control" type="text" maxlength="100" value="{{ $rekanan->nama_rekanan }}" required>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="alamat{{ $i }}">Alamat Rekanan</label>
                                                    <input id="alamat{{ $i }}" name="alamat_rekanan" class="form-control" type="text" maxlength="255" value="{{ $rekanan->alamat_rekanan }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="cp{{ $i }}">Contact Person</label>
                                                    <input id="cp{{ $i }}" name="contact_person" class="form-control" type="text" maxlength="35" value="{{ $rekanan->contact_person }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="no_cp{{ $i }}">Nomor CP</label>
                                                    <input id="no_cp{{ $i }}" name="no_contact_person" class="form-control" type="text" maxlength="14" value="{{ $rekanan->no_contact_person }}" required>
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

                            <!-- Tombol untuk menampilkan/menyembunyikan rekanan -->
                            <button id="buttonShow{{ $i }}" type="button" class="btn" value="{{ $rekanan->is_show }}"><i id="logoShow{{ $i }}" class="fa"></i></button>

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
                                    var id_rekanan   = "{{ $rekanan->id_rekanan }}";
                                    var nama_rekanan = "{{ $rekanan->nama_rekanan }}";

                                    if ($('#buttonShow{{ $i }}').val() == 0){
                                        var show_rekanan = 1;
                                    }

                                    if ($('#buttonShow{{ $i }}').val() == 1){
                                        var show_rekanan = 0;
                                    }
                            
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                            
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin/master/rekanan/show') }}",
                                        data: {
                                            id_rekanan: id_rekanan,
                                            nama_rekanan: nama_rekanan,
                                            show_rekanan: show_rekanan,
                                        },
                                        success: function (response) {
                                            if (response.msg != ''){
                                                $("#modalMsg{{ $i }}").html(response.msg);
                                                $("#modalShow{{ $i }}").modal('show');
                                                $('#buttonShow{{ $i }}').val(show_rekanan)

                                                if (show_rekanan == 0){
                                                    document.getElementById("buttonShow{{ $i }}").classList.remove("btn-info");
                                                    document.getElementById("logoShow{{ $i }}").classList.remove("fa-eye");
                                                    document.getElementById("buttonShow{{ $i }}").classList.add("btn-secondary");
                                                    document.getElementById("logoShow{{ $i }}").classList.add("fa-eye-slash");
                                                }
                                                if (show_rekanan == 1){
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
        document.getElementById("rekananButton").classList.add('active');
    });
</script>
@endsection