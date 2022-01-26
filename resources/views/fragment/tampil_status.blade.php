@php
    $notifUser[$i] = DB::table('notifikasi_user')
    ->leftjoin('bmn_keluhan','notifikasi_user.id_keluhan','=','bmn_keluhan.id_keluhan')
    ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
    ->where('bmn_grup_keluhan.id_pelapor', Auth::user()->userSobat->id)
    ->where('notifikasi_user.id_keluhan', $keluhan->id_keluhan)
    ->where('is_read', 0)
    ->count();
@endphp
    
<!-- Tombol untuk menampilkan status -->
<button id="buttonStatus{{ $i }}" type="button" class="btn btn-primary" value="{{ $keluhan->id_keluhan }}" data-toggle="modal" data-target="#tampilStatus{{ $i }}">
    <i class="fas fa-history p-0">
        @if ($notifUser[$i]>0)
            <span id="notifStatus{{ $i }}" class="badge rounded-pill bg-danger float-right">{{ $notifUser[$i] }}</span>
        @endif
    </i>    
</button>

<script type="text/javascript">
    $('#buttonStatus{{ $i }}').click(function(e){
        e.preventDefault();
        var idKeluhan = $('#buttonStatus{{ $i }}').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "{{ route('notif_keluhan') }}",
            data: {id: idKeluhan},
            success: function (response) {
                document.getElementById("notifStatus{{ $i }}").style.display = 'none';
                if(response.result>0){
                    document.getElementById("notifKeluhan").innerText = response.result;
                }else{
                    document.getElementById("notifKeluhan").style.display = 'none';
                }
            }
        });
    });
</script>

<!-- Modal tampil status -->
<div class="modal fade" id="tampilStatus{{ $i }}">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Progress</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
        
            <!-- Modal body -->
            <div class="modal-body">
                <ul class="timeline ">
    
                    <li class="event" data-date="{{ $keluhan->tgl_laporan }}">
                        <h3>Kirim form ke PJ Ruangan</h3>
                        <p>Permintaan dilaporkan oleh <b>{{ $keluhan->pelapor }}</b></p>
                    </li>

                    @if ($keluhan->id_status==1 AND is_null($keluhan->umum))
                    <li class="event" data-date="{{ $keluhan->tgl_approve_pj }}">
                        <h3>Permintaan ditolak PJ Ruangan</h3>
                        <p>Permintaan telah ditolak oleh <b>{{ $keluhan->pj_ruang }}</b></p>
                    </li>
                    @endif

                    @if ($keluhan->id_status>=3 OR !is_null($keluhan->umum))
                    <li class="event" data-date="{{ $keluhan->tgl_approve_pj }}">
                        <h3>Permintaan diterima PJ Ruangan</h3>
                        <p>Permintaan telah diterima oleh <b>{{ $keluhan->pj_ruang }}</b> dan dikirim ke Subfungsi Umum</p>
                    </li>
                    @endif

                    @if ($keluhan->id_status==1 AND !is_null($keluhan->umum))
                    <li class="event" data-date="{{ $keluhan->tgl_approve_umum }}">
                        <h3>Permintaan ditolak Subfungsi Umum</h3>
                        <p>Permintaan telah ditolak oleh <b>{{ $keluhan->umum }}</b> dengan alasan <b>{{ $keluhan->catatan_umum }}</b></p>
                    </li>
                    @endif

                    @if ($keluhan->id_status>=4 AND !is_null($keluhan->tgl_approve_umum))
                    <li class="event" data-date="{{ $keluhan->tgl_approve_umum }}">
                        <h3>Permintaan diterima Subfungsi Umum</h3>
                        <p>Permintaan telah diterima oleh <b>{{ $keluhan->umum }}</b> dan dikirim ke Fungsi IPDS</p>
                        <p>Catatan Subfungsi Umum: {{ $keluhan->catatan_umum }}</p>
                    </li>
                    @endif

                    @if (!is_null($keluhan->ipds))
                        @if ($keluhan->id_status>=5)
                        <li class="event" data-date="{{ $keluhan->tgl_proses_ipds }}">
                            <h3>Sedang diproses di Fungsi IPDS</h3>
                            <p>Barang sedang diperiksa oleh <b>{{ $keluhan->ipds }}</b></p>
                        </li>
                        @endif

                        @if ($keluhan->id_status>=6 AND !is_null($keluhan->id_rekanan))
                        <li class="event" data-date="{{ $keluhan->tgl_kirim_rekanan }}">
                            <h3>Sedang diproses di rekanan</h3>
                            <p>Barang sedang diperbaiki di <b>{{ $keluhan->nama_rekanan }}</b></p>
                            <p>Catatan Fungsi IPDS: {{ $keluhan->catatan_ipds }}</p>
                        </li>
                        @endif

                        @if ($keluhan->id_status>=7)
                        <li class="event" data-date="{{ $keluhan->tgl_selesai }}">
                            <h3>Sudah selesai di Fungsi IPDS</h3>
                            <p>Barang sudah selesai di Fungsi IPDS dan dapat diambil di Subfungsi Umum</p>
                            @if (!is_null($keluhan->id_rekanan))
                                <p>Catatan Rekanan: {{ $keluhan->catatan_rekanan }}</p>
                            @else
                                <p>Catatan Fungsi IPDS: {{ $keluhan->catatan_ipds }}</p>
                            @endif
                            <p>Biaya: {{ $keluhan->biaya }}</p>
                        </li>
                        @endif
                    @endif

                    @if ($keluhan->id_status>=8 AND is_null($keluhan->ipds))
                    <li class="event" data-date="{{ $keluhan->tgl_selesai }}">
                        <h3>Sudah selesai di Subfungsi Umum</h3>
                        <p>Permintaan telah diterima dan selesai oleh <b>{{ $keluhan->umum }}</b> serta sudah bisa diambil di Subfungsi Umum</p>
                        <p>Catatan Subfungsi Umum: {{ $keluhan->catatan_umum }}</p>
                        <p>Biaya: {{ $keluhan->biaya }}</p>
                    </li>
                    @endif

                    @if ($keluhan->id_status>=9)
                    <li class="event" data-date="{{ $keluhan->tgl_diambil }}">
                        <h3>Sudah diterima oleh pemegang BMN</h3>
                        <p>Barang sudah diambil kembali oleh <b>{{ $keluhan->pemegang_bmn}}</b></p>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>

