@extends('layouts.drawer')

@section('title', App\Models\Role::find(Auth::user()->userSobat->role)->nama_role.' | Tabulasi')

@section('content')

<!-- Tabulasi -->
<div class="card p-5">

    <!-- Header -->
    <div class="text-center mb-4">
        <span>
            <form id="formGantiBulanTahun" method="post" enctype="multipart/form-data">
            @csrf
                <input id="bulanTahunTabulasi" type="month" name="bulan_tahun_tabulasi" value="{{ \Carbon\Carbon::parse($monYears)->format('Y-m') }}">
            </form>
        </span>

        <script type="text/javascript">
            $(document).ready(function() {
                @if (Auth::user()->userSobat->role == 1)
                    document.getElementById("formGantiBulanTahun").action = "{{ route('admin/tabulasi/ganti_bulan_tahun') }}";
                @elseif (Auth::user()->userSobat->role == 2)
                    document.getElementById("formGantiBulanTahun").action = "{{ route('ipds/tabulasi/ganti_bulan_tahun') }}";
                @endif

                $('#bulanTahunTabulasi').change(function () {
                    this.form.submit();        
                });
            });
        </script>
    </div>
    <!-- Header end -->

    <!-- ----------------------------------------------------------------------------------------------------------- -->

    <div class="row mb-1">
        <div class="col-12 text-center">
            <h3 class="text-success">Keluhan Berdasarkan Status</h3>
        </div>
    </div>

    <div class="row mb-3">
        <table class="table table-condensed table-bordered table-striped table-success">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-right">Jumlah</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($statuss as $i => $status)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $status->nama_status }}</td>
                    <td class="text-right">{{ $jumlahByStatus[$i] }}</td>                
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- ----------------------------------------------------------------------------------------------------------- -->

    <div class="row mb-1">
        <div class="col-12 text-center">
            <h3 class="text-warning">Keluhan Berdasarkan Fungsi</h3>
        </div>
    </div>

    <div class="row mb-3">
        <table class="table table-condensed table-bordered table-striped table-warning">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Fungsi</th>
                    <th scope="col" class="text-right">Jumlah</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($fungsis as $i => $fungsi)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $fungsi->nama }}</td>
                    <td class="text-right">{{ $jumlahByFungsi[$i] }}</td>                
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- ----------------------------------------------------------------------------------------------------------- -->

    <div class="row mb-1">
        <div class="col-12 text-center">
            <h3 class="text-danger">Keluhan Berdasarkan Permintaan</h3>
        </div>
    </div>

    <div class="row mb-3">
        <table class="table table-condensed table-bordered table-striped table-danger">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Kategori Permintaan</th>
                    <th scope="col">Permintaan</th>
                    <th scope="col" class="text-right">Jumlah</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($permintaans as $i => $permintaan)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $permintaan->nama_kategori_permintaan }}</td>
                    <td>{{ $permintaan->nama_permintaan }}</td>
                    <td class="text-right">{{ $jumlahByPermintaan[$i] }}</td>                
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- ----------------------------------------------------------------------------------------------------------- -->
    
</div>
<!-- Table end -->

<script type="text/javascript">    
    $(document).ready(function() {
        document.getElementById("tabulasiPage").classList.add('active');
    });
</script>
@endsection