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

    <body>
        <!-- Menu -->
        @include('layouts.includes.menu_superior')
        <!-- Contenido -->
        <div class="container">
        @yield('content')
            <hr>
            <div class="row col-md-12" align="center">
                <p style="color: #00517e">&copy; 2017 - <b>Andres Loja - CAL</b> &andand;</p>
            </div>
        </div>
        <!-- Scripts necessary -->
        @include('layouts.includes.scripts')
        @yield('script')
    </body>
</html>