@extends('layouts.app')
@section('content')
<section class="wrapper">
<h3><i class="fa fa-angle-right"></i> <strong>Centro Deportivo</strong> </h3>
<div style="margin-bottom: 10px;">
    Centros Deportivos /
       Lista de Administradores /
    <strong>Agregar nuevo Centro Deportivo </strong>
</div><br>

<div class="row">
    <div class="col-lg-12">
        <div class="form-panel">
            <form data-parsley-validate class="form-horizontal style-form formi" action="{{ route('centerUser.store') }}" method="POST">
            @csrf
                <div class="form-group">

                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Centro Deportivo:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control " name="name_center" placeholder="Ingrese nombre del Centro Deportivo" value="{{ old('name_center') }}">
                            @if($errors->has('name_center'))
                              <div id="tesdanger" class="text-danger">{{ $errors->first('name_center') }}</div>
                            @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Nit:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input class="form-control " type="text" name="nit" placeholder="Ingrese NIT" value="{{ old('nit') }}">
                        @if($errors->has('nit'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('nit') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <h6><span class="req">*</span>
                        <strong>Dirección:</strong></h6>
                    </label>
                    <div class="col-lg-3">
                        <input class="form-control"  type="text" name="address_center" placeholder="Ingrese Dirección" value="{{ old('address_center') }}">
                        @if($errors->has('address_center'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('address_center') }}</div>
                        @endif
                    </div>
                </div>
                  
                <div class="form-group">
                    <label class="col-lg-1 control-label">
                        <h6><span class="req">*</span>
                        <strong>Actividad:</strong></h6>
                    </label>
                    <div class="col-lg-3">
                        <input type="text"  class="form-control" name="activity" placeholder="Ingrese Actividad" value="{{ old('activity') }}">
                        @if($errors->has('activity'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('activity') }}</div>
                        @endif
                    </div>
                    <label class="col-lg-1 control-label">
                        <span class="req">*</span>
                        <strong>Telefono/ Celular:</strong>
                    </label>
                    <div class="col-lg-3">
                        <input type="text" class="form-control" name="cellphone" placeholder="Ingrese telefono" value="{{ old('cellphone') }}">
                        @if($errors->has('cellphone'))
                            <div id="tesdanger" class="text-danger">{{ $errors->first('cellphone') }}</div>
                        @endif
                    </div>
                </div>
                <div class="form">
                  <div class="col-lg-offset-10">
                    <button id="saveCenter" type="submit" class="btn btn-primary">Siguiente</button>
                    <a style="color:black;" href="{{ route('user.get') }}">
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