<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Info-Sport</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,700,900|Roboto+Mono:300,400,500"> 
    


    <link rel="stylesheet" href="{!! asset('assets/login/vendors/mdi/css/materialdesignicons.min.css')!!}">
    <link rel="stylesheet" href="{!! asset('assets/login/vendors/base/vendor.bundle.base.css')!!}">
    <link rel="stylesheet" href="{!! asset('assets/login/css/vertical-layout-light/style.css')!!}">
    <link rel="stylesheet" href="{!! asset('assets/login/css/vertical-layout-light/content-log.css')!!}">
    <script src="https://kit.fontawesome.com/ee1b102e31.js" crossorigin="anonymous"></script>
  </head>
  <body id="bo">
    
    <nav id="nav" class="navbar navbar-dark bg-dark">
      <a class="navbar-brand text-white h2 mb-0"><strong>Info-Sport<span class="text-danger">.</span></a>
      <form class="form-inline">
        @if (Route::has('login'))
          @auth
          <button type="button" href="{{ route('login') }}" class="btn btn-facebook auth-form-btn flex-grow mr-2">
            <a href="{{ url('/home') }}">Principal</a>
          </button>
          @else
          <button id="btn-log" type="button" class="btn btn-facebook flex-grow mr-2" onclick="login()">
              Iniciar Sesión
          </button> 

              @if (Route::has('register'))
                <button id="btn-reg" type="button" class="btn btn-facebook flex-grow mr-2" onclick="register()">
                    Registro
                </button>
              @endif
          @endauth
        @endif
      </form>
    </nav>
    <div class="content">
      <div class="row">
        <div id="imgs" class="col-lg-6">
          <div class="image">
            <!-- <div class="back bot">&#60</div>
            <div class="next bot">&#62</div> -->
            <img src="../../../../../profile/foto1.jpg" alt="" id="foto">
            <button id="btn-change" onclick="back()" class="btn btn-primary btn-sm back"><i class="fas fa-angle-left"></i></button>
            <button id="btn-change" onclick="next()" class="btn btn-primary btn-sm next"><i class="fas fa-angle-right"></i></button>
          </div>
            
        </div>
        <div id="text" class="col-lg-6">
          <div class="col-lg-8">
            <div class="col-lg-6 well">
              <h1>Bienvenido a Info-Sport!</h1><br>
            </div>
            <div class="mesage">
              <h2 class="font-weight-light">Te permitimos observar la información de tus areas deportivas preferidas y tener acceso a realizar tus reservas desde donde te encuentres y a cualquier hora!</h2><br>
            </div>
          </div>
        </div>

      </div>
    </div>
    
          <!-- content-wrapper ends -->
    <script src="{!! asset('assets/login/vendors/base/vendor.bundle.base.js')!!}"></script>
    <script src="{!! asset('assets/login/js/off-canvas.js')!!}"></script>
    <script src="{!! asset('assets/login/js/hoverable-collapse.js')!!}"></script>
    <script src="{!! asset('assets/login/js/template.js')!!}"></script>
    <script src="{!! asset('assets/login/js/settings.js')!!}"></script>
    <script src="{!! asset('assets/login/js/todolist.js')!!}"></script>

    </body>
</html>
<script type="text/javascript">
  function login(){
    document.location.href="{{ route('login') }}";
  }
  function register(){
    document.location.href="{{ route('register') }}";
  }
  
  var images = ['../../../../../profile/foto1.jpg','../../../../../profile/foto3.jpg','../../../../../profile/foto2.jpg'];
  var cont = 0;
  function next(){
    var elemento = document.getElementById("foto");
    // elemento.src=images[cont];
    // cont++;
    if(cont < images.length - 1){
      elemento.src = images[cont +1];
      cont++;
     }else{
       elemento.src = images[0];
       cont = 0;
     }
  }
  function back(){
    var elemento = document.getElementById("foto");
    if(cont > 0){
       elemento.src = images[cont -1];
       cont--;
     }else{
       elemento.src = images[images.length - 1];
       cont = images.length - 1;
     }
  }


</script>