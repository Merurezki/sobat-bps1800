@extends('layouts.drawer')

@section('title', App\Models\Role::find(Auth::user()->userSobat->role)->nama_role.' | Master Permintaan')

@section('content')

@include('fragment.nav_master')

<!-- Awal table -->
<div class="card p-3">
    <div class="row">
        <div class="col-8">
            <h1>Permintaan</h1>
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-end">
                <!-- Tombol untuk menambah jenis permintaan -->
                <button class="btn btn-success text-nowrap" data-toggle="modal" data-target="#tambahPermintaan">
                Tambah Permintaan (+)
                </button>

                <!-- Modal tambah jenis permintaan -->
                <div class="modal fade" id="tambahPermintaan">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">

                            <!-- Modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Permintaan</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                    
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin/master/permintaan/tambah') }} " enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="idKategori">Kategori Permintaan</label>
                                        <select id="idKategori" name="id_kategori_permintaan" class="form-control" required>
                                            <option value="" disabled selected>-Kategori Permintaan-</option>
                                            @foreach ($kat_permintaans as $i => $kat_permintaan)
                                            <option value="{{ $kat_permintaan->id_kategori_permintaan }}">{{ $kat_permintaan->nama_kategori_permintaan }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="namaPermintaan">Nama Permintaan</label>
                                        <input id="namaPermintaan" name="nama_permintaan" class="form-control" type="text" maxlength="35" placeholder="-Tulis Jenis Permintaan-" required>
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
                    <th scope="col">Kategori Permintaan</th>
                    <th scope="col">Nama Permintaan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($permintaans as $i => $permintaan)
                <tr>
                    <td>{{ ++$i }}</th>
                    <td>{{ $permintaan->nama_kategori_permintaan }}</td>
                    <td>{{ $permintaan->nama_permintaan }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                            <!-- Tombol untuk mengedit jenis permintaan -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editPermintaan{{ $i }}"><i class="fas fa-edit"></i></button>

                            <!-- Modal edit jenis permintaan -->
                            <div class="modal fade" id="editPermintaan{{ $i }}">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Permintaan</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('admin/master/permintaan/edit') }}" enctype="multipart/form-data">
                                            @csrf
                                                <input name="id_permintaan" type="hidden" value="{{ $permintaan->id_permintaan }}">

                                                <div class="form-group">
                                                    <label for="idKategori{{ $i }}">Kategori Permintaan</label>
                                                    <select id="idKategori{{ $i }}" name="id_kategori_permintaan" class="form-control" required>
                                                    @foreach ($kat_permintaans as $k => $kat_permintaan)
                                                        @if (($permintaan->id_kategori_permintaan)==($kat_permintaan->id_kategori_permintaan))
                                                        <option value="{{ $kat_permintaan->id_kategori_permintaan }}" selected>{{ $kat_permintaan->nama_kategori_permintaan }}</option>
                                                        @else
                                                        <option value="{{ $kat_permintaan->id_kategori_permintaan }}">{{ $kat_permintaan->nama_kategori_permintaan }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="namaPermintaan{{ $i }}">Nama Permintaan</label>
                                                    <input id="namaPermintaan{{ $i }}" name="nama_permintaan" class="form-control" type="text" maxlength="35" value="{{ $permintaan->nama_permintaan }}" required>
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

                            <!-- Tombol untuk menampilkan/menyembunyikan permintaan -->
                            <button id="buttonShow{{ $i }}" type="button" class="btn" value="{{ $permintaan->is_show }}"><i id="logoShow{{ $i }}" class="fa"></i></button>

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
                                    var id_permintaan   = "{{ $permintaan->id_permintaan }}";
                                    var nama_permintaan = "{{ $permintaan->nama_permintaan }}";

                                    if ($('#buttonShow{{ $i }}').val() == 0){
                                        var show_permintaan = 1;
                                    }

                                    if ($('#buttonShow{{ $i }}').val() == 1){
                                        var show_permintaan = 0;
                                    }
                            
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                            
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin/master/permintaan/show') }}",
                                        data: {
                                            id_permintaan: id_permintaan,
                                            nama_permintaan: nama_permintaan,
                                            show_permintaan: show_permintaan,
                                        },
                                        success: function (response) {
                                            if (response.msg != ''){
                                                $("#modalMsg{{ $i }}").html(response.msg);
                                                $("#modalShow{{ $i }}").modal('show');
                                                $('#buttonShow{{ $i }}').val(show_permintaan)

                                                if (show_permintaan == 0){
                                                    document.getElementById("buttonShow{{ $i }}").classList.remove("btn-info");
                                                    document.getElementById("logoShow{{ $i }}").classList.remove("fa-eye");
                                                    document.getElementById("buttonShow{{ $i }}").classList.add("btn-secondary");
                                                    document.getElementById("logoShow{{ $i }}").classList.add("fa-eye-slash");
                                                }
                                                if (show_permintaan == 1){
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
        document.getElementById("permintaanButton").classList.add('active');
    });
</script>
@endsection