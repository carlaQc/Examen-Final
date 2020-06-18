@extends('layouts.app')
@section('content')
<section class="wrapper">
<h3><i class="fa fa-angle-right"></i> <strong>Administradores</strong> </h3>
<div style="margin-bottom: 10px;">
    <a href="{{ route('userAdmin.get') }}" style="color:gray; text-decoration: none;">
       Lista de Administradores
    </a> /
    <strong>Agregar nuevo administrador</strong>
</div><br>

<div class="row">
    <div class="col-lg-12">
        <div class="form-panel">
            <form data-parsley-validate class="form-horizontal style-form formi" action="{{ route('userAdmin.store')}}" method="POST">
            @csrf

                <div class="form-group">
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Nombre:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control " name="name" placeholder="Ingrese nombre" value="{{ old('name') }}">
                        @if($errors->has('name'))
                          <div id="tesdanger" class="text-danger">{{ $errors->first('name') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Apellido Paterno:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input class="form-control " type="text" name="paternal" placeholder="Ingrese apelido paterno" value="{{ old('paternal') }}">
                        @if($errors->has('paternal'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('paternal') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Apellido Materno:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input class="form-control"  type="text" name="maternal" placeholder="Ingrese apelido materno" value="{{ old('maternal') }}">
                        @if($errors->has('maternal'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('maternal') }}</div>
                        @endif
                    </div>
                </div>
                  
                <div class="form-group">
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Genero:</strong>
                    </label>
                    <div class="col-lg-3">
                        <select name="gender" class="form-control">
                            <option > Seleccione un genero </option>
                            <option value="1"> Hombre </option>
                            <option value="2"> Mujer </option>
                        </select>
                        @if($errors->has('gender'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('gender') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Email:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="email"  class="form-control" name="email" placeholder="Ingrese email" value="{{ old('email') }}">
                        @if($errors->has('email'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('email') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>CI:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text"  class="form-control" name="ci" placeholder="Ingrese CI" value="{{ old('ci') }}">
                        @if($errors->has('ci'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('ci') }}</div>
                        @endif
                    </div>
                </div>
                  

                <div class="form-group">
                    <label class="col-lg-1 control-label">
                        <h6><span class="req">*</span>
                        <strong>Dirección:</strong></h6>   
                    </label>
                    <div class="col-lg-3 ">
                        <input type="text"  class="form-control" name="address" placeholder="Zona/Calle/N°Puerta" value="{{ old('address') }}" >
                        @if($errors->has('address'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('address') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Telefono/ Celular:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="phone" placeholder="Ingrese telefono" value="{{ old('phone') }}">
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