<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-left" href="{{ url('/') }}"><img src="{{asset('images/logo/Ingenieria_Soluciones-Loga.png')}}" width="55"></a>
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse" style="color: white;">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}"><i class="fa fa-sign-in"></i> Iniciar Sesión</a></li>
                    <li><a href="{{ route('register') }}">Registrarse</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            <samp class="glyphicon glyphicon-user" style="margin: 0 5px;"></samp>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ URL::to('/home') }}"><i class="fa fa-file"></i> Documento</a>
                            </li>
                            <li>
                                <a href="{{ URL::to('/documento/exportarmatriz') }}"><i class="fa fa-clipboard"></i> Exportar Matriz</a>
                            </li>
                            <li>
                                <a href="{{ URL::to('/mantenimiento/ambitos') }}"><i class="fa fa-wrench"></i> Mantenimientos</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="fa fa-sign-out"></i> Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>