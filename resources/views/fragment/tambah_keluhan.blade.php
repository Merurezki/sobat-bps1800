<!-- Modal tambah keluhan -->
<div class="modal fade" id="tambahKeluhan">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header">
                <h4 class="modal-title">Entri Keluhan Baru</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form id="formTambah" method="post" action="{{ route('keluhan') }}" enctype="multipart/form-data">
                @csrf
                
                    <div class="form-group">
                        <label>Nama Pelapor</label>
                        <input id="idPelapor" name="id_pelapor" class="form-control" type="text" value="{{ Auth::user()->pegawai->nama }}" disabled></input>
                    </div>

                    <div class="form-group">
                        <label>Daftar Keluhan</label>
                        <table id="tabelPermintaan" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Permintaan</th>
                                    <th scope="col">Merk / Type</th>
                                    <th scope="col">Pemegang BMN</th>
                                    <th scope="col">Permasalahan</th>
                                    <th scope="col">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="bodyPermintaan"></tr>
                            </tbody>
                        </table>
                    </div>

                    <div id="tambahPermintaan" cnt="0" class="form-group">
                        <button type="button" class="btn btn-success">+ Tambah Barang/Permintaan</button>
                    </div>

                    <input id="jumlahPermintaan" name="jumlah_permintaan" type="hidden" value="0">

                    <div class="form-group">
                        <label>Penanggung Jawab Ruangan</label>
                        @foreach ($ruangans as $i => $ruangan)
                            <input id="pjRuang" name="pj_ruangan" class="form-control" type="text" value="{{ $ruangan->kode_ruangan }} - {{ $ruangan->nama_ruangan }}" disabled></input>
                        @endforeach
                    </div>
            </div>
    
            <!-- Modal footer -->
            <div class="modal-footer">
                <button id="submitKeluhan" type="button" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->

