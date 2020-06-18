@extends('layouts.app')
@section('content')
<!--main content start-->
<section class="wrapper">
@include('layouts.newnotification')

    <h3><i class="fa fa-angle-right"></i> <strong>Administradores</strong> </h3>
    <div>
        Lista de Administradores  

        <a style="margin-bottom: 20px;float: right;" href="{{ route('userAdmin.create') }}">
            <button type="button" class="btn btn-primary">
                <i class="fa fa-plus"></i> Nuevo Administrador
            </button> 
        </a> 

    </div><br>

    <div class="row">
        <div class="col-md-12">
            <div class="content-panel table-responsive formi">

                <table class="table table-striped table-advance table-hover">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Paterno</th>
                    <th>Materno</th>
                    <th class="text-left">Email</th>
                    <th class="text-left">Celular</th>
                    <th class="text-left">CI</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acciones</th>
                  </tr>
                </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td style="vertical-align: inherit;">{{ $user->name }}</td>
                                <td style="vertical-align: inherit;">{{ $user->paternal }}</td>
                                <td style="vertical-align: inherit;">{{ $user->maternal }}</td>
                                <td style="vertical-align: inherit;">{{ $user->email }}</td>
                                <td style="vertical-align: inherit;" class="text-left">{{ $user->phone }}</td>
                                <td style="vertical-align: inherit;" class="text-left">{{ $user->ci }}</td>
                                @if($user->state == 1)
                                    <td style="vertical-align: inherit;" class="text-center">
                                        <span class="label label-success label-mini text-center"> Activo </span>
                                    </td>
                                @else
                                    <td style="vertical-align: inherit;" class="text-center">
                                        <span class="label label-danger label-mini text-center"> Inactivo </span>
                                    </td>
                                @endif
                                <td style="vertical-align: inherit;" class="text-center">
                                    <a id="edit" href="{{ route('userAdmin.edit',Crypt::encrypt($user->id)) }}">
                                        <button class="btn btn-primary btn-md">
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                    </a>
                                    <button class="btn {{ $user->state?'btn-danger':'btn-success' }} delete-modal btn-md" data-id="{{ $user->id }}" data-state="{{ $user->state }}">
                                        <i class="fa {{ $user->state?'fa-times':'fa-check' }}"></i>
                                    </button>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">{{ $users->links() }}</div>
            </div>
        </div><!-- /col-md-12 -->
    </div><!-- row -->




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
<!-- Modal -->

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
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" id="boton-desactivar"></button>
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
          action = "{{ url('GestionUsuario/Desactivar') }}/" + $(this).data('id');
          $('#titulo-modal').text('¿Esta seguro de desactivar este registro?');
          $('#boton-desactivar').val('Desactivar');
          $('#boton-desactivar').attr('class','btn btn-danger');
          console.log('desactivar');
        }else{
          action = "{{ url('GestionUsuario/Activar') }}/" + $(this).data('id');
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
    #hiper{
        color : #18CADF;
    }
    #edit{
        color : #FFFFFF;
    }
</style>
