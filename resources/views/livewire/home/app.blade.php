<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- AdminLTE CSS -->
    <link href="{{ asset('css/adminlte.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <style>
        .daftar_kegitan {
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            justify-content: center;
        }

        .card {
            width: 400px;
            border: 1px solid #ddd;
            overflow: hidden;
        }

        .card-img-top {
            width: 100%;
            height: 400px;
            object-fit: contain; /* Gambar proporsional sesuai orientasi */
            background: linear-gradient(6deg, rgb(85, 150, 203) 0%, rgb(190, 208, 245) 48%);
        }

        .card-body {
            text-align: left;
        }

        .card-text img {
            width: 18px;
            vertical-align: middle;
            margin: 0px !important;
            padding: 0px !important;
        }

        .btn-primary {
            margin-top: 10px;
        }

        

    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Header -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Dashboard</a>
                </li>
            </ul>
        </nav>
        <!-- Content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Main content -->
            <section class="content">
                @yield('content')
            </section>
        </div>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('/home') }}" class="brand-link">
                <img src="{{ asset('img/logo_kemdikbud.png') }}" alt="Brand Logo"
                    class="brand-image img-circle elevation-3"
                    style="opacity: 1; width: 35px; height: 35px; object-fit: cover;">
                <span class="brand-text font-weight-light">My Application</span>
            </a>


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- User Info -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('img/user.jpg') }}" class="img-circle elevation-2" alt="User Image"
                            style="width: 35px; height: 35px; object-fit: cover;">
                    </div>
                    <div class="info">
                        <a href="/home/profile" class="d-block">John Doe</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Menu 1 -->
                        <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                            <a href="/home" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Beranda</p>
                            </a>
                        </li>
                        <!-- Menu 3 -->
                        <li class="nav-item {{ Request::path() == 'home/kegiatan' ? 'active' : '' }}">
                            <a href="/home/kegiatan" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Kegiatan</p>
                            </a>
                        </li>
                        <!-- Menu 2 -->
                        <li class="nav-item">
                            <a href="/home/profile" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <!-- Menu 3 -->
                        <li class="nav-item">
                            <a href="/home/reports" class="nav-link">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>Reports</p>
                            </a>
                        </li>
                        <!-- Menu 4 -->
                        <li class="nav-item">
                            <a href="/home/settings" class="nav-link">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                        <!-- Menu 5 -->
                        <li class="nav-item">
                            <a href="/home/help" class="nav-link">
                                <i class="nav-icon fas fa-question-circle"></i>
                                <p>Help</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>



        <!-- Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; {{ date('Y') }} <a href="#">Your Company</a>.</strong>
        </footer>

        <!-- Scripts -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/adminlte.min.js') }}"></script>
        <script>
            const BASE_URL = "{{ url('/') }}";
            const BASE_STORAGE_URL = "{{ asset('storage') }}";
        </script>
        <script src="{{ asset('js/script.js')}}"></script>
    </div>
</body>

</html>
