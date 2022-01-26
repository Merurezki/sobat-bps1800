<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>@yield('title')</title>

    <!-- Jquery & Bootstrap Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

    <!-- Datatable Script -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    <!-- Bootstrap Style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- Sidebars -->
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/" />

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/sidebarstyle.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/timeline.css') }}" />

    <style>
        .table-responsive {
            height: 500px;
            overflow:scroll;
        }

        table thead tr:nth-child(1) th {
            background: white; 
            position: sticky; 
            top:0cm; 
            z-index:10;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo-container py-1">
                    <div class="logo-container">
                        <img class="logo-sidebar" src="{{ asset('img/logo.png') }}" />
                    </div>
                    
                    <div class="brand-name-container ml-1">
                        <div class="brand-name">
                            <b>SOBAT</b></br>
                            <div class="brand-subname">
                                @if (Auth::user()->userSobat->role == 9 AND Auth::user()->userSobat->pj_ruang == 1)
                                    PJ Ruang
                                @else
                                    {{ App\Models\Role::find(Auth::user()->userSobat->role)->nama_role }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="sidebar-body">
                
                <ul class="navigation-list">

                    @php
                        $tahun = \Carbon\Carbon::now()->format('Y');
                        $bulan = \Carbon\Carbon::now()->format('m');
                    @endphp

                    <a href="{{ url('dashboard/'.$tahun.'/'.$bulan.'') }}">
                        <li id="dashboardPage" class="navigation-list-item">
                            <div class="row navigation-link">
                                <div class="col-2">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                                <div class="col-10">
                                    Dashboard
                                </div>
                            </div>
                        </li>
                    </a>

                    @php
                        $notifKeluhan = DB::table('notifikasi_user')
                        ->leftjoin('bmn_keluhan','notifikasi_user.id_keluhan','=','bmn_keluhan.id_keluhan')
                        ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
                        ->where('bmn_grup_keluhan.id_pelapor', Auth::user()->userSobat->id)
                        ->where('bmn_keluhan.is_show',1)
                        ->where('is_read', 0)
                        ->count();   
                    @endphp

                    <a href="{{ route('keluhan') }}">
                        <li id="keluhanPage" class="navigation-list-item">
                            <div class="row navigation-link">
                                <div class="col-2">
                                    <i class="fas fa-flag"></i>
                                </div>
                                <div class="col-10">
                                    Keluhan
                                    @if ($notifKeluhan>0)
                                        <span id="notifKeluhan" class="badge rounded-pill bg-danger float-right">{{ $notifKeluhan }}</span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    </a>

                    <!-- PJ Ruang------------------------------------------------------------------------------------------------------- -->

                    @if (Auth::user()->userSobat->pj_ruang == 1)
                        @php
                            $notifPj = DB::table('notifikasi_pjruang')
                            ->leftjoin('bmn_keluhan','notifikasi_pjruang.id_keluhan','=','bmn_keluhan.id_keluhan')
                            ->leftjoin('bmn_grup_keluhan','bmn_keluhan.id_grup_keluhan','=','bmn_grup_keluhan.id_grup_keluhan')
                            ->leftjoin('users','bmn_grup_keluhan.id_pelapor','=','users.id')
                            ->leftjoin('bmn_master_ruangan','users.ruang','=','bmn_master_ruangan.kode_ruangan')
                            ->where('bmn_master_ruangan.pj_ruangan', Auth::user()->userSobat->id)
                            ->where('bmn_keluhan.is_show',1)
                            ->where('is_read', 0)
                            ->count();
                        @endphp

                        <a href="{{ route('pj_ruang/keluhan') }}">
                            <li id="pjRuangPage" class="navigation-list-item">
                                <div class="row navigation-link">
                                    <div class="col-2">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="col-10">
                                        PJ Ruangan
                                        @if ($notifPj>0)
                                            <span class="badge rounded-pill bg-danger float-right">{{ $notifPj }}</span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </a>
                    @endif

                    <!-- Umum----------------------------------------------------------------------------------------------------------- -->

                    @if (Auth::user()->userSobat->role == 3)
                        @php
                            $notifUmum = DB::table('notifikasi_umum')
                            ->leftjoin('bmn_keluhan','notifikasi_umum.id_keluhan','=','bmn_keluhan.id_keluhan')
                            ->where('bmn_keluhan.is_show',1)
                            ->where('is_read', 0)
                            ->count();
                        @endphp

                        <a href="{{ route('umum/keluhan') }}">
                            <li id="umumPage" class="navigation-list-item">
                                <div class="row navigation-link">
                                    <div class="col-2">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="col-10">
                                        Umum
                                        @if ($notifUmum>0)
                                            <span class="badge rounded-pill bg-danger float-right">{{ $notifUmum }}</span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </a>
                    @endif

                    <!-- IPDS----------------------------------------------------------------------------------------------------------- -->

                    @if (Auth::user()->userSobat->role == 2)
                        @php
                            $notifIpds = DB::table('notifikasi_ipds')
                            ->leftjoin('bmn_keluhan','notifikasi_ipds.id_keluhan','=','bmn_keluhan.id_keluhan')
                            ->where('bmn_keluhan.is_show',1)
                            ->where('is_read', 0)
                            ->count();
                        @endphp

                        <a href="{{ route('ipds/keluhan') }}">
                            <li id="ipdsPage" class="navigation-list-item">
                                <div class="row navigation-link">
                                    <div class="col-2">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="col-10">
                                        IPDS
                                        @if ($notifIpds>0)
                                            <span class="badge rounded-pill bg-danger float-right">{{ $notifIpds }}</span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </a>

                        <a href="{{ url('ipds/laporan/'.$tahun.'/'.$bulan.'/0') }}">
                            <li id="laporanPage" class="navigation-list-item ">
                                <div class="row navigation-link">
                                    <div class="col-2">
                                        <i class="fas fa-clipboard"></i>
                                    </div>
                                    <div class="col-10">
                                        Laporan
                                    </div>
                                </div>
                            </li>
                        </a>
                    @endif

                    <!-- Admin---------------------------------------------------------------------------------------------------------- -->

                    @if (Auth::user()->userSobat->role == 1)
                        @php
                            $notifAdmin = DB::table('notifikasi_ipds')
                            ->leftjoin('bmn_keluhan','notifikasi_ipds.id_keluhan','=','bmn_keluhan.id_keluhan')
                            ->where('bmn_keluhan.is_show',1)
                            ->where('is_read', 0)
                            ->count();
                        @endphp

                        <a href="{{ route('admin/keluhan') }}">
                            <li id="adminPage" class="navigation-list-item">
                                <div class="row navigation-link">
                                    <div class="col-2">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="col-10">
                                        Admin
                                        @if ($notifAdmin>0)
                                            <span class="badge rounded-pill bg-danger float-right">{{ $notifAdmin }}</span>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        </a>

                        <a href="{{ url('admin/laporan/'.$tahun.'/'.$bulan.'/0') }}">
                            <li id="laporanPage" class="navigation-list-item ">
                                <div class="row navigation-link">
                                    <div class="col-2">
                                        <i class="fas fa-clipboard"></i>
                                    </div>
                                    <div class="col-10">
                                        Laporan
                                    </div>
                                </div>
                            </li>
                        </a>

                        <a href="{{ url('admin/tabulasi/'.$tahun.'/'.$bulan.'') }}">
                            <li id="tabulasiPage" class="navigation-list-item ">
                                <div class="row navigation-link">
                                    <div class="col-2">
                                        <i class="fas fa-table"></i>
                                    </div>
                                    <div class="col-10">
                                        Tabulasi
                                    </div>
                                </div>
                            </li>
                        </a>

                        <a href="{{ route('admin/master/pegawai') }}">
                            <li id="masterPage" class="navigation-list-item">
                                <div class="row navigation-link">
                                    <div class="col-2">
                                        <i class="fas fa-database"></i>
                                    </div>
                                    <div class="col-10">
                                        Master
                                    </div>
                                </div>
                            </li>
                        </a>
                    @endif
 
                </ul>

                <hr class="mx-3" style="color:rgb(255, 255, 255); margin-top:30px;">
            </div>
        </div>
        
        <div class="content">
            <div class="navigationBar sticky-top">
                <button id="sidebarToggle" class="btn sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>

                <ul class="navbar-nav ml-auto mr-3">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <div class="row pt-3">
                                <p class="teams-title text-right mr-2" style="font-size:90%;">
                                    <script>
                                        var d = new Date();
                                        var time = d.getHours();
            
                                        if (time < 3){
                                            document.write("Selamat Malam,");
                                        }
                                        else if (time < 12){
                                            document.write("Selamat Pagi,");
                                        }
                                        else if (time < 15){
                                            document.write("Selamat Siang,");
                                        }
                                        else if (time < 18){
                                            document.write("Selamat Sore,");
                                        }
                                        else document.write("Selamat Malam,");
                                    </script><br/>
                                    <b>{{ Auth::user()->pegawai->nama }}</b></br>
                                </p>
            
                                <img src="{{ asset('img/avatar.png') }}" alt="" width="40" height="40" class="rounded-circle mr-4" /> 
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#setting" data-toggle="modal" data-target="#setting">
                                Setting
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>

            <main class="p-4">
                @include('fragment.setting')
                @include('fragment.alert_msg')
                @yield('content')
            </main>
        </div>
        
    </div>

    <!-- Script -->
    <script src="{{ asset('js/sidebars1.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#datatable').DataTable({
                "pageLength": 50,
                "columnDefs": [
                    { "searchable": true, "targets": '_all'},
                    { "type": "num", "targets": 0},
                ],
            });
        });
    </script>
</body>
</html>