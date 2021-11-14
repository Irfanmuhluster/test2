<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">


    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('default') }}/css/fontawesome/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('default') }}/css/bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ asset('default') }}/css/adminlte.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    {{-- @stack('style') --}}
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->
                <div id="user" class="d-flex align-items-center">
                    <div class="position-relative">
                        <div id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                            class="dropdown-toggle has-dropdown">
                            <span>User Saja</span>
                            <span>
                                
                            </span>
                        </div>
                    </div>
                </div>
            </ul>
        </nav>

        {{-- sidebar --}}
        <aside class="main-sidebar elevation-4" style="background-color: #424850; color: white;">
            <x-sidebar />
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Main content -->
            <div class="content">
                @yield('content')
                <!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    </div>
    @stack('js')
    <script src="{{ asset('default') }}/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('default') }}/js/adminlte.js"></script>
</body>

</html>
