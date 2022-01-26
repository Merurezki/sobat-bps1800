@extends('layouts.drawer')

@section('title', App\Models\Role::find(Auth::user()->userSobat->role)->nama_role.' | Master Type')

@section('content')

@include('fragment.nav_master')

<!-- Awal table -->
<div class="card p-3">
    <div class="row">
        <div class="col-8">
            <h1>Type</h1>
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-end">
                <!-- Tombol untuk menambahkan type -->
                <button class="btn btn-success text-nowrap" data-toggle="modal" data-target="#tambahType">
                Tambah Type (+)
                </button>

                <!-- Modal tambah type -->
                <div class="modal fade" id="tambahType">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">

                            <!-- Modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Type</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                    
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form method="post" action="{{ route('admin/master/type/tambah') }} " enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="idJenis">Permintaan</label>
                                        <select id="idJenis" name="id_permintaan" class="form-control" required>
                                            <option value="" disabled selected>-Permintaan-</option>
                                            @foreach ($permintaans as $i => $permintaan)
                                                @if ($permintaan->nama_permintaan != 'Lainnya')
                                                    <option value="{{ $permintaan->id_permintaan }}">{{ $permintaan->nama_permintaan }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="idMerk">Merk</label>
                                        <div class="row">
                                            <div class="col-2 pr-2">
                                                <input id="idMerk" name="id_merk" list="idMerk_list" placeholder="-Kode-" class="form-control" required>
                                            </div>
                                            <div class="col pl-0">
                                                <input id="idMerk_text" type="text" value="-Nama Merk-" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <datalist id="idMerk_list">
                                            @foreach ($merks as $k => $merk)
                                            <option value="{{ $merk->id_merk }}">{{ $merk->nama_merk }}</option>
                                            @endforeach
                                        </datalist>
                
                                        <script type="text/javascript">
                                            $(document).on('change', '#idMerk', function () {
                                                var v = $("#idMerk_list option[value='" + $("#idMerk").val() + "']").text();
                                                $("#idMerk_text").val(v);
                                            });
                                        </script>
                                    </div>

                                    <div class="form-group">
                                        <label for="namaType">Nama Type</label>
                                        <input id="namaType" name="nama_type" class="form-control" type="text" maxlength="35" placeholder="-Tulis Nama Type-" required>
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
                    <th scope="col">Permintaan</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Type</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($types as $i => $type)
                <tr>
                    <td>{{ ++$i }}</th>
                    <td>{{ $type->nama_permintaan }}</td>
                    <td>{{ $type->nama_merk }}</td>
                    <td>{{ $type->nama_type }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">

                            <!-- Tombol untuk mengedit type -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editType{{ $i }}"><i class="fas fa-edit"></i></button>

                            <!-- Modal edit type -->
                            <div class="modal fade" id="editType{{ $i }}">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">

                                        <!-- Modal header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Type</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('admin/master/type/edit') }}" enctype="multipart/form-data">
                                            @csrf
                                                <input name="id_type" type="hidden" value="{{ $type->id_type }}">

                                                <div class="form-group">
                                                    <label for="idJenis{{ $i }}">Permintaan</label>
                                                    <select id="idJenis{{ $i }}" name="id_permintaan" class="form-control" required>
                                                    @foreach ($permintaans as $k => $permintaan)
                                                        @if($permintaan->nama_permintaan != 'Lainnya')
                                                            @if (($type->id_permintaan)==($permintaan->id_permintaan))
                                                            <option value="{{ $permintaan->id_permintaan }}" selected>{{ $permintaan->nama_permintaan }}</option>
                                                            @else
                                                            <option value="{{ $permintaan->id_permintaan }}">{{ $permintaan->nama_permintaan }}</option>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="idMerk{{ $i }}">Merk</label>
                                                    <div class="row">
                                                        <div class="col-2 pr-2">
                                                            <input id="idMerk{{ $i }}" name="id_merk" list="idMerk_list{{ $i }}" value="{{ $type->id_merk }}" class="form-control" required>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <input id="idMerk_text{{ $i }}" type="text" value="{{ $type->nama_merk }}" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <datalist id="idMerk_list{{ $i }}">
                                                        @foreach ($merks as $k => $merk)
                                                        <option value="{{ $merk->id_merk }}">{{ $merk->nama_merk }}</option>
                                                        @endforeach
                                                    </datalist>
                            
                                                    <script type="text/javascript">
                                                        $(document).on('change', '#idMerk{{ $i }}', function () {
                                                            var v = $("#idMerk_list{{ $i }} option[value='" + $("#idMerk{{ $i }}").val() + "']").text();
                                                            $("#idMerk_text{{ $i }}").val(v);
                                                        });
                                                    </script>
                                                </div>

                                                <div class="form-group">
                                                    <label for="namaType{{ $i }}">Nama Type</label>
                                                    <input id="namaType{{ $i }}" name="nama_type" class="form-control" type="text" maxlength="35" value="{{ $type->nama_type }}" required>
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

                            <!-- Tombol untuk menampilkan/menyembunyikan type -->
                            <button id="buttonShow{{ $i }}" type="button" class="btn" value="{{ $type->is_show }}"><i id="logoShow{{ $i }}" class="fa"></i></button>

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
                                    var id_type   = "{{ $type->id_type }}";
                                    var nama_type = "{{ $type->nama_type }}";

                                    if ($('#buttonShow{{ $i }}').val() == 0){
                                        var show_type = 1;
                                    }

                                    if ($('#buttonShow{{ $i }}').val() == 1){
                                        var show_type = 0;
                                    }
                            
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                            
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin/master/type/show') }}",
                                        data: {
                                            id_type: id_type,
                                            nama_type: nama_type,
                                            show_type: show_type,
                                        },
                                        success: function (response) {
                                            if (response.msg != ''){
                                                $("#modalMsg{{ $i }}").html(response.msg);
                                                $("#modalShow{{ $i }}").modal('show');
                                                $('#buttonShow{{ $i }}').val(show_type)

                                                if (show_type == 0){
                                                    document.getElementById("buttonShow{{ $i }}").classList.remove("btn-info");
                                                    document.getElementById("logoShow{{ $i }}").classList.remove("fa-eye");
                                                    document.getElementById("buttonShow{{ $i }}").classList.add("btn-secondary");
                                                    document.getElementById("logoShow{{ $i }}").classList.add("fa-eye-slash");
                                                }
                                                if (show_type == 1){
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
        document.getElementById("typeButton").classList.add('active');
    });
</script>
@endsection