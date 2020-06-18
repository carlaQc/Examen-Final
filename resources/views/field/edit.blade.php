@extends('layouts.app')
@section('content')
<section class="wrapper">
<h3><i class="fa fa-angle-right"></i> <strong>Campo Deportivo</strong> </h3>
<div style="margin-bottom: 10px;">
    <a href="{{ route('field.get') }}" style="color:gray; text-decoration: none;">
       Lista de Campos Deportivos
    </a> /
    <strong>Actulizar campo deportivo</strong>
</div><br>

<div class="row">
    <div class="col-lg-12">
        <div class="form-panel">
            <form data-parsley-validate class="form-horizontal style-form formi" action="{{ route('field.update',Crypt::encrypt($field->field_id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <span class="req">*</span>
                        <strong>Nombre:</strong>
                    </label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control " name="name" value="{{ $field->name_field }}" placeholder="Ingrese nombre">
                    </div>
                    <label class="col-lg-2 control-label">
                        <span class="req">*</span>
                        <strong>Precio:</strong>
                    </label>
                    <div class="col-lg-4">
                        <input class="form-control " type="number" name="price" value="{{ $field->price }}" placeholder="ingrese precio">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <span class="req">*</span>
                        <strong>Tipo de Actividad:</strong>
                    </label>
                    <div class="col-lg-4">
                        <select name="description" class="form-control">
                            <option > Seleccione una actividad </option>
                            <option value="Wally"> Wally </option>
                            <option value="Cancha Cesped"> Cancha Cesped </option>
                        </select>
                    </div>
                    <label class="col-lg-2 control-label">
                        <span class="req">*</span>
                        <strong>Imagen:</strong>
                    </label>
                    <div class="col-lg-4">
                        <input type="file" class="form-control " name="photo" placeholder="Ingrese nombre">
                    </div>
                </div>
              
                <div class="form">
                  <div class="col-lg-offset-10">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a style="color:black;" href="{{ route('field.get') }}">
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