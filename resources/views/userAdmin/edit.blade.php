@extends('layouts.app')
@section('content')
<section class="wrapper">
<h3><i class="fa fa-angle-right"></i> <strong>Administradores</strong> </h3>
<div style="margin-bottom: 10px;">
    <a href="{{ route('userAdmin.get') }}" style="color:gray; text-decoration: none;">
       Lista de Administradores
    </a> /
    <strong>Actualizar datos de administrador</strong>
</div><br>

<div class="row">
    <div class="col-lg-12">
        <div class="form-panel">
            <form data-parsley-validate class="form-horizontal style-form formi" action="{{ route('userAdmin.update',Crypt::encrypt($user->id)) }}" method="POST">
            @csrf
            @method('PUT')

                <div class="form-group">
                    <label class="col-lg-1 control-label">
                        <strong>Nombre:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control " name="name" value="{{ $user->name }}" placeholder="Ingrese nombre" value="{{ old('name') }}">
                        @if($errors->has('name'))
                          <div id="tesdanger" class="text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <strong>Apellido Paterno:</strong>
                    </label>
                    <div class="col-lg-3 ">
                        <input class="form-control " type="text" name="paternal" value="{{ $user->paternal }}" placeholder="Ingrese apelido paterno" value="{{ old('paternal') }}">
                        @if($errors->has('paternal'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('paternal') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <strong>Apellido Materno:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input class="form-control"  type="text" name="maternal" value="{{ $user->maternal }}" placeholder="Ingrese apelido materno" value="{{ old('maternal') }}">
                        @if($errors->has('maternal'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('maternal') }}</div>
                        @endif
                    </div>
                </div>
                  
                <div class="form-group">
                    <label class="col-lg-1 control-label">
                        <strong>Genero:</strong>
                    </label>
                    <div class="col-lg-3">
                        <select name="gender" class="form-control" disabled>
                            @if($user->gender == 1)
                                <option value="1"> Hombre </option>
                            @else
                                <option value="2"> Mujer </option>
                            @endif
                        </select>
                        @if($errors->has('gender'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('gender') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <strong>Email:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="email"  class="form-control" name="email" value="{{ $user->email }}" placeholder="Ingrese email" value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <strong>CI:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text"  class="form-control" name="ci" value="{{ $user->ci }}" placeholder="Ingrese CI" value="{{ old('ci') }}">
                        @if($errors->has('ci'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('ci') }}</div>
                        @endif
                    </div>
                </div>
                  

                <div class="form-group">
                    <label class="col-lg-1 control-label">
                        <strong>Dirección:</strong></h6>   
                    </label>
                    <div class="col-lg-3">
                        <input type="text"  class="form-control" name="address" value="{{ $user->address }}" placeholder="Zona/Calle/N°Puerta" value="{{ old('address') }}" >
                        @if($errors->has('address'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('address') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <strong>Telefono/ Celular:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="phone" value="{{ $user->phone }}" placeholder="Ingrese telefono" value="{{ old('phone') }}">
                        @if($errors->has('phone'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('phone') }}</div>
                        @endif
                    </div>
                </div>
              
              
                <div class="form">
                  <div class="col-lg-offset-10">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a style="color:black;" href="{{ route('userAdmin.get') }}">
                        <button type="button" class="btn btn-default">
                            Cancelar
                        </button>
                    </a>
                  </div>
                </div>

            </form>
        </div>
    </div>
</div>
</section>
@endsection