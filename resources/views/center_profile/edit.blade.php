
@extends('layouts.app')
@section('content')
<section class="wrapper">
<h3><i class="fa fa-angle-right"></i> <strong>Perfil Centro Deportivo</strong> </h3>
<div style="margin-bottom: 10px;">
    <a href="{{ route('center.get') }}" style="color:gray; text-decoration: none;">
       Perfil
    </a> /
    <strong>Actualizar datos</strong>
</div><br>

<div class="row">
    <div class="col-lg-12">
        <div class="form-panel">
            <form data-parsley-validate class="form-horizontal style-form formi" action="{{ route('center.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

                <div class="form-group">
                    <label class="col-lg-1 control-label">
                        <strong>Nombre:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control " name="name_center" value="{{ $center->name_center }}" placeholder="Ingrese nombre" value="{{ old('name_center') }}">
                        @if($errors->has('name_center'))
                          <div id="tesdanger" class="text-danger">{{ $errors->first('name_center') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <strong>Nit:</strong>
                    </label>
                    <div class="col-lg-3 ">
                        <input class="form-control " type="text" name="nit" value="{{ $center->nit }}" placeholder="Ingrese apelido paterno" value="{{ old('nit') }}">
                        @if($errors->has('nit'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('nit') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <strong>Direccion:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input class="form-control"  type="text" name="address" value="{{ $center->address }}" placeholder="Ingrese dirección materno" value="{{ old('address') }}">
                        @if($errors->has('address'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('address') }}</div>
                        @endif
                    </div>
                </div>
                  
                <div class="form-group">

                    <label class="col-lg-1 control-label">
                        <strong>Telefono / Celular:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text"  class="form-control" name="cellphone" value="{{ $center->cellphone }}" placeholder="Ingrese número de celular" value="{{ old('cellphone') }}">
                        @if($errors->has('cellphone'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('cellphone') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <strong>Actividad:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text"  class="form-control" name="activity" value="{{ $center->activity}}" placeholder="Ingrese actividad" value="{{ old('activity') }}">
                        @if($errors->has('activity'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('activity') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <strong>Foto de perfil del centro:</strong></h6>   
                    </label>
                    <div class="col-lg-3">
                        <input type="file"  class="form-control" name="photo" value="{{ $center->photo }}" placeholder="Zona/Calle/N°Puerta" value="{{ old('photo') }}" >
                        @if($errors->has('photo'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('photo') }}</div>
                        @endif
                    </div>
                </div>
                  
              
              
                <div class="form">
                  <div class="col-lg-offset-10">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a style="color:black;" href="{{ route('center.get') }}">
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



</section>
@endsection