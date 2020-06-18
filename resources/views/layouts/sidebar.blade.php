<aside>
    <div id="sidebar"  class="nav-collapse" style="background: #3d3850; width:230px;">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
        
            <p class="centered"><a href="profile.html"><img src="../../../../../profile/{{ Auth::user()->photo }}" class="img-circle" width="60"></a></p>
            <h5 class="centered">{{ Auth::user()->name }} {{ Auth::user()->paternal }}</h5>
            @if (Auth::user()->rol_id == 1)
                <h6 class="centered" style="color:white;">Super Admin</h6>
            @endif
            @if (Auth::user()->rol_id == 2)
                <h6 class="centered" style="color:white;">Administrador</h6>
            @endif
            @if (Auth::user()->rol_id == 3)
                <h6 class="centered" style="color:white;">Empleado</h6>
            @endif
            @if (Auth::user()->rol_id == 4)
                <h6 class="centered" style="color:white;">Usuario</h6>
            @endif
            <li class="mt">
                <a href="{{ route('profile.get') }}">
                    <i class="fa fa-user"></i>
                    <span>Perfil</span>
                </a>
            </li>
            <!-- botones de navegacion SUPER ADMIN -->
            
            @if (Auth::user()->rol_id == 1)
                <li class="sub-menu">
                    <a href="{{ route('userAdmin.get') }}" style="cursor: pointer">
                        <i class="fa fa-user"></i>
                        <span> Gestionar Administradores</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-users"></i>
                        <span>Gestionar Centros Deportivos</span>
                    </a>
                    <ul class="sub">
                        <li><a id="center"  href="{{ route('user.get') }}"> Administradores</a></li>
                        <li><a  href="{{ route('centers.get') }}"> Centros Deportivos</a></li>
                    </ul>
                </li>
                
            @endif
            
            <!-- botones de navegacion ADMINISTRADORES DE CENTROS -->
            @if (Auth::user()->rol_id == 2)
                <li>
                    <a href="{{ route('dashboard') }}">
                        <i class="fa fa-dashboard"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('center.get') }}">
                        <i class="fa fa-home"></i>
                        <span>Centro Deportivo</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{ route('employee.get') }}">
                        <i class="fa fa-users"></i>
                        <span> Gestionar Empleados</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{ route('field.get') }}" style="cursor: pointer">
                        <i class="fa fa-tag"></i>
                        <span> Administrar Canchas</span>
                    </a>
                </li>
                
                <li>
                    <a id="reser" href="{{ route('scheduleReserveAdmin.get',Crypt::encrypt(Auth::user()->center_id)) }}">
                        <i class="fa fa-calendar"></i>
                        <span>Reservas</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{ route('promotion.get') }}" style="cursor: pointer">
                        <i class="fa fa-ticket"></i>
                        <span>Gestionar de Promociones</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{ route('report.get') }}" style="cursor: pointer">
                        <i class="fa fa-file"></i>
                        <span>Reportes</span>
                    </a>
                </li>
            @endif

            <!-- botones de navegacion EMPLEADOS -->
            @if (Auth::user()->rol_id == 3)
                <li>
                    <a href="{{ route('scheduleReserveAdmin.get',Crypt::encrypt(Auth::user()->center_id)) }}">
                        <i class="fa fa-calendar"></i>
                        <span>Reservas</span>
                    </a>
                </li>
            @endif

            <!-- botones clientes -->
            @if (Auth::user()->rol_id == 4)
                <li class="sub-menu">
                    <a href="{{ route('home') }}" style="cursor: pointer">
                        <i class="fa fa-user"></i>
                        <span>Ver Promociones</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="{{ route('center.profile',Crypt::encrypt(Auth::user()->center_id)) }}" style="cursor: pointer">
                        <i class="fa fa-user"></i>
                        <span>Centros Deportivos cliente</span>
                    </a>
                </li>
                
                
            @endif

        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>
