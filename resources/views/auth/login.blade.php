@extends('layouts.principal')

@section('principal')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
        <div class="row flex-grow">
          <div class="col-lg-6 d-flex align-items-center justify-content-center">
            <div class="auth-form-transparent text-left p-3">
              <div class="brand-logo">
                <img src="../../../../../profile/logo.png" alt="logo">
              </div>
              <h3>Iniciar Sesión</h3>
              <form class="pt-3">
                @csrf

                <div class="form-group">
                  <label for="exampleInputEmail">correo electronico</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-user text-primary"></i>
                      </span>
                    </div>
                    <input type="email" class="form-control form-control-lg border-left-0 {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" placeholder="email">
                  </div>
                  <p id="email_val" style="color:red; margin-top: 5px;"></p>
                </div>

                <div class="form-group">
                  <label for="exampleInputPassword">Contraseña</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-key text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0 {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="contraseña" onclick="clean()">
                  </div>
                  <p id="password_val" style="color:red; margin-top: 5px;"></p>
                </div>
               
                {{-- <p style="color:red;" id="password_val"></p> --}}
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check"></div>
                  <a data-toggle="modal" href="#myModal" class="auth-link text-black">Olvidaste tu contraseña?</a>
                </div><br>
                <div class="col-lg-13 d-flex">
                  <button id="login" type="button" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" style="background-color: #403969; border: 0px;">
                      Iniciar Sesión  <span id="load"></span>
                  </button> 
                </div>
                <br>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div id="res"></div>
                <div class="text-center mt-4 font-weight-light">
                  ¿Aun no tienes una cuenta? <a  href="{{ route('register') }}" class="text-primary">Registrate</a>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 login-half-bg d-flex flex-row">
            {{-- <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018  All rights reserved.</p> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
    {{-- modal para restaurar contraseña  --}}
    @include('auth.passwords.email')

    {{-- modal para registrar nuevo usuario  --}}
    {{--     @include('auth.register') --}}

    <script>
        let ld = 'spinner-border spinner-border-sm';

        $("#email").keypress(function(e) {
            if(e.which == 13) {
                login();
            }
        });

        $("#password").keypress(function(e) {
            if(e.which == 13) {
                login();
            }
        });

        $('#login').click(function(){
            login();
        });

        function login(){
            let email = $('#email').val();
            let password = $('#password').val();

            var reg = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
            //Validación del campo de correo electronico
            if(email == ""){ //validacion de campo vacio
                $('#email_val').html("Campo obligatorio.");
                $('#res').html("");        
            }else if(!reg.test(email.trim())){ //Validacion de campo email(Con formato)
                $('#email_val').html("Correo electrónico inválido.");
                $('#res').html("");
            }else{
                $('#email_val').html("");
            }
            //Validación del campo Contraseña
            if(password == ""){ //validacion de campo vacio
                $('#password_val').html("Campo obligatorio.");
                $('#res').html("");
            }else if(password.length < 7){ //Validacion de tamaño de contraseña
                $('#password_val').html("La contraseña debe tener al menos 7 caracteres.");
                $('#res').html("");
            }else{
                $('#password_val').html("");
            }
            //Autentificacióm
            if(reg.test(email.trim()) && password.length > 6){//Varificación de email y contraseña de acuerdo a la validación
                $('#load').addClass(ld);
                $('#login').css({'background-color':'#5e558e'});
                $('#res').html("");
                $.ajax({
                    url:     "{{ route('login_attemps') }}",
                    headers: {'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                    method:  "POST",
                    data:{
                        email:email,
                        password:password
                    },
                    success:function(data){
                        console.log(data);
                        if(data.state == "email"){
                            $('#res').html(`<div class="alert alert-danger" style="border-color: #da8781;">${data.msg}</div>`);
                            $('#load').removeClass(ld);
                        }else if(data.state == "password"){
                            $('#res').html(`<div class="alert alert-danger" style="border-color: #da8781;">${data.msg}</div>`);
                            $('#load').removeClass(ld);
                        }else{
                            location.href = "{{ route('home') }}";
                        }
                        $('#login').css({'background-color':'#403969'});
                    }
                });
            }
        }
    </script>

@endsection