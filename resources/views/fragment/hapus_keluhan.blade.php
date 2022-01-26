<!-- Tombol hapus keluhan user -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusKeluhan{{ $i }}"><i class="far fa-trash-alt p-0"></i></button>

<!-- Modal hapus keluhan -->
<div class="modal fade" id="hapusKeluhan{{ $i }}">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header">
                <h4 class="modal-title">Hapus Keluhan</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
    
            <!-- Modal body -->
            <div class="modal-body">
                <form method="post" action="keluhan/hapus" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" value="{{ $keluhan->id_keluhan }}" name="id_keluhan">
                    <p>Anda yakin ingin menghapus keluhan ini?</p>
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