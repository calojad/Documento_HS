<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Links, meta, style -->
        @include('layouts.includes.heads')
        <!-- Icono y Titulo de la Pestaña -->
        <link rel="shortcut icon" href="{{asset('images/icons/ico.ico')}}">
@yield('style')
    </head>

    <body>
        <!-- Menu -->
        @include('layouts.includes.menu_superior')

        <!-- Contenido -->
        <div id="contenedor_inicial" class="container">
            @yield('content')
            <hr>
        </div>
        <footer class="footer">
            <div class="col-md-12" align="center">
                <p style="color: #00517e">Copyright &copy; 2017 <b><a href="http://ingenieria-soluciones.com">Ingeniería en soluciones</a></b> All rights reserved.</p>
            </div>
        </footer>

        <!-- Scripts necessary -->
        @include('layouts.includes.scripts')
        @yield('script')
    </body>
</html>