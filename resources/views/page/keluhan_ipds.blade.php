@extends('layouts.drawer')

@section('title', 'IPDS | Keluhan')

@section('content')

<!-- Table -->
<div class="card p-2">
    <div class="row">
        <div class="col-8">
            <h1>Tabel Keluhan IPDS</h1>
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
            </tr>
        </thead>

        <tbody>
        @foreach ($keluhans as $i => $keluhan)
            <tr>
                <td>
                    {{ ++$i }}

                    @php
                        $notifIpds[$i] = DB::table('notifikasi_ipds')
                        ->leftjoin('bmn_keluhan','notifikasi_ipds.id_keluhan','=','bmn_keluhan.id_keluhan')
                        ->where('notifikasi_ipds.id_keluhan', $keluhan->id_keluhan)
                        ->where('is_read', 0)
                        ->count();
                    @endphp
                    
                    @if ($notifIpds[$i]>0)
                        <span id="notifIpds{{ $i }}" class="badge rounded-pill bg-danger float-right">new</span>
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

                        <!-- Ubah Status------------------------------------------------------------------------------------------------------------------------------------------------ -->

                        @include('fragment.status_ipds')

                        <!-- Edit------------------------------------------------------------------------------------------------------------------------------------------------------- -->
                        
                        @if (($keluhan->id_ipds == Auth::user()->userSobat->id AND in_array($keluhan->id_status,array(5,6,7,9))) OR in_array($keluhan->id_status,array(4)))

                            @include('fragment.edit_keluhan')
                        
                        @else

                            <button class="btn btn-secondary" disabled><i class="fas fa-edit p-0"></i></button>

                        @endif

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
        $('#ipdsPage').addClass("active");
    });
</script>
@endsection