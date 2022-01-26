<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>Cetak Laporan Keluhan</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <style>
        body {
            font-size: 125%;
        }
        .page-break {
            page-break-after: always;
        }
        .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
            border: 1px solid black;
        }
    </style>
</head>
<body>
@foreach ($keluhans as $i => $keluhan)
    <div class="clearfix mr-5">
        <span class="float-right border border-5 border-dark p-2">
            FORM - PEMELIHARAAN
        </span>
    </div>

    <div class="page-break mb-5" style="margin: 1cm 2cm 2cm 2cm !important;">
        <div>
			<h4 class="text-center">FORMULIR LAPORAN PEMELIHARAAN</h4>
        </div>

        <div class="mt-5">
			<p>
                Kepada Yth<br>
                Kasubbag Umum<br>
                di<br>
                Badan Pusat Statistik Provinsi Lampung<br><br>
            
                Bersama ini disampaikan formulir laporan pemeliharaan :
            </p>
        </div>

        <table class="table table-bordered mt-4">
            <tbody>
                <tr>
                    <td><b>Unique Code</b></td>
                    <td>{{ $keluhan->unique_code }}</td>
                </tr>

                <tr>
                    <td><b>Nama Pelapor</b></td>
                    <td>{{ $keluhan->pelapor }}</td>
                </tr>

                <tr>
                    <td><b>Nama Pemegang BMN</b></td>
                    <td>{{ $keluhan->pemegang_bmn }}</td>
                </tr>

                <tr>
                    <td><b>Jenis Permintaan</b></td>
                    <td>
                        {{ $keluhan->nama_kategori_permintaan }} - {{ $keluhan->nama_permintaan }}
                        @if ($keluhan->nama_permintaan == "# Lainnya")
                            ({{ $keluhan->permintaan_lainnya }})
                        @endif
                    </td>
                </tr>

                @if ($keluhan->id_kategori_permintaan==1)
                    <tr>
                        <td><b>Type Barang</b></td>
                        <td>
                            {{ $keluhan->nama_merk }} - {{ $keluhan->nama_type }}
                            @if ($keluhan->id_type == 999)
                                ({{ $keluhan->type_lainnya }})
                            @endif  
                        </td>
                    </tr>

                    <tr>
                        <td><b>Kode Barang</b></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td><b>Tahun Perolehan</b></td>
                        <td></td>
                    </tr>
                @endif

                <tr>
                    <td><b>Permasalahan</b></td>
                    <td>{{ $keluhan->masalah }}</td>
                </tr>
            </tbody>
        </table>

        <div class="row mt-3">
            <div class="col-5 text-center">
                <br>
                Penanggung Jawab Ruangan
                <br><br><br><br>
                {{ $keluhan->pj_ruang }}
                <br>
                NIP {{ $keluhan->nip_pj_ruang }}
            </div>
            <div class="col-2"></div>
            <div class="col-5 text-center">
                Bandar Lampung, {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}<br>
                Pembuat Laporan
                <br><br><br><br>
                {{ $keluhan->pelapor }}
                <br>
                NIP {{ $keluhan->nip_pelapor }}
            </div>
        </div>
    </div>

    <div class="page-break" style="margin: 2cm 2cm 2cm 2cm !important;">
		<div class="mb-5">
			<h4 class="text-center">FORM MONITORING PEMELIHARAAN</h4>
        </div>

        <table class="table-sm table-borderless mt-5">
            <tbody>
                <tr>
                    <td>Nama Pemegang BMN </td>
                    <td>: {{ $keluhan->pemegang_bmn }}</td>
                </tr>

                <tr>
                    <td>NIP Pemegang BMN </td>
                    <td>: {{ $keluhan->nip_pemegang_bmn }}</td>
                </tr>

                <tr>
                    <td>Jenis Permintaan </td>
                    <td>
                        : {{ $keluhan->nama_kategori_permintaan }} - {{ $keluhan->nama_permintaan }}
                        @if ($keluhan->nama_permintaan == "# Lainnya")
                            ({{ $keluhan->permintaan_lainnya }})
                        @endif
                    </td>
                </tr>

                @if ($keluhan->id_kategori_permintaan==1)
                    <tr>
                        <td>Merk / Type </td>
                        <td>
                            : {{ $keluhan->nama_merk }} / {{ $keluhan->nama_type }}
                            @if ($keluhan->id_type == 999)
                                ({{ $keluhan->type_lainnya }})
                            @endif
                        </td>
                    </tr>
                @endif

                <tr>
                    <td>Permasalahan </td>
                    <td>: {{ $keluhan->masalah }}</td>
                </tr>
            </tbody>
        </table>

		<table class="table table-bordered mt-5">
			<thead>
                <tr class="text-center">
                    <th nowrap="nowrap" scope="col">Status</th>
                    <th nowrap="nowrap" scope="col">Tanggal<br><b>Penanggung Jawab</b></th>
                    <th nowrap="nowrap" scope="col">Keterangan</th>
                </tr>
			</thead>

			<tbody>
            @foreach ($statuss as $i => $status)
                <tr>
                    @if ($status->id_status == 2)
                        <td>{{ $status->nama_status }}</td>
                        <td>{{ \Carbon\Carbon::parse($keluhan->tgl_laporan)->format('Y-m-d') }}<br><b>{{ $keluhan->pelapor }}</b></td>
                        <td>-</td>

                    @elseif ($status->id_status == 3)
                        <td>{{ $status->nama_status }}</td>
                        <td>{{ \Carbon\Carbon::parse($keluhan->tgl_approve_pj)->format('Y-m-d') }}<br><b>{{ $keluhan->pj_ruang }}</b></td>
                        <td>-</td>

                    @elseif (($status->id_status == 4) AND !is_null($keluhan->id_ipds))
                        <td>{{ $status->nama_status }}</td>
                        <td>{{ \Carbon\Carbon::parse($keluhan->tgl_approve_umum)->format('Y-m-d') }}<br><b>{{ $keluhan->umum }}</b></td>
                        <td>{{ $keluhan->catatan_umum }}</td>

                    @elseif (($status->id_status == 5) AND !is_null($keluhan->id_ipds))
                        <td>{{ $status->nama_status }}</td>
                        <td>{{ \Carbon\Carbon::parse($keluhan->tgl_proses_ipds)->format('Y-m-d') }}<br><b>{{ $keluhan->ipds }}</b></td>
                        <td>-</td>

                    @elseif (($status->id_status == 6) AND !is_null($keluhan->id_ipds) AND !is_null($keluhan->id_rekanan))
                        <td>{{ $status->nama_status }}</td>
                        <td>{{ \Carbon\Carbon::parse($keluhan->tgl_kirim_rekanan)->format('Y-m-d') }}<br><b>{{ $keluhan->ipds }}</b></td>
                        <td>{{ $keluhan->catatan_ipds }}</td>

                    @elseif (($status->id_status == 7) AND !is_null($keluhan->id_ipds) AND !is_null($keluhan->id_rekanan))
                        <td>{{ $status->nama_status }}</td>
                        <td>{{ \Carbon\Carbon::parse($keluhan->tgl_selesai)->format('Y-m-d') }}<br><b>{{ $keluhan->ipds }}</b></td>
                        <td>{{ $keluhan->catatan_rekanan }}</td>

                    @elseif (($status->id_status == 7) AND !is_null($keluhan->id_ipds) AND is_null($keluhan->id_rekanan))
                        <td>{{ $status->nama_status }}</td>
                        <td>{{ \Carbon\Carbon::parse($keluhan->tgl_selesai)->format('Y-m-d') }}<br><b>{{ $keluhan->ipds }}</b></td>
                        <td>{{ $keluhan->catatan_ipds }}</td>
                    
                    @elseif (($status->id_status == 8) AND is_null($keluhan->id_ipds))
                        <td>{{ $status->nama_status }}</td>
                        <td>{{ \Carbon\Carbon::parse($keluhan->tgl_selesai)->format('Y-m-d') }}<br><b>{{ $keluhan->umum }}</b></td>
                        <td>-</td>

                    @elseif ($status->id_status == 9)
                        <td>{{ $status->nama_status }}</td>
                        <td>{{ \Carbon\Carbon::parse($keluhan->tgl_diambil)->format('Y-m-d') }}<br><b>{{ $keluhan->pemegang_bmn }}</b></td>
                        <td>biaya : {{ $keluhan->biaya }}</td>
                    @endif
                </tr>
            @endforeach
            </tbody>
		</table>

        <div>
			*) Lembar monitoring ini diserahkan ke Fungsi IPDS
        </div>
	</div>
@endforeach

    <script type="text/javascript">
        $(document).ready(function() {
            var css = '@page { size: portrait; }',
                head = document.head || document.getElementsByTagName('head')[0],
                style = document.createElement('style');

            style.type = 'text/css';
            style.media = 'print';

            if (style.styleSheet){
            style.styleSheet.cssText = css;
            } else {
            style.appendChild(document.createTextNode(css));
            }

            head.appendChild(style);

            window.print();
        });
    </script>
</body>
</html>