@extends('layouts.app')
@section('content')
<section class="wrapper">
@include('layouts.newnotification')

    <h3><i class="fa fa-angle-right"></i> <strong>Gestionar Promociones</strong> </h3>
    <div>
        Lista de Promociones  
        <button style="margin-bottom: 20px;float: right;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" >
            <i class="fa fa-plus"></i> Nueva Promoción
        </button>
    </div><br>

    <div class="row">
        <div class="col-md-12">
            <div class="content-panel table-responsive formi">

                <table class="table table-striped table-advance table-hover">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Acción</th>
                  </tr>
                </thead>
                    <tbody>
                        @foreach($promotion as $pro)
                            <tr>
                                <td style="vertical-align: inherit;">{{ $pro->description_promotion }}</td>
                                @if($pro->state == 1)
                                    <td style="vertical-align: inherit;" class="text-center">
                                        <span class="label label-success label-mini text-center"> Activo </span>
                                    </td>
                                @else
                                    <td style="vertical-align: inherit;" class="text-center">
                                        <span class="label label-danger label-mini text-center"> Inactivo </span>
                                    </td>
                                @endif
                                <td class="text-center" style="vertical-align: inherit;">
                                    <button class="btn {{ $pro->state?'btn-danger':'btn-success' }} delete-modal btn-md" data-id="{{ $pro->promotion_id }}" data-state="{{ $pro->state }}">
                                        <i class="fa {{ $pro->state?'fa-times':'fa-check' }}"></i>
                                    </button>
                                </td> 
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="text-center">{{ $users->links() }}</div> --}}
            </div>
        </div><!-- /col-md-12 -->
    </div><!-- row -->

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

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Nueva Promoción</h4>
            </div>
            <form data-parsley-validate class="form-horizontal style-form formi" action="{{route('promotion.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="form-group">
                    <label class="col-lg-3 control-label">
                        <span class="req">*</span>
                        <strong>Descripción:</strong>
                    </label>
                    <div class="col-lg-9">
                        <input type="text" class="form-control " name="description" placeholder="Ingrese promoción">
                    </div><br>
                </div>              
              
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div> 
</section>
<!-- /MAIN CONTENT -->
@endsection
@section('script')
<script>
    $('.delete-modal').click(function() {
        var estado = $(this).data('state');
        let action;
        if(estado == 1){
          action = "{{ url('promocion/accion') }}/" + $(this).data('id');
          $('#titulo-modal').text('¿Esta seguro de desactivar esta promoción?');
          $('#boton-desactivar').val('Desactivar');
          $('#boton-desactivar').attr('class','btn btn-danger');
          console.log('desactivar');
        }else{
          action = "{{ url('promocion/accion') }}/" + $(this).data('id');
          $('#titulo-modal').text('¿Esta seguro de activar esta promoción?');
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