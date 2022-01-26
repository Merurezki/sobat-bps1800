<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Title -->
        <title>Cetak Laporan Bulanan</title>

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    </head>

    <body style="margin: 0.5cm 0.5cm 0.5cm 0.5cm !important; font-size: 75%;">
        <div>
            <div>
                <h4 class="text-center">Laporan Bulan {{ \Carbon\Carbon::parse($monYears)->isoFormat('MMMM Y') }}</h4>
            </div>

            <table class='table table-bordered mt-5'>
                <thead style="font-size:80%;">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Unique Code</th>
                        @foreach ($statuss as $i => $status)
                            @if ($status->id_status!=1)
                                <th scope="col">{{ $status->nama_status }}</th>
                            @endif
                        @endforeach
                        <th scope="col">Biaya</th>
                    </tr>
                </thead>

                <tbody style="font-size:80%;">
                @foreach ($keluhans as $i => $keluhan)
                    <tr>
                        <td>{{ ++$i }}</td>

                        <td>{{ $keluhan->unique_code }}</td>

                        <!-- Tanggal Laporan---------------------------------------------------------------------------------- -->

                        @if ($keluhan->id_status==1 AND is_null($keluhan->id_umum))
                            <td>{{ \Carbon\Carbon::parse($keluhan->tgl_laporan)->format('Y-m-d H:i:s') }}<br><b class="text-danger">ditolak pj</b></td>
                        @else
                            <td>{{ \Carbon\Carbon::parse($keluhan->tgl_laporan)->format('Y-m-d H:i:s') }}</td>
                        @endif

                        <!-- Tanggal Approve PJ------------------------------------------------------------------------------- -->

                        @if (is_null($keluhan->tgl_approve_pj) OR ($keluhan->id_status==1 AND is_null($keluhan->tgl_approve_umum)))
                            <td>-</td>
                        @elseif ($keluhan->id_status==1 AND is_null($keluhan->tgl_proses_ipds))
                            <td>{{ \Carbon\Carbon::parse($keluhan->tgl_approve_pj)->format('Y-m-d H:i:s') }}<br><b class="text-danger">ditolak umum</b></td>
                        @else
                            <td>{{ \Carbon\Carbon::parse($keluhan->tgl_approve_pj)->format('Y-m-d H:i:s') }}</td>
                        @endif

                        <!-- Tanggal Approve Umum----------------------------------------------------------------------------- -->

                        @if (is_null($keluhan->tgl_approve_umum) OR $keluhan->id_status==1)
                            <td>-</td>
                        @elseif (is_null($keluhan->tgl_approve_umum) AND !is_null($keluhan->tgl_selesai))
                            <td>{{ \Carbon\Carbon::parse($keluhan->tgl_selesai)->format('Y-m-d H:i:s') }}</td>
                        @else
                            <td>{{ \Carbon\Carbon::parse($keluhan->tgl_approve_umum)->format('Y-m-d H:i:s') }}</td>
                        @endif

                        <!-- Tanggal Proses IPDS------------------------------------------------------------------------------ -->

                        @if (is_null($keluhan->tgl_proses_ipds))
                            <td>-</td>
                        @else
                            <td>{{ \Carbon\Carbon::parse($keluhan->tgl_proses_ipds)->format('Y-m-d H:i:s') }}</td>
                        @endif

                        <!-- Tanggal Kirim Rekanan---------------------------------------------------------------------------- -->

                        @if (is_null($keluhan->tgl_kirim_rekanan))
                            <td>-</td>
                        @else
                            <td>{{ \Carbon\Carbon::parse($keluhan->tgl_kirim_rekanan)->format('Y-m-d H:i:s') }}</td>
                        @endif

                        <!-- Tanggal Selesai di IPDS-------------------------------------------------------------------------- -->

                        @if (is_null($keluhan->tgl_selesai) OR (!is_null($keluhan->tgl_selesai) AND is_null($keluhan->id_ipds)))
                            <td>-</td>
                        @else
                            <td>{{ \Carbon\Carbon::parse($keluhan->tgl_selesai)->format('Y-m-d H:i:s') }}</td>
                        @endif

                        <!-- Tanggal Selesai di Umum-------------------------------------------------------------------------- -->

                        @if (is_null($keluhan->tgl_selesai))
                            <td>-</td>
                        @else
                            <td>{{ \Carbon\Carbon::parse($keluhan->tgl_selesai)->format('Y-m-d H:i:s') }}</td>
                        @endif

                        <!-- Tanggal Diambil Pemegang BMN--------------------------------------------------------------------- -->

                        @if (is_null($keluhan->tgl_diambil))
                            <td>-</td>
                        @else
                            <td>{{ \Carbon\Carbon::parse($keluhan->tgl_diambil)->format('Y-m-d H:i:s') }}</td>
                        @endif

                        <!-- Biaya-------------------------------------------------------------------------------------------- -->

                        @if (is_null($keluhan->biaya))
                            <td>-</td>
                        @else
                            <td>{{ $keluhan->biaya }}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {
                var css = '@page { size: landscape; }',
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