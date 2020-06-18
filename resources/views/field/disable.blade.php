@extends('layouts.app')
@section('content')
<section class="wrapper">
<!--main content start-->
<h3 style="margin-left: 20px;"><i class="fa fa-angle-right"></i> <strong>Gestion de Empleados -</strong> Centro Deportivo</h3>
<div class="col-md-12">
    <div class="content-panel table-responsive">
        <table class="table table-striped table-advance table-hover" >
        <h4 style="float:left;"><i class="fa fa-angle-right"></i> Lista de Usuarios</h4>
        <a style="text-decoration:none;float:right;margin-right: 20px;" href="{{ route('employee.create') }}">
            <button type="button" class="btn btn-primary">
                Agregar Nuevo Empleado
            </button> 
        </a>     
        <hr>
            <thead>
                <tr>
                    <th><i class="fa fa-user"></i> Nombre</th>
                    <th><i class="fa fa-envelope"></i> Email</th>
                    <th class="text-center"><i class="fa fa-phone"></i> Celular</th>
                    <th class="text-center"><i class="fa fa-box"></i> Carnet de Identidad</th>
                    <th class="text-center"><i class="fa fa-edit"></i> Estado</th>
                    <th class="text-center"><i class="fa fa-cog"></i> Acciones</th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }} {{ $user->paternal }} {{ $user->maternal }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center">{{ $user->phone }}</td>
                    <td class="text-center">{{ $user->ci }}</td>
                    @if($user->state == 1)
                        <td class="text-center">
                            <span class="label label-success label-mini text-center"> Activo </span>
                        </td>
                    @else
                        <td class="text-center">
                            <span class="label label-danger label-mini text-center"> Inactivo </span>
                        </td>
                    @endif
                    <td class="text-center">
                        <button class="btn btn-primary btn-xs"><a id="edit" href="{{ route('employee.edit',Crypt::encrypt($user->id)) }}"><i class="fa fa-pencil"></a></i></button>
                        <button class="btn {{ $user->state?'btn-danger':'btn-success' }} delete-modal btn-xs" data-id="{{ $user->id }}"
                            data-state="{{ $user->state }}">
                            <i class="fa fa-star"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div><!-- /content-panel -->
</div><!-- /col-md-12 --> 
<!-- /MAIN CONTENT -->
{{-- Modal  --}}

<div class="modal" id="modal-delete" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-body text-center">
                <h3 id="titulo-modal"></h3>
            </div>
            <form action="" method="post" id="form-delete">
                   @csrf
                   @method('put')
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" id="boton-desactivar">Aceptar</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                </div>
             </form>
        </div>
    </div>
</div>
</section>
@endsection
@section('script')
<script>
    $('.delete-modal').click(function() {
        var estado = $(this).data('state');
        let action;
        if(estado == 1){
          action = "{{ url('Empleado/Desactivar') }}/" + $(this).data('id');
          $('#titulo-modal').text('¿Esta seguro de desactivar este registro?');
          $('#boton-desactivar').val('Desactivar');
          $('#boton-desactivar').attr('class','btn btn-danger');
          console.log('desactivar');
        }else{
          action = "{{ url('Empleado/Activar') }}/" + $(this).data('id');
          $('#titulo-modal').text('¿Esta seguro de activar este registro?');
          console.log('activar');
          $('#boton-desactivar').val('Activar');
          $('#boton-desactivar').attr('class','btn btn-success');
        }
        $("#form-delete").attr("action", action);
        $('#modal-delete').modal('show');
    });
    // alert('hola');
</script>
@endsection
<style>
    #edit{
        color : #FFFFFF;
    }
</style>