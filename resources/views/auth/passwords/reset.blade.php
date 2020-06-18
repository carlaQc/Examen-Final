<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Info-Sport</title>

    <link rel="stylesheet" href="{!! asset('assets/login/vendors/mdi/css/materialdesignicons.min.css')!!}">
    <link rel="stylesheet" href="{!! asset('assets/login/vendors/base/vendor.bundle.base.css')!!}">
    <link rel="stylesheet" href="{!! asset('assets/login/css/vertical-layout-light/style.css')!!}">
    <link rel="stylesheet" href="{!! asset('assets/login/css/vertical-layout-light/content-log.css')!!}">
    <script src="https://kit.fontawesome.com/ee1b102e31.js" crossorigin="anonymous"></script>
  </head>

  <body>
    <div id="login-page">
        <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
              <div class="col-lg-6 d-flex align-items-center justify-content-center">
                <div class="auth-form-transparent text-left p-3">
                  <div class="brand-logo">
                    <img src="../../../../../profile/logo.png" alt="logo">
                  </div>

                  <h3>Restablecer Contraseña</h3>
                  <form class="pt-3" method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                      <label>Correo Electronico</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="fas fa-at text-primary"></i>
                          </span>
                        </div>
                        <input type="email" class="form-control form-control-lg border-left-0 {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <p style="color:red;">{{ $errors->first('email') }}</p>
                            </span>
                        @endif
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label> Nueva contraseña</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="fas fa-key text-primary"></i>
                          </span>
                        </div>
                        <input type="password" class="form-control form-control-lg border-left-0 {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña">
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <p style="color:red;">{{ $errors->first('password') }}</p>
                            </span>
                        @endif                        
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label>Confirmar nueva contraseña</label>
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <span class="input-group-text bg-transparent border-right-0">
                            <i class="fas fa-key text-primary"></i>
                          </span>
                        </div>
                        <input type="password" id="password-confirm" class="form-control form-control-lg border-left-0 {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="Confirmar contraseña" >                        
                      </div>
                    </div>
                    <div class="mb-4">
                      <div class="form-check">
                        <label class="form-check-label text-muted">
                        </label>
                      </div>
                    </div>
                      <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" style="background-color: #403969; border: 0px;">
                          Restablecer
                      </button>
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
    </div>
    
    <script src="{!! asset('assets/js/jquery.js')!!}"></script>
    <script src="{!! asset('assets/js/bootstrap.min.js')!!}"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="{!! asset('assets/js/jquery.backstretch.min.js')!!}"></script>


  </body>
</html>
