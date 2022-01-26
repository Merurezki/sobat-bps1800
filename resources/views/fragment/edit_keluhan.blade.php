<!-- Tombol edit keluhan user -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editKeluhan{{ $i }}"><i class="fas fa-edit p-0"></i></button>

<!-- Modal edit keluhan -->
<div class="modal fade" id="editKeluhan{{ $i }}">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Keluhan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form id="formEdit{{ $i }}" method="post" action="keluhan/edit" enctype="multipart/form-data">
                @csrf
                
                    <input type="hidden" value="{{ $keluhan->id_keluhan }}" name="id_keluhan">

                    {{-- Permintaan --------------------------------------------------------------------------------- --}}

                    <div id="idPermintaanDiv{{ $i }}" class="form-group">
                        <label for="idPermintaan{{ $i }}">Jenis Permintaan</label>
                        <select id="idPermintaan{{ $i }}" name="id_permintaan" class="form-control" required>
                        @foreach ($kat_permintaans as $k => $kat_permintaan)
                            <optgroup label="{{ $kat_permintaan->nama_kategori_permintaan }}">
                            @foreach ($permintaans as $l => $permintaan)
                                @if (($permintaan->id_kategori_permintaan)==($kat_permintaan->id_kategori_permintaan))
                                    @if (($keluhan->id_permintaan)==($permintaan->id_permintaan))
                                    <option value="{{ $permintaan->id_permintaan }}" selected>{{ $permintaan->nama_permintaan }}</option>
                                    @else
                                    <option value="{{ $permintaan->id_permintaan }}">{{ $permintaan->nama_permintaan }}</option>
                                    @endif
                                @endif
                            @endforeach
                            </optgroup>
                        @endforeach
                        </select>
                    </div>

                    {{-- Permintaan Lainnya-------------------------------------------------------------------------- --}}

                    <div id="permintaanLainnyaDiv{{ $i }}" class="form-group" style="display:none;">
                        <label for="permintaanLainnya{{ $i }}">Permintaan Lainnya</label>
                        <input id="permintaanLainnya{{ $i }}" name="permintaan_lainnya" class="form-control" type="text" maxlength="20" value="{{ $keluhan->permintaan_lainnya }}" placeholder="Tulis jenis permintaan lainnya">

                        <script type="text/javascript">
                            @if (!is_null($keluhan->permintaan_lainnya))
                                document.getElementById("permintaanLainnyaDiv{{ $i }}").style.display = 'block';
                                $("#permintaanLainnya{{ $i }}").attr("required", true);
                            @endif

                            document.getElementById("idPermintaan{{ $i }}").addEventListener('change', function () {
                                var permintaan;
                                permintaan = document.getElementById("idPermintaan{{ $i }}");
                                permintaan = permintaan.options[permintaan.selectedIndex].text;

                                var style = permintaan == '# Lainnya' ? 'block' : 'none';
                                document.getElementById("permintaanLainnyaDiv{{ $i }}").style.display = style;

                                if(style=="none"){
                                    document.getElementById("permintaanLainnya{{ $i }}").value = "";
                                }

                                var require = permintaan == '# Lainnya' ? true : false;
                                $("#permintaanLainnya{{ $i }}").attr("required", require);
                            });
                        </script>
                    </div>

                    {{-- Type Barang--------------------------------------------------------------------------------- --}}

                    <div id="idTypeDiv{{ $i }}" class="form-group" style="display:none;">
                        <label for="idType{{ $i }}">Type Barang</label>
                        <div class="row">
                            <div class="col-2 pr-2">
                                <input id="idType{{ $i }}" name="id_type" list="idType_list{{ $i }}" value="{{ $keluhan->id_type }}" class="form-control">
                            </div>
                            <div class="col pl-0">
                                <input id="idType_text{{ $i }}" type="text" value="{{ $keluhan->nama_merk }} / {{ $keluhan->nama_type }}" class="form-control" disabled>
                            </div>
                        </div>
                        
                        <datalist id="idType_list{{ $i }}">
                            @foreach ($types as $k => $type)
                                <option value="{{ $type->id_type }}">{{ $type->nama_merk }} / {{ $type->nama_type }}</option>
                            @endforeach
                        </datalist>

                        <script type="text/javascript">
                            @if (!is_null($keluhan->id_type))
                                document.getElementById("idTypeDiv{{ $i }}").style.display = 'block';
                                $("#idType{{ $i }}").attr("required", true);
                            @endif

                            document.getElementById("idPermintaan{{ $i }}").addEventListener('change', function () {
                                var katPermintaan = document.querySelector('#idPermintaan{{ $i }} option:checked').parentElement.label;
                                
                                var style = katPermintaan == 'Kerusakan' ? 'block' : 'none';
                                document.getElementById("idTypeDiv{{ $i }}").style.display = style;

                                if(style=="none"){
                                    document.getElementById("idType{{ $i }}").value = "";
                                    document.getElementById("idType_text{{ $i }}").value = "";
                                    document.getElementById("typeLainnyaDiv{{ $i }}").style.display = "none";
                                    document.getElementById("typeLainnya{{ $i }}").value = "";
                                    $("#typeLainnya{{ $i }}").attr("required", false);
                                }

                                var require = katPermintaan == 'Kerusakan' ? true : false;
                                $("#idType{{ $i }}").attr("required", require);
                            });

                            $(document).on('change', '#idType{{ $i }}', function () {
                                var v = $("#idType_list{{ $i }} option[value='" + $("#idType{{ $i }}").val() + "']").text();
                                $("#idType_text{{ $i }}").val(v);
                            });
                        </script>
                    </div>

                    {{-- Type Lainnya-------------------------------------------------------------------------------- --}}

                    <div id="typeLainnyaDiv{{ $i }}" class="form-group" style="display:none;">
                        <label for="typeLainnya{{ $i }}">Type Lainnya</label>
                        <input id="typeLainnya{{ $i }}" name="type_lainnya" class="form-control" type="text" maxlength="30" value="{{ $keluhan->type_lainnya }}" placeholder="Tulis [nama merk] - [nama type]">

                        <script type="text/javascript">
                            @if (!is_null($keluhan->type_lainnya))
                                document.getElementById("typeLainnyaDiv{{ $i }}").style.display = 'block';
                                $("#typeLainnya{{ $i }}").attr("required", true);
                            @endif

                            $(document).on('change', '#idType{{ $i }}', function () {
                                var idType = $("#idType{{ $i }}").val();
                                var style = idType == 999 ? 'block' : 'none';
                                document.getElementById("typeLainnyaDiv{{ $i }}").style.display = style;

                                if(style=="none"){
                                    document.getElementById("typeLainnya{{ $i }}").value = "";
                                }

                                var require = idType == 999 ? true : false;
                                $("#typeLainnya{{ $i }}").attr("required", require);
                            });
                        </script>
                    </div>

                    {{-- Pemegang BMN-------------------------------------------------------------------------------- --}}

                    <div class="form-group">
                        <label for="pemegangBMN{{ $i }}">Pemegang BMN</label>
                        <div class="row">
                            <div class="col-2 pr-2">
                                <input id="pemegangBMN{{ $i }}" name="pemegang_bmn" list="pemegangBMN_list{{ $i }}" value="{{ $keluhan->id_pemegang_bmn }}" class="form-control" required>
                            </div>
                            <div class="col pl-0">
                                <input id="pemegangBMN_text{{ $i }}" type="text" value="{{ $keluhan->pemegang_bmn }}" class="form-control" disabled>
                            </div>
                        </div>
                        <datalist id="pemegangBMN_list{{ $i }}">
                            @foreach ($pegawais as $k => $pegawai)
                            <option value="{{ $pegawai->id }}">{{ $pegawai->nip_lama }} - {{ $pegawai->nama }}</option>
                            @endforeach
                        </datalist>

                        <script type="text/javascript">
                            $(document).on('change', '#pemegangBMN{{ $i }}', function () {
                                var v = $("#pemegangBMN_list{{ $i }} option[value='" + $("#pemegangBMN{{ $i }}").val() + "']").text();
                                $("#pemegangBMN_text{{ $i }}").val(v);
                            });
                        </script>
                    </div>

                    {{-- Permasalahan-------------------------------------------------------------------------------- --}}

                    <div id="permasalahanDiv{{ $i }}" class="form-group">
                        <label for="permasalahan{{ $i }}">Permasalahan</label>
                        <textarea id="permasalahan{{ $i }}" name="permasalahan" class="form-control" rows="5" required>{{ $keluhan->masalah }}</textarea>
                    </div>
                        
                    {{-- Catatan Umum-------------------------------------------------------------------------------- --}}

                    <div id="catatanUmumDiv{{ $i }}" class="form-group" style="display:none;">
                        <label for="catatanUmum{{ $i }}">Catatan Subfungsi Umum</label>
                        <textarea id="catatanUmum{{ $i }}" name="catatan_umum" class="form-control" rows="5">{{ $keluhan->catatan_umum }}</textarea>

                        <script type="text/javascript">
                            @if ((!is_null($keluhan->tgl_approve_umum) OR (!is_null($keluhan->tgl_selesai) AND !is_null($keluhan->id_umum))) AND in_array(Auth::user()->userSobat->role,array(1,3)))
                                document.getElementById("catatanUmumDiv{{ $i }}").style.display = 'block';
                                $("#catatanUmum{{ $i }}").attr("required", true);
                            @endif
                        </script>
                    </div>

                    {{-- IPDS---------------------------------------------------------------------------------------- --}}

                    <div id="ipdsDiv{{ $i }}" class="form-group" style="display:none;">
                        <label for="ipds{{ $i }}">Admin IPDS</label>
                        <div class="row">
                            <div class="col-2 pr-2">
                                <input id="ipds{{ $i }}" name="ipds" list="ipds_list{{ $i }}" value="{{ $keluhan->id_ipds }}" class="form-control">
                            </div>
                            <div class="col pl-0">
                                <input id="ipds_text{{ $i }}" type="text" value="{{ $keluhan->ipds }}" class="form-control" disabled>
                            </div>
                        </div>
                        
                        <datalist id="ipds_list{{ $i }}">
                            @foreach ($ipdss as $k => $ipds)
                                <option value="{{ $ipds->id }}">{{ $ipds->nip_lama }} - {{ $ipds->nama }}</option>
                            @endforeach
                        </datalist>

                        <script type="text/javascript">
                            @if (!is_null($keluhan->tgl_proses_ipds) AND in_array(Auth::user()->userSobat->role,array(1,2)))
                                document.getElementById("ipdsDiv{{ $i }}").style.display = 'block';
                                $("#ipds{{ $i }}").attr("required", true);
                            @endif

                            $(document).on('change', '#ipds{{ $i }}', function () {
                                var v = $("#ipds_list{{ $i }} option[value='" + $("#ipds{{ $i }}").val() + "']").text();
                                $("#ipds_text{{ $i }}").val(v);
                            });
                        </script>
                    </div>

                    {{-- Catatan IPDS-------------------------------------------------------------------------------- --}}

                    <div id="catatanIpdsDiv{{ $i }}" class="form-group" style="display:none;">
                        <label for="catatanIpds{{ $i }}">Catatan Fungsi IPDS</label>
                        <textarea id="catatanIpds{{ $i }}" name="catatan_ipds" class="form-control" rows="5">{{ $keluhan->catatan_ipds }}</textarea>

                        <script type="text/javascript">
                            @if ((!is_null($keluhan->tgl_kirim_rekanan) OR (!is_null($keluhan->tgl_selesai) AND !is_null($keluhan->id_ipds))) AND in_array(Auth::user()->userSobat->role,array(1,2)))
                                document.getElementById("catatanIpdsDiv{{ $i }}").style.display = 'block';
                                $("#catatanIpds{{ $i }}").attr("required", true);
                            @endif
                        </script>
                    </div>

                    {{-- Rekanan------------------------------------------------------------------------------------- --}}

                    <div id="rekananDiv{{ $i }}" class="form-group" style="display:none;">
                        <label for="rekanan{{ $i }}">Rekanan</label>
                        <div class="row">
                            <div class="col-2 pr-2">
                                <input id="rekanan{{ $i }}" name="rekanan" list="rekanan_list{{ $i }}" value="{{ $keluhan->id_rekanan }}" class="form-control">
                            </div>
                            <div class="col pl-0">
                                <input id="rekanan_text{{ $i }}" type="text" value="{{ $keluhan->nama_rekanan }} - {{ $keluhan->alamat_rekanan }}" class="form-control" disabled>
                            </div>
                        </div>
                        
                        <datalist id="rekanan_list{{ $i }}">
                            @foreach ($rekanans as $k => $rekanan)
                                <option value="{{ $rekanan->id_rekanan }}">{{ $rekanan->nama_rekanan }} - {{ $rekanan->alamat_rekanan }}</option>
                            @endforeach
                        </datalist>

                        <script type="text/javascript">
                            @if (!is_null($keluhan->tgl_kirim_rekanan) AND in_array(Auth::user()->userSobat->role,array(1,2)))
                                document.getElementById("rekananDiv{{ $i }}").style.display = 'block';
                                $("#rekanan{{ $i }}").attr("required", true);
                            @endif

                            $(document).on('change', '#rekanan{{ $i }}', function () {
                                var v = $("#rekanan_list{{ $i }} option[value='" + $("#rekanan{{ $i }}").val() + "']").text();
                                $("#rekanan_text{{ $i }}").val(v);
                            });
                        </script>
                    </div>

                    {{-- Catatan Rekanan----------------------------------------------------------------------------- --}}

                    <div id="catatanRekananDiv{{ $i }}" class="form-group" style="display:none;">
                        <label for="catatanRekanan{{ $i }}">Catatan Rekanan</label>
                        <textarea id="catatanRekanan{{ $i }}" name="catatan_rekanan" class="form-control" rows="3">{{ $keluhan->catatan_rekanan }}</textarea>
                        
                        <script type="text/javascript">
                            @if (!is_null($keluhan->tgl_kirim_rekanan) AND !is_null($keluhan->tgl_selesai) AND in_array(Auth::user()->userSobat->role,array(1,2)))
                                document.getElementById("catatanRekananDiv{{ $i }}").style.display = 'block';
                                $("#catatanRekanan{{ $i }}").attr("required", true);
                            @endif
                        </script>
                    </div>

                    {{-- Biaya--------------------------------------------------------------------------------------- --}}

                    <div id="biayaDiv{{ $i }}" class="form-group" style="display:none;">
                        <label for="biaya{{ $i }}">Biaya (Rp)</label>
                        <input id="biaya{{ $i }}" name="biaya" class="form-control" type="number" min="0" value="{{ $keluhan->biaya }}">

                        <script type="text/javascript">
                            @if (!is_null($keluhan->tgl_selesai) AND in_array(Auth::user()->userSobat->role,array(1,2,3)))
                                document.getElementById("biayaDiv{{ $i }}").style.display = 'block';
                                $("#biaya{{ $i }}").attr("required", true);
                            @endif
                        </script>
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