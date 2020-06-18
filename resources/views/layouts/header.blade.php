<header class="header" style="background: #332d48;">
      <div class="sidebar-toggle-box">
          <div style="color:white;" class="fa fa-bars tooltips" data-placement="right" data-original-title="Panel de Navegación"></div>
      </div>
    <!--logo start-->
    <a href="/" style="color: ##BDBAB8;" class="logo"><b>INFO-SPORT</b></a>
    <!--logo end-->

    <div>
        <ul class="nav pull-right top-menu" style="border:white;" >
            <li >
                <a style="background: #221c35; border:white;" class="logout" href="{{ route('logout') }}" 
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" >
                    Cerrar Sesión
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </ul>
    </div>
</header>