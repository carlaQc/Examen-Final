@extends('layouts.principal')

@section('principal')

<form class="form-login">
    @csrf
    <h2 class="form-login-heading">Verifique su dirección de correo electrónico</h2>
    <div class="login-wrap">
        <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="E-Mail" autofocus>
            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        <br>
        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                </div>
            @endif

            {{ __('Antes de continuar, revise su correo electrónico para obtener un enlace de verificación.') }}
            {{ __('Si no recibiste el correo electrónico') }}, <a href="{{ route('verification.resend') }}">{{ __('haga clic aquí para solicitar otro') }}</a>.
        </div>

    </div>
</form>
@endsection