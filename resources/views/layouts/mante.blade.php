<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Links, meta, style -->
        @include('layouts.includes.heads')
        <!-- Icono y Titulo de la Pestaña -->
        <link rel="shortcut icon" href="{{asset('images/icons/ico.ico')}}">
    @yield('style')
    </head>

    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
        @include('layouts.includes.main_header')
        @include('layouts.includes.sidebar')
        <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> </h1>
                </section>
                <!-- Main content -->
                <section class="content container-fluid">
                    <div class="row">
                        @yield('content')
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->
            <!-- Main Footer -->
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0
                </div>
                <strong>Copyright &copy; 2017 <a href="http://ingenieria-soluciones.com">Ingeniería en Soluciones.</a></strong> All rights reserved.
            </footer>                                   
        </div>

        <!-- Scripts necessary -->
        @include('layouts.includes.scripts')
        @yield('script')
    </body>
</html>