<script type="text/javascript">
    $(document).ready(function(){
        $("#tambahPermintaan").click(function(){
            
            var jumlahPermintaan = document.getElementById("jumlahPermintaan");
            var numItems = Number(jumlahPermintaan.value);
            numItems += 1;

            if(numItems <= 3){
                var html;
                html = '<div id="formTambahPermintaan'+numItems+'">';

                html+= '<div class="form-group">';
                html+= '<label>Jenis Permintaan</label>';
                html+= '<select id="idPermintaan'+numItems+'" name="id_permintaan'+numItems+'" class="form-control" required>';
                html+= '<option value="" disabled selected>--Jenis Permintaan--</option>';
                html+= '@foreach ($kat_permintaans as $i => $kat_permintaan)';
                html+= '<optgroup label="{{ $kat_permintaan->nama_kategori_permintaan }}">';
                html+= '@foreach ($permintaans as $i => $permintaan)';
                html+= '@if (($permintaan->id_kategori_permintaan)==($kat_permintaan->id_kategori_permintaan))';
                html+= '<option value="{{ $permintaan->id_permintaan }}">{{ $permintaan->nama_permintaan }}</option>';
                html+= '@endif';
                html+= '@endforeach';
                html+= '</optgroup>';
                html+= '@endforeach';
                html+= '</select>';
                html+= '</div>';

                html+= '<div id="lainnyaDiv'+numItems+'" class="form-group" style="display: none;">';
                html+= '<label>Permintaan Lainnya</label>';
                html+= '<input id="lainnya'+numItems+'" name="lainnya'+numItems+'" class="form-control" type="text" maxlength="20" placeholder="Tulis jenis permintaan lainnya" required>';
                html+= '</div>';

                html+= '<div id="idTypeDiv'+numItems+'" class="form-group" style="display: none;">';
                html+= '<label>Type Barang</label>';
                html+= '<div class="row">';
                html+= '<div class="col-2 pr-2">';
                html+= '<input list="idType_list'+numItems+'" id="idType'+numItems+'" name="id_type'+numItems+'" value="" class="form-control" required>';
                html+= '</div>';
                html+= '<div class="col pl-0">';
                html+= '<input id="idType_text'+numItems+'" type="text" class="form-control" disabled>';
                html+= '</div>';
                html+= '</div>';
                html+= '<datalist id="idType_list'+numItems+'">';
                html+= '@foreach ($types as $i => $type)';
                html+= '<option value="{{ $type->id_type }}">{{ $type->nama_merk }} / {{ $type->nama_type }}</option>';
                html+= '@endforeach';
                html+= '</datalist>';
                html+= '</div>';

                html+= '<div id="typeLainnyaDiv'+numItems+'" class="form-group" style="display: none;">';
                html+= '<label>Type Lainnya</label>';
                html+= '<input id="typeLainnya'+numItems+'" name="type_lainnya'+numItems+'" class="form-control" type="text" maxlength="30" placeholder="Tulis [nama merk] - [nama type]" required>';
                html+= '</div>';

                html+= '<div class="form-group">';
                html+= '<label>Pemegang BMN</label>';
                html+= '<div class="row">';
                html+= '<div class="col-2 pr-2">';
                html+= '<input list="pemegangBMN_list'+numItems+'" id="pemegangBMN'+numItems+'" name="pemegang_bmn'+numItems+'" class="form-control" required>';
                html+= '</div>';
                html+= '<div class="col pl-0">';
                html+= '<input id="pemegangBMN_text'+numItems+'" type="text" class="form-control" disabled>';
                html+= '</div>';
                html+= '</div>';
                html+= '<datalist id="pemegangBMN_list'+numItems+'">';
                html+= '@foreach ($pegawais as $i => $pegawai)';
                html+= '<option value="{{ $pegawai->id }}">{{ $pegawai->nip_lama }} - {{ $pegawai->nama }}</option>';
                html+= '@endforeach';
                html+= '</datalist>';
                html+= '</div>';

                html+= '<div class="form-group">';
                html+= '<label>Permasalahan</label>';
                html+= '<textarea id="isiMasalah'+numItems+'" name="masalah'+numItems+'" class="form-control" rows="5" required></textarea>';
                html+= '</div>';

                html+= '<div class="form-group">';
                html+= '<button id="submitPermintaan" type="button" class="btn btn-warning">Tambahkan</button>';
                html+= '<button id="cancelPermintaan" type="button" class="btn btn-danger ml-2">Batalkan</button>';
                html+= '</div>';

                html+= '</div>';

                $($(html)).insertAfter(jumlahPermintaan);

                document.getElementById("tambahPermintaan").setAttribute("cnt", numItems);
                $("#tambahPermintaan").hide();
            }else{
                alert("Maksimal hanya 3 permintaan dalam satu laporan.");
            }

            // menampilkan input permintaan lainnya dan input merk/type jika permintaan kerusakan terpilih
            document.getElementById("idPermintaan"+numItems.toString()).addEventListener('change', function () {
                var idPermintaan1;
                idPermintaan1 = document.getElementById("idPermintaan"+numItems.toString());
                idPermintaan1 = idPermintaan1.options[idPermintaan1.selectedIndex].text;
                var style1 = idPermintaan1 == '# Lainnya' ? 'block' : 'none';
                document.getElementById("lainnyaDiv"+numItems.toString()).style.display = style1;

                if(style1=="none"){
                    document.getElementById("lainnya"+numItems.toString()).value = "";
                }

                var idPermintaan2 = document.querySelector('#idPermintaan'+numItems.toString()+' option:checked').parentElement.label;
                var style2 = idPermintaan2 == 'Kerusakan' ? 'block' : 'none';
                document.getElementById("idTypeDiv"+numItems.toString()).style.display = style2;

                if(style2=="none"){
                    document.getElementById("idType"+numItems.toString()).value = "";
                    document.getElementById("idType_text"+numItems.toString()).value = "";
                    document.getElementById("typeLainnyaDiv"+numItems.toString()).style.display = "none";
                    document.getElementById("typeLainnya"+numItems.toString()).value = "";
                }
            });

            // menampilkan input type lainnya
            document.getElementById("idType"+numItems.toString()).addEventListener('change', function () {
                var idType = document.getElementById("idType"+numItems.toString()).value;
                var style = idType == '999' ? 'block' : 'none';
                document.getElementById("typeLainnyaDiv"+numItems.toString()).style.display = style;

                if(style=="none"){
                    document.getElementById("typeLainnya"+numItems.toString()).value = "";
                }
            });

            $(document).on('change', '#idType'+numItems, function () {
                var v = $("#idType_list"+numItems+" option[value='" + $("#idType"+numItems).val() + "']").text();
                $("#idType_text"+numItems).val(v);
            });

            $(document).on('change', '#pemegangBMN'+numItems, function () {
                var v = $("#pemegangBMN_list"+numItems+" option[value='" + $("#pemegangBMN"+numItems).val() + "']").text();
                $("#pemegangBMN_text"+numItems).val(v);
            });

            // ketika tombol submit tambah permintaan di klik
            $("#submitPermintaan").click(function(){

                var in1, in1a, in1b, in1c, in2, in3, in4;
                in1a = document.getElementById("idPermintaan"+numItems.toString()).value;
                in1b = document.getElementById("idPermintaan"+numItems.toString());
                in1b = in1b.options[in1b.selectedIndex].text;
                in1c = document.getElementById("lainnya"+numItems.toString()).value;
                in1d = document.querySelector('#idPermintaan'+numItems.toString()+' option:checked').parentElement.label;
                in2a  = document.getElementById("idType"+numItems.toString()).value;
                in2b  = document.getElementById("typeLainnya"+numItems.toString()).value;
                in3  = document.getElementById("pemegangBMN"+numItems.toString()).value;
                in4  = document.getElementById("isiMasalah"+numItems.toString()).value;

                if(in1a == ''){
                    alert("Jenis permintaan masih kosong!");
                    return;
                }

                if(in1b == '# Lainnya'){
                    if(in1c == ''){
                        alert("Jenis permintaan lainnya masih kosong!");
                        return;
                    }
                }

                if(in1d == 'Kerusakan'){
                    if(in2a == ''){
                        alert("Type barang masih kosong!");
                        return;
                    }

                    if(in2a == '999'){
                        if(in2b == ''){
                            alert("Type barang lainnya masih kosong!");
                            return;
                        }
                    }
                }

                if(in3 == ''){
                    alert("Pemegang BMN masih kosong!");
                    return;
                }

                if(in4 == ''){
                    alert("Permasalahan masih kosong!");
                    return;
                }

                addTd();

                function addTd(){
                    var td1, td1a, td1b, td2, td2a, td2b, td3, td4;
                    td1a = document.querySelector('#idPermintaan'+numItems.toString()+' option:checked').parentElement.label;

                    if(document.getElementById("lainnya"+numItems.toString()).value == ''){
                        td1b = document.getElementById("idPermintaan"+numItems.toString());
                        td1b = td1b.options[td1b.selectedIndex].text;
                    }else{
                        td1b  = document.getElementById("lainnya"+numItems.toString()).value;
                    }

                    td1  = td1a + ' / ' + td1b;

                    if(td1a == 'Kerusakan'){
                        if(document.getElementById("typeLainnya"+numItems.toString()).value == ''){
                            td2  = document.getElementById("idType_text"+numItems.toString()).value;
                        }else{
                            td2  = document.getElementById("typeLainnya"+numItems.toString()).value;
                        }
                    }else{
                        td2  = '-';
                        
                    }

                    td3 = document.getElementById("pemegangBMN_text"+numItems.toString()).value;
                    
                    td4 = document.getElementById("isiMasalah"+numItems.toString()).value;

                    var bodyTable, html2;
                    bodyTable = document.getElementById("bodyPermintaan");
                    html2 = '<tr>';
                    html2+= '<td id="numTd'+numItems+'">'+numItems+'</td>';
                    html2+= '<td>' + td1 + '</td>';
                    html2+= '<td>' + td2 + '</td>';
                    html2+= '<td>' + td3 + '</td>';
                    html2+= '<td>' + td4 + '</td>';
                    html2+= '<td><button id="hapusPermintaan'+numItems+'" type="button" class="btn btn-danger" cnt="'+numItems+'" onclick="deleteRow(this)"><i class="far fa-trash-alt p-0"></i></button></td>';
                    html2+= '</tr>';

                    $($(html2)).insertBefore(bodyTable);

                    jumlahPermintaan.value = numItems;
                    $("#formTambahPermintaan"+numItems.toString()).hide();
                    $("#tambahPermintaan").show();
                }
            });

            // ketika tombol cancel tambah permintaan di klik
            $("#cancelPermintaan").click(function(){
                var num = Number(numItems)-1;
                $("#formTambahPermintaan"+numItems.toString()).remove();
                document.getElementById("tambahPermintaan").setAttribute("cnt", num);
                $("#tambahPermintaan").show();
            });
        });
    });

    // jika klik tombol submit keluhan tapi permintaan masih kosong
    $("#submitKeluhan").click(function(){
        var numItems = Number(document.getElementById("jumlahPermintaan").value);
        if (numItems == '0'){
            alert("Permintaan masih kosong!");
        }else{
            $("#formTambah").submit();
        }
    });

    function deleteRow(r) {
        var index = r.attributes.cnt.value;
        $("#formTambahPermintaan"+index.toString()).remove();

        var jumlahPermintaan = document.getElementById("jumlahPermintaan");
        var buttonPermintaan = document.getElementById("tambahPermintaan");
        var numItems1 = Number(jumlahPermintaan.value);
        var numItems2 = Number(buttonPermintaan.getAttribute("cnt"));

        if(numItems1 == numItems2){
            numItems1 -= 1;
            jumlahPermintaan.value = numItems1;
            numItems2 -= 1;
            buttonPermintaan.setAttribute("cnt", numItems2);
        } else {
            $("#formTambahPermintaan"+numItems2.toString()).remove();
            numItems1 -= 1;
            jumlahPermintaan.value = numItems1;
            numItems2 -= 2;
            buttonPermintaan.setAttribute("cnt", numItems2);
        }

        for(let i=index; i<=numItems1; i++){
            var j = Number(i)+1;

            var cd = "hapusPermintaan"+j.toString();
            var dc = "hapusPermintaan"+i.toString();
            document.getElementById(cd).setAttribute("cnt", i.toString());
            document.getElementById(cd).id = dc;

            var tdNum = "numTd"+j.toString();
            var numTd = "numTd"+i.toString();
            document.getElementById(tdNum).innerHTML = i.toString();
            document.getElementById(tdNum).id = numTd;

            var a1 = "formTambahPermintaan"+i.toString();
            var a2 = "formTambahPermintaan"+j.toString();
            var b1 = "idPermintaan"+i.toString();
            var b2 = "idPermintaan"+j.toString();
            var c1 = "idType"+i.toString();
            var c2 = "idType"+j.toString();
            var c3 = "idType_text"+i.toString();
            var c4 = "idType_text"+j.toString();
            var c5 = "idType_list"+i.toString();
            var c6 = "idType_list"+j.toString();
            var c7 = "idTypeDiv"+i.toString();
            var c8 = "idTypeDiv"+j.toString();
            var d1 = "pemegangBMN"+i.toString();
            var d2 = "pemegangBMN"+j.toString();
            var d3 = "pemegangBMN_text"+i.toString();
            var d4 = "pemegangBMN_text"+j.toString();
            var d5 = "pemegangBMN_list"+i.toString();
            var d6 = "pemegangBMN_list"+j.toString();
            var e1 = "isiMasalah"+i.toString();
            var e2 = "isiMasalah"+j.toString();
            document.getElementById(a2).id = a1;
            document.getElementById(b2).id = b1;
            document.getElementById(c2).id = c1;
            document.getElementById(c4).id = c3;
            document.getElementById(c6).id = c5;
            document.getElementById(c8).id = c7;
            document.getElementById(d2).id = d1;
            document.getElementById(d4).id = d3;
            document.getElementById(d6).id = d5;
            document.getElementById(e2).id = e1;

            var b3 = "id_permintaan"+i.toString();
            var c3 = "id_type"+i.toString();
            var d3 = "pemegang_bmn"+i.toString();
            var e3 = "masalah"+i.toString();
            document.getElementById(b1).setAttribute("name", b3);
            document.getElementById(c1).setAttribute("name", c3);
            document.getElementById(d1).setAttribute("name", d3);
            document.getElementById(e1).setAttribute("name", e3);
        }

        var p = r.parentNode.parentNode;
        p.parentNode.removeChild(p);
    }
</script>