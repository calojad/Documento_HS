<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Links, meta, style -->
        @include('layouts.includes.heads')
        <!-- Icono y Titulo de la Pestaña -->
        <link rel="shortcut icon" href="{{asset('images/icons/ico.ico')}}">
        <title>Higiene y Seguridad</title>
    @yield('style')
    </head>

    <body class="skin-blue wysihtml5-supported">
        <div class="wraper">
        @include('layouts.includes.menu_superior')
        @include('layouts.includes.sidebar')
        <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content" class="sidebar-toggle" >
                    <div class="col-md-12" >
                        @yield('content')
                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->

            <footer class="main-footer">
                <div class="col-md-12" align="center">
                    <p style="color: #00517e">&copy; 2017 - <b>Andres Loja - CAL</b> &andand;</p>
                </div>
            </footer>
        </div>

        <!-- Scripts necessary -->
        @include('layouts.includes.scripts')
        @yield('script')
    </body>
</html>