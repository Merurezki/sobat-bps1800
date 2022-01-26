@extends('layouts.drawer')

@section('title', App\Models\Role::find(Auth::user()->userSobat->role)->nama_role.' | Master Merk')

@section('content')

@include('fragment.nav_master')

<!-- Awal table -->
<div class="card p-3">
    <div class="row">
        <div class="col-8">
            <h1>Merk</h1>
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-end">
                <!-- Tombol untuk menambahkan merk baru -->
                <button class="btn btn-success text-nowrap" data-toggle="modal" data-target="#tambahMerk">
                Tambah Merk (+)
                </button>

                <!-- Modal tambah merk -->
                <div class="modal fade" id="tambahMerk">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">

                            <!-- Modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Merk</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                    
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin/master/merk/tambah') }} " enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="namaMerk">Nama Merk</label>
                                        <input id="namaMerk" name="nama_merk" class="form-control" type="text" maxlength="255" placeholder="-Tulis Nama Merk-" required>
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
                    <th scope="col">Merk</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($merks as $i => $merk)
                <tr>
                    <td>{{ ++$i }}</th>
                    <td>{{ $merk->nama_merk }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                            <!-- Tombol untuk mengedit merk -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editMerk{{ $i }}"><i class="fas fa-edit"></i></button>

                            <!-- Modal edit merk -->
                            <div class="modal fade" id="editMerk{{ $i }}">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">

                                        <!-- Modal header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Merk</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('admin/master/merk/edit') }}" enctype="multipart/form-data">
                                            @csrf
                                                <input name="id_merk" type="hidden" value="{{ $merk->id_merk }}">

                                                <div class="form-group">
                                                    <label for="namaMerk{{ $i }}">Nama Merk</label>
                                                    <input id="namaMerk{{ $i }}" name="nama_merk" class="form-control" type="text" maxlength="255" value="{{ $merk->nama_merk }}" required>
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

                            <!-- Tombol untuk menampilkan/menyembunyikan merk -->
                            <button id="buttonShow{{ $i }}" type="button" class="btn" value="{{ $merk->is_show }}"><i id="logoShow{{ $i }}" class="fa"></i></button>

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
                                    var id_merk   = "{{ $merk->id_merk }}";
                                    var nama_merk = "{{ $merk->nama_merk }}";

                                    if ($('#buttonShow{{ $i }}').val() == 0){
                                        var show_merk = 1;
                                    }

                                    if ($('#buttonShow{{ $i }}').val() == 1){
                                        var show_merk = 0;
                                    }
                            
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                            
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin/master/merk/show') }}",
                                        data: {
                                            id_merk: id_merk,
                                            nama_merk: nama_merk,
                                            show_merk: show_merk,
                                        },
                                        success: function (response) {
                                            if (response.msg != ''){
                                                $("#modalMsg{{ $i }}").html(response.msg);
                                                $("#modalShow{{ $i }}").modal('show');
                                                $('#buttonShow{{ $i }}').val(show_merk)

                                                if (show_merk == 0){
                                                    document.getElementById("buttonShow{{ $i }}").classList.remove("btn-info");
                                                    document.getElementById("logoShow{{ $i }}").classList.remove("fa-eye");
                                                    document.getElementById("buttonShow{{ $i }}").classList.add("btn-secondary");
                                                    document.getElementById("logoShow{{ $i }}").classList.add("fa-eye-slash");
                                                }
                                                if (show_merk == 1){
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
        document.getElementById("merkButton").classList.add('active');
    });
</script>

@endsection