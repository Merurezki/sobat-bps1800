@extends('layouts.drawer')

@section('title', App\Models\Role::find(Auth::user()->userSobat->role)->nama_role.' | Dashboard Tahunan')

@section('content')

<script type="text/javascript"> 
    document.getElementById("dashboardPage").classList.add('active'); 
</script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>

@php
    $tahun = \Carbon\Carbon::now()->format('Y');
    $bulan = \Carbon\Carbon::now()->format('m');
@endphp

<div class="d-flex text-center">
    <a href="{{ url('dashboard/'.$tahun.'/'.$bulan.'') }}" class="btn btn-info flex-fill mr-2" role="button">
        <h2>Bulan</h2>
    </a>
    <a href="{{ url('dashboard/'.$tahun.'') }}" class="btn btn-info flex-fill ml-2 active" role="button">
        <h2>Tahun</h2>
    </a>
</div>

<!-- Header -->
<div class="mt-4 text-center">
    <h1 class="display-3"><b>Dashboard {{ $years }}</b></h1>

    <span>
        <form action="{{ route('dashboard/ganti_tahun') }}" method="post" enctype="multipart/form-data">
        @csrf
            <input id="tahunDashboard" type="text" name="tahun_dashboard" class="text-center" value="{{ $years }}">
        </form>
    </span>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#tahunDashboard").datepicker({
                format: "yyyy",
                viewMode: "years", 
                minViewMode: "years",
                autoclose:true
            });  

            $(document).on('change', '#tahunDashboard', function () {
                this.form.submit();
            });
        });
    </script>
</div>
<!-- Header end -->

@include('fragment.dashboard.card')

@include('fragment.dashboard.table')

@if (in_array(Auth::user()->userSobat->role, array(1,2)))

    @include('fragment.dashboard.barchart')

    @include('fragment.dashboard.piechart')

    @include('fragment.dashboard.areachart')

    @include('fragment.dashboard.bubblechart')

@endif
@endsection