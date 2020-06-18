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
              <h3>Registrate</h3>
              <form class="pt-3" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                  <label>Nombre</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-user text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0 {{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nombre" name="name" value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <p style="color:red;">{{ $errors->first('name') }}</p>
                        </span>
                    @endif
                  </div>
                </div>

                
                <div class="form-group">
                  <label>Correo Electronico</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-at text-primary"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control form-control-lg border-left-0 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <p style="color:red;">{{ $errors->first('email') }}</p>
                        </span>
                    @endif
                  </div>
                </div>
                
                <div class="form-group">
                  <label>Contraseña</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-key text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0 {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old('email') }}" placeholder="Contraseña" onclick="clean()">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <p style="color:red;">{{ $errors->first('password') }}</p>
                        </span>
                    @endif                        
                  </div>
                </div>
                
                <div class="form-group">
                  <label>Confirmar contraseña</label>
                  <div class="input-group">
                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="fas fa-key text-primary"></i>
                      </span>
                    </div>
                    <input type="password" class="form-control form-control-lg border-left-0" name="password_confirmation" value="{{ old('password') }}" placeholder="Confirmar contraseña" >                        
                  </div>
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                    </label>
                  </div>
                </div>
                  <button name="btn-reg" type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" style="background-color: #403969; border: 0px;">
                      Crear Cuenta
                  </button>
                <div class="text-center mt-4 font-weight-light">
                  Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-primary">Inicia Sesión</a>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-6 register-half-bg d-flex flex-row">
            {{-- <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; 2018  All rights reserved.</p> --}}
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
    </div>
@endsection
