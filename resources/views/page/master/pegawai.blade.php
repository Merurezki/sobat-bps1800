@extends('layouts.drawer')

@section('title', App\Models\Role::find(Auth::user()->userSobat->role)->nama_role.' | Master Pegawai')

@section('content')

@include('fragment.nav_master')

<!-- Table start -->
<div class="card p-3">
    <div class="row">
        <div class="col-8">
            <h1>Pegawai</h1>
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-end">
                <!-- Tombol untuk menambah pegawai -->
                <button class="btn btn-success text-nowrap" data-toggle="modal" data-target="#tambahPegawai">
                Tambah Pegawai (+)
                </button>

                <!-- Modal tambah pegawai -->
                <div class="modal fade" id="tambahPegawai">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">

                            <!-- Modal header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Tambah Pegawai</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                    
                            <!-- Modal body -->
                            <div class="modal-body">
                                <form id="formTambahPegawai" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="nip_lama">NIP Lama</label>
                                        <input id="nip_lama" name="nip_lama" class="form-control" type="number" min="0" maxlength="9" placeholder="-NIP Lama-" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="nip_baru">NIP Baru</label>
                                        <input id="nip_baru" name="nip_baru" class="form-control" type="number" min="0" maxlength="18" placeholder="-NIP Baru-" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="nama_pegawai">Nama</label>
                                        <input id="nama_pegawai" name="nama_pegawai" class="form-control" type="text" maxlength="255" placeholder="-Nama Lengkap-" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email BPS</label>
                                        <input id="email" name="email" class="form-control" type="email" maxlength="100" placeholder="-Email BPS-" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="golpangkat">Golongan Pangkat</label>
                                        <select id="golpangkat" name="golpangkat" class="form-control" required>
                                            <option value="" disabled selected>-Golongan Pangkat-</option>
                                            @foreach ($golpangkats as $k => $golpangkat)
                                                <option value="{{ $golpangkat->id }}">{{ $golpangkat->golongan }} - {{ $golpangkat->pangkat }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="subfungsi">Subfungsi</label>
                                        <select id="subfungsi" name="subfungsi" class="form-control" required>
                                            <option value="" disabled selected>-Subfungsi-</option>
                                            @foreach ($subfungsis as $k => $subfungsi)
                                                <option value="{{ $subfungsi->id_sub_fungsi }}">{{ $subfungsi->nama_fungsi }} - {{ $subfungsi->nama_sub_fungsi }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="struktural">Struktural</label>
                                        <select id="struktural" name="struktural" class="form-control" required>
                                            <option value="" disabled selected>-Struktural-</option>
                                            @foreach ($strukturals as $k => $struktural)
                                                <option value="{{ $struktural->id }}">{{ $struktural->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="fungsional">Fungsional</label>
                                        <select id="fungsional" name="fungsional" class="form-control" required>
                                            <option value="" disabled selected>-Fungsional-</option>
                                            @foreach ($fungsionals as $k => $fungsional)
                                                <option value="{{ $fungsional->id }}">{{ $fungsional->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="jenjang">Jenjang Fungsional</label>
                                        <select id="jenjang" name="jenjang" class="form-control" required>
                                            <option value="" disabled selected>-Jenjang Fungsional-</option>
                                            @foreach ($jenjangs as $k => $jenjang)
                                                <option value="{{ $jenjang->id }}">{{ $jenjang->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="wilayah">Wilayah</label>
                                        <select id="wilayah" name="wilayah" class="form-control" required>
                                            <option value="" disabled selected>-Wilayah-</option>
                                            @foreach ($wilayahs as $k => $wilayah)
                                                <option value="{{ $wilayah->id }}">{{ $wilayah->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">Status Pegawai</label>
                                        <select id="status" name="status" class="form-control" required>
                                            <option value="" disabled selected>-Status Pegawai-</option>
                                            @foreach ($statuss as $k => $status)
                                                <option value="{{ $status->id }}">{{ $status->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input id="username" name="username" class="form-control" type="text" maxlength="50" placeholder="-Username-" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input id="password" name="password" class="form-control" type="text" maxlength="50" placeholder="-Password-" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="ruangan">Ruangan</label>
                                        <div class="row">
                                            <div class="col-2 pr-2">
                                                <input id="ruangan" name="ruangan" list="ruangan_list" placeholder="-Kode-" class="form-control" required>
                                            </div>
                                            <div class="col pl-0">
                                                <input id="ruangan_text" type="text" value="-Nama Ruangan-" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <datalist id="ruangan_list">
                                            @foreach ($ruangans as $k => $ruangan)
                                            <option value="{{ $ruangan->kode_ruangan }}">{{ $ruangan->nama_ruangan }}</option>
                                            @endforeach
                                        </datalist>
                
                                        <script type="text/javascript">
                                            $(document).on('change', '#ruangan', function () {
                                                var v = $("#ruangan_list option[value='" + $("#ruangan").val() + "']").text();
                                                $("#ruangan_text").val(v);
                                            });
                                        </script>
                                    </div>

                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select id="role" name="role" class="form-control" required>
                                            <option value="" disabled selected>-Role-</option>
                                            @foreach ($roles as $k => $role)
                                                <option value="{{ $role->id_role }}">{{ $role->nama_role }}</option>
                                            @endforeach
                                        </select>
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
                    $('#formTambahPegawai').submit(function(e){
                        e.preventDefault();
                
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin/master/pegawai/tambah') }}",
                            data: {
                                nip_lama     : document.getElementById("nip_lama").value,
                                nip_baru     : document.getElementById("nip_baru").value,
                                nama_pegawai : document.getElementById("nama_pegawai").value,
                                email        : document.getElementById("email").value,
                                golpangkat   : document.getElementById("golpangkat").value,
                                subfungsi    : document.getElementById("subfungsi").value,
                                struktural   : document.getElementById("struktural").value,
                                fungsional   : document.getElementById("fungsional").value,
                                jenjang      : document.getElementById("jenjang").value,
                                wilayah      : document.getElementById("wilayah").value,
                                status       : document.getElementById("status").value,
                                username     : document.getElementById("username").value,
                                password     : document.getElementById("password").value,
                                ruangan      : document.getElementById("ruangan").value,
                                role         : document.getElementById("role").value,
                            },
                            success: function (response) {
                                if (response.id == 'fail'){
                                    alert(response.msg);
                                }
                                else if (response.id == 'success'){
                                    $("#alertMsg").html(response.msg);
                                    $("#alertModal").modal('show');
                                    setTimeout( function() { 
                                        window.location = "{{ route('admin/master/pegawai') }}";
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
        <table id="datatable" class="table table-striped table-hover table-responsive" style="font-size:80%">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">NIP Lama</th>
                    <th scope="col">NIP Baru</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email BPS</th>
                    <th scope="col">Golongan Pangkat</th>
                    <th scope="col">Fungsi</th>
                    <th scope="col">Subfungsi</th>
                    <th scope="col">Struktural</th>
                    <th scope="col">Fungsional</th>
                    <th scope="col">Jenjang Fungsional</th>
                    <th scope="col">Wilayah</th>
                    <th scope="col">Status Pegawai</th>
                    <th scope="col">Ruangan</th>
                    <th scope="col">Role</th>
                    <th scope="col">Username</th>
                    <th scope="col">Password</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($pegawais as $i => $pegawai)
                <tr>
                    <td>{{ ++$i }}</th>
                    <td>{{ $pegawai->nip_lama }}</td>
                    <td>{{ $pegawai->nip_baru }}</td>
                    <td>{{ $pegawai->nama_pegawai }}</td>
                    <td>{{ $pegawai->email_bps }}</td>
                    <td><b>{{ $pegawai->golongan }}</b></br>{{ $pegawai->pangkat }}</td>
                    <td>{{ $pegawai->nama_fungsi }}</td>
                    <td>{{ $pegawai->nama_sub_fungsi }}</td>
                    <td>{{ $pegawai->nama_struktural }}</td>
                    <td>{{ $pegawai->nama_fungsional }}</td>
                    <td>{{ $pegawai->nama_jenjang_fungsional }}</td>
                    <td>{{ $pegawai->nama_wilayah }}</td>
                    <td>{{ $pegawai->nama_status_pegawai }}</td>
                    <td>{{ $pegawai->nama_ruangan }}</td>
                    <td>{{ $pegawai->nama_role }}</td>
                    <td>{{ $pegawai->username }}</td>
                    <td>{{ $pegawai->password }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                            
                            <!-- Tombol untuk mengedit pegawai -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editPegawai{{ $i }}"><i class="fas fa-edit"></i></button>

                            <!-- Modal edit pegawai -->
                            <div class="modal fade" id="editPegawai{{ $i }}">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">

                                        <!-- Modal header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Edit Pegawai</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <form id="formEditPegawai{{ $i }}" enctype="multipart/form-data">
                                            @csrf
                                            
                                                <input id="id_pegawai{{ $i }}" name="id_pegawai" type="hidden" value="{{ $pegawai->id_pegawai }}">
                                                <input id="id_user{{ $i }}" name="id_user" type="hidden" value="{{ $pegawai->id_user }}">
                                                <input id="id_sobat{{ $i }}" name="id_sobat" type="hidden" value="{{ $pegawai->id_sobat }}">

                                                <div class="form-group">
                                                    <label for="nip_lama{{ $i }}">NIP Lama</label>
                                                    <input id="nip_lama{{ $i }}" name="nip_lama" class="form-control" type="text" maxlength="9" value="{{ $pegawai->nip_lama }}" required>
                                                    <input id="nip_lama_0{{ $i }}" name="nip_lama_0" type="hidden" value="{{ $pegawai->nip_lama }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="nip_baru{{ $i }}">NIP Baru</label>
                                                    <input id="nip_baru{{ $i }}" name="nip_baru" class="form-control" type="text" maxlength="18" value="{{ $pegawai->nip_baru }}" required>
                                                    <input id="nip_baru_0{{ $i }}" name="nip_baru_0" type="hidden" value="{{ $pegawai->nip_baru }}">
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label for="nama_pegawai{{ $i }}">Nama</label>
                                                    <input id="nama_pegawai{{ $i }}" name="nama_pegawai" class="form-control" type="text" maxlength="255" value="{{ $pegawai->nama_pegawai }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="email{{ $i }}">Email BPS</label>
                                                    <input id="email{{ $i }}" name="email" class="form-control" type="email" maxlength="100" value="{{ $pegawai->email_bps }}" required>
                                                    <input id="email_0{{ $i }}" name="email_0" type="hidden" value="{{ $pegawai->email_bps }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="golpangkat{{ $i }}">Golongan Pangkat</label>
                                                    <select id="golpangkat{{ $i }}" name="golpangkat" class="form-control" required>
                                                    @foreach ($golpangkats as $k => $golpangkat)
                                                        @if ($golpangkat->id == $pegawai->id_golongan_pangkat)
                                                            <option value="{{ $golpangkat->id }}" selected>{{ $golpangkat->golongan }} - {{ $golpangkat->pangkat }}</option>
                                                        @else
                                                            <option value="{{ $golpangkat->id }}">{{ $golpangkat->golongan }} - {{ $golpangkat->pangkat }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="subfungsi{{ $i }}">Subfungsi</label>
                                                    <select id="subfungsi{{ $i }}" name="subfungsi" class="form-control" required>
                                                    @foreach ($subfungsis as $k => $subfungsi)
                                                        @if ($subfungsi->id_sub_fungsi == $pegawai->id_sub_fungsi)
                                                            <option value="{{ $subfungsi->id_sub_fungsi }}" selected>{{ $subfungsi->nama_fungsi }} - {{ $subfungsi->nama_sub_fungsi }}</option>
                                                        @else
                                                            <option value="{{ $subfungsi->id_sub_fungsi }}">{{ $subfungsi->nama_fungsi }} - {{ $subfungsi->nama_sub_fungsi }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="struktural{{ $i }}">Struktural</label>
                                                    <select id="struktural{{ $i }}" name="struktural" class="form-control" required>
                                                    @foreach ($strukturals as $k => $struktural)
                                                        @if ($struktural->id == $pegawai->id_struktural)
                                                            <option value="{{ $struktural->id }}" selected>{{ $struktural->nama }}</option>
                                                        @else
                                                            <option value="{{ $struktural->id }}">{{ $struktural->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="fungsional{{ $i }}">Fungsional</label>
                                                    <select id="fungsional{{ $i }}" name="fungsional" class="form-control" required>
                                                    @foreach ($fungsionals as $k => $fungsional)
                                                        @if ($fungsional->id == $pegawai->id_fungsional)
                                                            <option value="{{ $fungsional->id }}" selected>{{ $fungsional->nama }}</option>
                                                        @else
                                                            <option value="{{ $fungsional->id }}">{{ $fungsional->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="jenjang{{ $i }}">Jenjang Fungsional</label>
                                                    <select id="jenjang{{ $i }}" name="jenjang" class="form-control" required>
                                                    @foreach ($jenjangs as $k => $jenjang)
                                                        @if ($jenjang->id == $pegawai->id_jenjang_fungsional)
                                                            <option value="{{ $jenjang->id }}" selected>{{ $jenjang->nama }}</option>
                                                        @else
                                                            <option value="{{ $jenjang->id }}">{{ $jenjang->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>
            
                                                <div class="form-group">
                                                    <label for="wilayah{{ $i }}">Wilayah</label>
                                                    <select id="wilayah{{ $i }}" name="wilayah" class="form-control" required>
                                                    @foreach ($wilayahs as $k => $wilayah)
                                                        @if ($wilayah->id == $pegawai->id_wilayah)
                                                            <option value="{{ $wilayah->id }}" selected>{{ $wilayah->nama }}</option>
                                                        @else
                                                            <option value="{{ $wilayah->id }}">{{ $wilayah->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>
            
                                                <div class="form-group">
                                                    <label for="status{{ $i }}">Status Pegawai</label>
                                                    <select id="status{{ $i }}" name="status" class="form-control" required>
                                                    @foreach ($statuss as $k => $status)
                                                        @if ($status->id == $pegawai->id_status_pegawai)
                                                            <option value="{{ $status->id }}" selected>{{ $status->nama }}</option>
                                                        @else
                                                            <option value="{{ $status->id }}">{{ $status->nama }}</option>
                                                        @endif
                                                    @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label for="username{{ $i }}">Username</label>
                                                    <input id="username{{ $i }}" name="username" class="form-control" type="text" maxlength="50" value="{{ $pegawai->username }}" required>
                                                    <input id="username_0{{ $i }}" name="username_0" type="hidden" value="{{ $pegawai->username }}">
                                                </div>

                                                <div class="form-group">
                                                    <label for="password{{ $i }}">Password</label>
                                                    <input id="password{{ $i }}" name="password" class="form-control" type="text" maxlength="50" value="{{ $pegawai->password }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="ruangan{{ $i }}">Ruangan</label>
                                                    <div class="row">
                                                        <div class="col-2 pr-2">
                                                            <input id="ruangan{{ $i }}" name="ruangan" list="ruangan_list{{ $i }}" value="{{ $pegawai->kode_ruangan }}" class="form-control" required>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <input id="ruangan_text{{ $i }}" type="text" value="{{ $pegawai->nama_ruangan }}" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                    <datalist id="ruangan_list{{ $i }}">
                                                        @foreach ($ruangans as $k => $ruangan)
                                                            <option value="{{ $ruangan->kode_ruangan }}">{{ $ruangan->nama_ruangan }}</option>
                                                        @endforeach
                                                    </datalist>
                            
                                                    <script type="text/javascript">
                                                        $(document).on('change', '#ruangan{{ $i }}', function () {
                                                            var v = $("#ruangan_list{{ $i }} option[value='" + $("#ruangan{{ $i }}").val() + "']").text();
                                                            $("#ruangan_text{{ $i }}").val(v);
                                                        });
                                                    </script>
                                                </div>

                                                <div class="form-group">
                                                    <label for="role{{ $i }}">Role</label>
                                                    @if ($pegawai->id_user == Auth::user()->id)
                                                        <input id="role{{ $i }}" name="role" class="form-control" type="text" value="{{ $pegawai->nama_role }}" disabled>
                                                    @else
                                                        <select id="role{{ $i }}" name="role" class="form-control" required>
                                                        @foreach ($roles as $k => $role)
                                                            @if ($role->id_role == $pegawai->role)
                                                                <option value="{{ $role->id_role }}" selected>{{ $role->nama_role }}</option>
                                                            @else
                                                                <option value="{{ $role->id_role }}">{{ $role->nama_role }}</option>
                                                            @endif
                                                        @endforeach
                                                        </select>
                                                    @endif
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

                            <div id="alertModal{{ $i }}" class="modal fade">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-success">
                                            <p id="alertMsg{{ $i }}" class="modal-title text-center text-white"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <script type="text/javascript">
                                $('#formEditPegawai{{ $i }}').submit(function(e){
                                    e.preventDefault();
                            
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                            
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin/master/pegawai/edit') }}",
                                        data: {
                                            id_pegawai   : document.getElementById("id_pegawai{{ $i }}").value,
                                            id_user      : document.getElementById("id_user{{ $i }}").value,
                                            id_sobat     : document.getElementById("id_sobat{{ $i }}").value,
                                            nip_lama     : document.getElementById("nip_lama{{ $i }}").value,
                                            nip_lama_0   : document.getElementById("nip_lama_0{{ $i }}").value,
                                            nip_baru     : document.getElementById("nip_baru{{ $i }}").value,
                                            nip_baru_0   : document.getElementById("nip_baru_0{{ $i }}").value,
                                            nama_pegawai : document.getElementById("nama_pegawai{{ $i }}").value,
                                            email        : document.getElementById("email{{ $i }}").value,
                                            email_0      : document.getElementById("email_0{{ $i }}").value,
                                            golpangkat   : document.getElementById("golpangkat{{ $i }}").value,
                                            subfungsi    : document.getElementById("subfungsi{{ $i }}").value,
                                            struktural   : document.getElementById("struktural{{ $i }}").value,
                                            fungsional   : document.getElementById("fungsional{{ $i }}").value,
                                            jenjang      : document.getElementById("jenjang{{ $i }}").value,
                                            wilayah      : document.getElementById("wilayah{{ $i }}").value,
                                            status       : document.getElementById("status{{ $i }}").value,
                                            username     : document.getElementById("username{{ $i }}").value,
                                            username_0   : document.getElementById("username_0{{ $i }}").value,
                                            password     : document.getElementById("password{{ $i }}").value,
                                            ruangan      : document.getElementById("ruangan{{ $i }}").value,
                                            role         : document.getElementById("role{{ $i }}").value,
                                        },
                                        success: function (response) {
                                            if (response.id == 'fail'){
                                                alert(response.msg);
                                            }
                                            else if (response.id == 'success'){
                                                $("#alertMsg{{ $i }}").html(response.msg);
                                                $("#alertModal{{ $i }}").modal('show');
                                                setTimeout( function() { 
                                                    window.location = "{{ route('admin/master/pegawai') }}";
                                                }, 1500);
                                            }
                                        }
                                    });
                                });
                            </script>

                            <!-- Tombol untuk menampilkan/menyembunyikan pegawai -->
                            <button id="buttonShow{{ $i }}" type="button" class="btn" value="{{ $pegawai->is_show }}"><i id="logoShow{{ $i }}" class="fa"></i></button>

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
                                    var id_sobat   = "{{ $pegawai->id_sobat }}";
                                    var nama_pegawai = "{{ $pegawai->nama_pegawai }}";

                                    if ($('#buttonShow{{ $i }}').val() == 0){
                                        var show_pegawai = 1;
                                    }

                                    if ($('#buttonShow{{ $i }}').val() == 1){
                                        var show_pegawai = 0;
                                    }
                            
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                            
                                    $.ajax({
                                        type: "POST",
                                        url: "{{ route('admin/master/pegawai/show') }}",
                                        data: {
                                            id_sobat: id_sobat,
                                            nama_pegawai: nama_pegawai,
                                            show_pegawai: show_pegawai,
                                        },
                                        success: function (response) {
                                            if (response.msg != ''){
                                                $("#modalMsg{{ $i }}").html(response.msg);
                                                $("#modalShow{{ $i }}").modal('show');
                                                $('#buttonShow{{ $i }}').val(show_pegawai);

                                                if (show_pegawai == 0){
                                                    document.getElementById("buttonShow{{ $i }}").classList.remove("btn-info");
                                                    document.getElementById("logoShow{{ $i }}").classList.remove("fa-eye");
                                                    document.getElementById("buttonShow{{ $i }}").classList.add("btn-secondary");
                                                    document.getElementById("logoShow{{ $i }}").classList.add("fa-eye-slash");
                                                }
                                                if (show_pegawai == 1){
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
        document.getElementById("pegawaiButton").classList.add('active');
    });
</script>

@endsection