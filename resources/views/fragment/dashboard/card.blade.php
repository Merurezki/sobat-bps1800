<!-- Card -->
<div class="row mt-4">

    <div class="col-sm-4">
        <a class="view" data-toggle="modal" data-target="#jumlahPermintaan">
            <div class="card bg-info">
                <div class="card-body text-center text-white">
                    <h5>Jumlah Unit Dilaporkan</h5>
                    <h1><b>{{ $card[10] }}</b></h1>
                </div>
            </div>
        </a>
    </div>

    <!-- Modal jumlah permintaan -->
    <div class="modal fade" id="jumlahPermintaan">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="card bg-info">
                                <div class="card-body text-center text-white">
                                    <h5>Jumlah Unit Ditolak</h5>
                                    <h1><b>{{ $card[11] }}</b></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card bg-warning">
                                <div class="card-body text-center text-dark">
                                    <h5>Jumlah Unit Belum Di-Approve</h5>
                                    <h1><b>{{ $card[12] }}</b></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card bg-success">
                                <div class="card-body text-center text-white">
                                    <h5>Jumlah Unit Diterima</h5>
                                    <h1><b>{{ $card[13] }}</b></h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

    <div class="col-sm-4">
        <a class="view" data-toggle="modal" data-target="#jumlahProses">
            <div class="card bg-warning">
                <div class="card-body text-center text-dark">
                    <h5>Jumlah Unit Sedang Proses</h5>
                    <h1><b>{{ $card[20] }}</b></h1>
                </div>
            </div>
        </a>
    </div>

    <!-- Modal jumlah proses -->
    <div class="modal fade" id="jumlahProses">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="card bg-info">
                                <div class="card-body text-center text-white">
                                    <h5>Form berada di Fungsi IPDS</h5>
                                    <h1><b>{{ $card[21] }}</b></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card bg-warning">
                                <div class="card-body text-center text-dark">
                                    <h5>Sedang dicek di Fungsi IPDS</h5>
                                    <h1><b>{{ $card[22] }}</b></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card bg-success">
                                <div class="card-body text-center text-white">
                                    <h5>Sedang diperbaiki di rekanan</h5>
                                    <h1><b>{{ $card[23] }}</b></h1>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

    <div class="col-sm-4">
        <a class="view" data-toggle="modal" data-target="#jumlahSelesai">
            <div class="card bg-success">
                <div class="card-body text-center text-white">
                    <h5>Jumlah Unit Sudah Selesai</h5>
                    <h1><b>{{ $card[30] }}</b></h1>
                </div>
            </div>
        </a>
    </div>

    <!-- Modal jumlah selesai -->
    <div class="modal fade" id="jumlahSelesai">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
        
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-4">
                            <div class="card bg-info">
                                <div class="card-body text-center text-white">
                                    <h5>Selesai di Fungsi IPDS</h5>
                                    <h1><b>{{ $card[31] }}</b></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card bg-warning">
                                <div class="card-body text-center text-dark">
                                    <h5>Selesai di Subfungsi Umum</h5>
                                    <h1><b>{{ $card[32] }}</b></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="card bg-success">
                                <div class="card-body text-center text-white">
                                    <h5>Sudah diambil</h5>
                                    <h1><b>{{ $card[33] }}</b></h1>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal end -->

</div>
<!-- Card end -->