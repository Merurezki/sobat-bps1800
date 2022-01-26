<!-- Tab -->
<ul class="nav nav-tabs">
    <a id="pegawaiButton" class="nav-link" href="{{ route('admin/master/pegawai') }}">
        <li class="nav-item"><b>Pegawai</b></li>
    </a>
    <a id="ruanganButton" class="nav-link" href="{{ route('admin/master/ruangan') }}">
        <li class="nav-item"><b>Ruangan</b></li>
    </a>
    <a id="permintaanButton" class="nav-link" href="{{ route('admin/master/permintaan') }}">
        <li class="nav-item"><b>Permintaan</b></li>
    </a>
    <a id="merkButton" class="nav-link" href="{{ route('admin/master/merk') }}">
        <li class="nav-item"><b>Merk</b></li>
    </a>
    <a id="typeButton" class="nav-link" href="{{ route('admin/master/type') }}">
        <li class="nav-item"><b>Type</b></li>
    </a>
    <a id="rekananButton" class="nav-link" href="{{ route('admin/master/rekanan') }}">
        <li class="nav-item"><b>Rekanan</b></li>
    </a>
</ul>
<!-- Tab end -->

<script type="text/javascript">
    document.getElementById("masterPage").classList.add('active');
</script>