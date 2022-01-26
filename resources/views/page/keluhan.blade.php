@extends('layouts.drawer')

@section('title', 'User | Keluhan')

@section('content')

<!-- Table -->
<div class="card p-2">
    <div class="row">
        <div class="col-8">
            <h1>Tabel Keluhan</h1>
        </div>
        <div class="col-4">
            <div class="d-flex justify-content-end">
                <!-- Tombol untuk menambahkan keluhan -->
                <button class="btn btn-success text-nowrap" data-toggle="modal" data-target="#tambahKeluhan">
                Keluhan Baru (+)
                </button>

                @include('fragment.tambah_keluhan')
            </div>
        </div>
    </div>

    <table id="datatable" class="table table-striped table-hover">

        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Unique Code</th>
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
                <td>{{ ++$i }}</td>

                {{-- ------------------------------------------------------------------------------------------------ --}}

                <td>{{ $keluhan->unique_code }}</td>

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
        $('#keluhanPage').addClass("active");
    });
</script>
@endsection