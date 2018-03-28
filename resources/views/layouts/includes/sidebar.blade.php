<aside class="main-sidebar">
    <section class="sidebar">
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">TABLAS</li>
            <li>
                <a href="{{URL::to('/mantenimiento/ambitos')}}">
                    <i class="fa fa-umbrella"></i> <span>Ambitos</span>
                </a>
            </li>
            {{--<li>
                <a href="{{URL::to('/mantenimiento/articulos')}}">
                    <i class="fa fa-list-ol"></i> <span>Articulos</span>
                </a>
            </li>--}}
            {{--<li>
                <a href="{{URL::to('/mantenimiento/empresas')}}">
                    <i class="fa fa-building"></i> <span>Empresas</span>
                </a>
            </li>--}}
            <li>
                <a href="{{URL::to('/mantenimiento/objetivos')}}">
                    <i class="fa fa-check-square-o"></i> <span>Objetivos</span>
                </a>
            </li>
            @if(Auth::user()->role == 1)
            <li>
                <a href="{{URL::to('/mantenimiento/plantillas')}}">
                    <i class="fa fa-file-word-o"></i> <span>Plantillas</span>
                </a>
            </li>
            @endif
            {{--<li>
                <a href="{{URL::to('/mantenimiento/parrafos')}}">
                    <i class="fa fa-indent"></i> <span>Parrafos</span>
                </a>
            </li>--}}
            <li>
                <a href="{{URL::to('/mantenimiento/politicas')}}">
                    <i class="fa fa-legal"></i> <span>Politicas</span>
                </a>
            </li>
            {{--<li>
                <a href="{{URL::to('/mantenimiento/representantes')}}">
                    <i class="fa fa-suitcase"></i> <span>Representantes</span>
                </a>
            </li>--}}
            <li>
                <a href="{{URL::to('/mantenimiento/riesgos')}}">
                    <i class="fa fa-warning"></i> <span>Riesgos</span>
                </a>
            </li>
            <li>
                <a href="{{URL::to('/mantenimiento/tiporiesgo')}}">
                    <i class="fa fa-list-ul"></i> <span>Tipo de Riesgos</span>
                </a>
            </li>
            @if(Auth::user()->role == 1)
            <li>
                <a href="{{URL::to('/mantenimiento/usuarios')}}">
                    <i class="fa fa-users"></i> <span>Usuarios</span>
                </a>
            </li>
            @endif
        </ul>
    </section>
</aside>