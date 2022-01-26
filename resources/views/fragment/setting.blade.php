<!-- Modal setting -->
<div class="modal fade" id="setting">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header">
                <h4 class="modal-title">Setting</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <div class="form-group">
                    <label for="usernameUser">Username</label>
                    <input id="usernameUser" name="username" class="form-control" type="text" maxlength="255" value="{{ Auth::user()->pegawai->username }}" required>
                </div>

                <div class="form-group">
                    <label for="pwLamaUser">Password Lama</label>
                    <input id="pwLamaUser" name="pw_lama" class="form-control" type="password" maxlength="255">
                </div>

                <div class="form-group">
                    <label for="pwBaruUser">Password Baru</label>
                    <input id="pwBaruUser" name="pw_baru" class="form-control" type="password" maxlength="255">
                </div>

                <button id="buttonSetting" type="button" class="btn btn-primary">Submit</button>

                <div id="usernameCheckS" class="alert alert-success alert-block mt-3" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong id="usernameCheckMsgS"></strong>
                </div>

                <div id="usernameCheckF" class="alert alert-danger alert-block mt-3" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong id="usernameCheckMsgF"></strong>
                </div>

                <div id="passwordCheckS" class="alert alert-success alert-block mt-3" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong id="passwordCheckMsgS"></strong>
                </div>

                <div id="passwordCheckF" class="alert alert-danger alert-block mt-3" style="display: none;">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong id="passwordCheckMsgF"></strong>
                </div>

                <script type="text/javascript">
                    $('#buttonSetting').click(function(e){
                        document.getElementById("usernameCheckS").style.display = 'none';
                        document.getElementById("usernameCheckF").style.display = 'none';
                        document.getElementById("passwordCheckS").style.display = 'none';
                        document.getElementById("passwordCheckF").style.display = 'none';

                        e.preventDefault();
                        var username = $('#usernameUser').val();
                        var pwdlama  = $('#pwLamaUser').val();
                        var pwdbaru  = $('#pwBaruUser').val();
                
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                
                        $.ajax({
                            type: "POST",
                            url: "{{ route('setting') }}",
                            data: {
                                username: username,
                                pwdlama: pwdlama,
                                pwdbaru: pwdbaru,
                            },
                            success: function (response) {
                                document.getElementById("pwLamaUser").value = '';
                                document.getElementById("pwBaruUser").value = '';

                                if (response.msg1s != ''){
                                    document.getElementById("usernameCheckS").style.display = 'block';
                                    document.getElementById("usernameCheckMsgS").innerText = response.msg1s;
                                }
                                if (response.msg1f != ''){
                                    document.getElementById("usernameCheckF").style.display = 'block';
                                    document.getElementById("usernameCheckMsgF").innerText = response.msg1f;
                                }
                                if (response.msg2s != ''){
                                    document.getElementById("passwordCheckS").style.display = 'block';
                                    document.getElementById("passwordCheckMsgS").innerText = response.msg2s;
                                }
                                if (response.msg2f != ''){
                                    document.getElementById("passwordCheckF").style.display = 'block';
                                    document.getElementById("passwordCheckMsgF").innerText = response.msg2f;
                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<!-- Modal end -->