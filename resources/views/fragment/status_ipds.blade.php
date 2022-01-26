@if (($keluhan->id_status==4 OR $keluhan->id_ipds==Auth::user()->userSobat->id) AND $keluhan->id_status<7)

    <!-- Tombol ubah status keluhan -->
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ubahStatus{{ $i }}"><i class="fas fa-tasks p-0"></i></button>                      

    <!-- Modal ubah status keluhan -->
    <div class="modal fade" id="ubahStatus{{ $i }}">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header">
                    <h4 class="modal-title">Ubah Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="{{ route('ipds/keluhan/status') }}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" value="{{ $keluhan->id_keluhan }}" name="id_keluhan">

                        <div class="form-group">
                            <label>Nama Pelapor</label>
                            <input class="form-control" type="text" value="{{ $keluhan->pelapor }}" disabled></input>
                        </div>

                        <div class="form-group">
                            <label>Permintaan</label>
                            <input class="form-control" type="text" value="{{ $keluhan->nama_kategori_permintaan }} / {{ $keluhan->nama_permintaan }}" disabled></input>
                        </div>

                        @if (($keluhan->id_kategori_permintaan)==1)
                        <div class="form-group">
                            <label>Type</label>
                            <input class="form-control" type="text" value="{{ $keluhan->nama_merk }} / {{ $keluhan->nama_type }}" disabled></input>
                        </div>
                        @endif

                        <div id="divIdStatus{{ $i }}" class="form-group">
                            <label for="idStatus{{ $i }}">Status</label>
                            <select id="idStatus{{ $i }}" name="id_status" class="form-control" required>
                            @foreach ($statuss as $k => $status)
                                @if (($status->id_status)>=($keluhan->id_status) AND ($status->id_status)<8)
                                    @if (($status->id_status)==($keluhan->id_status))
                                    <option value="{{ $status->id_status }}" disabled selected>{{ $status->nama_status }}</option>
                                    @else
                                    <option value="{{ $status->id_status }}">{{ $status->nama_status }}</option>
                                    @endif
                                @endif
                            @endforeach
                            </select>
                        </div>

                        <script type="text/javascript">
                            $(document).ready(function() {
                                var doc = document.getElementById("idStatus{{ $i }}");
                                var div = document.getElementById("divIdStatus{{ $i }}");
                                doc.addEventListener('change', function () {
                                    var opt = doc.value;
                                    if(opt==5){
                                        $("#opt6{{ $i }}").remove();
                                        $("#opt7{{ $i }}").remove();

                                        var html5;
                                        html5 = '<div id="opt5{{ $i }}">';
                                        html5+= '<div class="form-group">';
                                        html5+= '<label for="idIpds{{ $i }}">Nama Admin IPDS</label>';
                                        html5+= '<input id="idIpds{{ $i }}" class="form-control" type="text" value="{{ Auth::user()->pegawai->nama }}" disabled></input>';
                                        html5+= '</div>';
                                        html5+= '</div>';
                                        $($(html5)).insertAfter(div);
                                    }
                                    
                                    else if(opt==6){
                                        $("#opt5{{ $i }}").remove();
                                        $("#opt7{{ $i }}").remove();

                                        var html6;
                                        html6 = '<div id="opt6{{ $i }}">';

                                        html6+= '<div class="form-group">';
                                        html6+= '<label for="catatanIPDS{{ $i }}">Catatan IPDS</label>';
                                        html6+= '<textarea id="catatanIPDS{{ $i }}" name="catatan_ipds" class="form-control" rows="3" required></textarea>';
                                        html6+= '</div>';

                                        html6+= '<div class="form-group">';
                                        html6+= '<label for="idRekanan{{ $i }}">Rekanan</label>';
                                        html6+= '<div class="row">';
                                        html6+= '<div class="col-2 pr-2">';
                                        html6+= '<input id="idRekanan{{ $i }}" name="id_rekanan" list="idRekanan_list{{ $i }}" class="form-control" required>';
                                        html6+= '</div>';
                                        html6+= '<div class="col pl-0">';
                                        html6+= '<input id="idRekanan_text{{ $i }}" type="text" value="--Nama Rekanan--" class="form-control" disabled>';
                                        html6+= '</div>';
                                        html6+= '</div>';
                                        html6+= '<datalist id="idRekanan_list{{ $i }}">';
                                        html6+= '@foreach ($rekanans as $k => $rekanan)';
                                        html6+= '<option value="{{ $rekanan->id_rekanan }}">{{ $rekanan->nama_rekanan }} - {{ $rekanan->alamat_rekanan }}</option>';
                                        html6+= '@endforeach';
                                        html6+= '</datalist>';
                                        html6+= '</div>';

                                        html6+= '</div>';
                                        $($(html6)).insertAfter(div);

                                        $(document).on('change', '#idRekanan{{ $i }}', function () {
                                            var v = $("#idRekanan_list{{ $i }} option[value='" + $("#idRekanan{{ $i }}").val() + "']").text();
                                            $("#idRekanan_text{{ $i }}").val(v);
                                        });
                                    }
                                    
                                    else if(opt==7){
                                        $("#opt5{{ $i }}").remove();
                                        $("#opt6{{ $i }}").remove();

                                        var html7;
                                        html7 = '<div id="opt7{{ $i }}">';

                                        html7+= '@if (!is_null($keluhan->id_rekanan))';

                                        html7+= '<div class="form-group">';
                                        html7+= '<label for="catatanRekanan{{ $i }}">Catatan Rekanan</label>';
                                        html7+= '<textarea id="catatanRekanan{{ $i }}" name="catatan_rekanan" class="form-control" rows="3" required></textarea>';
                                        html7+= '</div>';
                                        
                                        html7+= '@else';

                                        html7+= '<div class="form-group">';
                                        html7+= '<label for="catatanIPDS{{ $i }}">Catatan IPDS</label>';
                                        html7+= '<textarea id="catatanIPDS{{ $i }}" name="catatan_ipds" class="form-control" rows="3" required></textarea>';
                                        html7+= '</div>';

                                        html7+= '@endif';

                                        html7+= '<div class="form-group">';
                                        html7+= '<label for="biaya{{ $i }}">Biaya (Rp)</label>';
                                        html7+= '<input id="biaya{{ $i }}" name="biaya" class="form-control" type="number" min="0" required>';
                                        html7+= '</div>';

                                        html7+= '</div>';
                                        $($(html7)).insertAfter(div);
                                    }
                                });
                            });
                        </script>
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

@else
    <button class="btn btn-secondary" disabled>
        <i class="fas fa-tasks p-0"></i>
    </button>                      
@endif