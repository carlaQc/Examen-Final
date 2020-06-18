@extends('layouts.app')
@section('content')
<section class="wrapper">
<!--main content start-->
@include('layouts.newnotification')
    <h3><i class="fa fa-angle-right"></i> <strong>Campos Deportivos</strong> </h3>
    <div>
        Lista de campos
        <button style="margin-bottom: 20px;float: right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >
            <i class="fa fa-plus"></i> Nuevo Campo
        </button>
    </div><br>

    <div class="row">
        <div class="col-md-12">
            <div class="content-panel table-responsive formi">

                <table class="table table-striped table-advance table-hover">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripcion</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acciones</th>
                    <th class="text-center">Cambiar estado</th>
                  </tr>
                </thead>
                    <tbody>
                        @foreach($fields as $field)
                            <tr>
                                <td style="vertical-align: inherit;">{{ $field->name_field }}</td>
                                <td style="vertical-align: inherit;">{{ $field->price }}</td>
                                <td style="vertical-align: inherit;">{{ $field->description }}</td>
                                @if($field->field_state_id == 1)
                                    <td style="vertical-align: inherit;" class="text-center">
                                        <span class="label label-success label-mini text-center"> Habilitado </span>
                                    </td>
                                @endif
                                @if($field->field_state_id == 2)
                                    <td style="vertical-align: inherit;" class="text-center">
                                        <span class="label label-danger label-mini text-center"> Inhabilitado </span>
                                    </td>
                                @endif
                                @if($field->field_state_id == 3)
                                    <td style="vertical-align: inherit;" class="text-center">
                                        <span class="label label-warning label-mini text-center"> Limpieza </span>
                                    </td>
                                @endif
                                <td style="vertical-align: inherit;" class="text-center">
                                    <a id="edit" href="{{ route('field.edit',Crypt::encrypt($field->field_id)) }}">
                                        <button class="btn btn-primary btn-md">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <a id="edit" href="{{ route('fieldPhotos.get',Crypt::encrypt($field->field_id)) }}">
                                        <button class="btn btn-primary btn-md">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                </td>
                                <td style="vertical-align: inherit;" class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span>Estados</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ route('state.field',[$field->field_id, 1]) }}">Habilitado</a></li>
                                            <li><a href="{{ route('state.field',[$field->field_id, 2]) }}">Inhabilitado</a></li>
                                            <li><a href="{{ route('state.field',[$field->field_id, 3]) }}">Limpieza</a></li>
                                        </ul>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">{{ $fields->links() }}</div>
            </div>
        </div><!-- /col-md-12 -->
    </div><!-- row -->


{{-- Modal para crear una cancha --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Nuevo Campo</h4>
            </div>
            <form data-parsley-validate class="form-horizontal style-form formi" action="{{ route('field.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <span class="req">*</span>
                        <strong>Nombre:</strong>
                    </label>
                    <div class="col-lg-4">
                        <input type="text" class="form-control " name="name" placeholder="Ingrese nombre">
                    </div>
                    <label class="col-lg-2 control-label">
                        <span class="req">*</span>
                        <strong>Precio:</strong>
                    </label>
                    <div class="col-lg-4">
                        <input class="form-control " type="number" name="price" placeholder="ingrese precio">
                    </div>
                </div> 
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <span class="req">*</span>
                        <strong>Tipo de Actividad:</strong>
                    </label>
                    <div class="col-lg-10">
                        <select name="description" class="form-control">
                            <option > Seleccione una actividad </option>
                            <option value="Wally"> Wally </option>
                            <option value="Cancha Cesped"> Cancha Cesped </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-2 control-label">
                        <span class="req">*</span>
                        <strong>Imagen:</strong>
                    </label>
                    <div class="col-lg-10">
                        <input type="file" class="form-control " name="photo" placeholder="Ingrese nombre">
                    </div> <br>
                </div>            
              
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div> 
{{-- fin del modal --}}
</section>
@endsection
<style>
    #hiper{
        color : #18CADF;
    }
    #edit{
        color : #FFFFFF;
    }
</style>
