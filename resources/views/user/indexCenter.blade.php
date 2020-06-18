@extends('layouts.app')
@section('content')
<section class="wrapper">
<!--main content start-->
@include('layouts.newnotification')

<h3><i class="fa fa-angle-right"></i> <strong>Centros Deportivos</strong> </h3>
<div>
    Lista de Centros Deportivos 
</div><br>

<div class="row">
    <div class="col-md-12">
        <div class="content-panel table-responsive formi">

            <table class="table table-striped table-advance table-hover">
            <thead>
              <tr>
              <!--	<th>ID</th> -->
                <th>Centro Deportivo</th>
                <th>Nit</th>
                <th>Dirección</th>
                <th>Telf/Cel</th>
                <th class="text-center">Estado</th>
                <th class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
                @foreach($centers as $center)
                    <tr>
                    <!--	<td style="vertical-align: inherit;">{{ $center->center_id }}</td>-->
                        <td style="vertical-align: inherit;">{{ $center->name_center }}</td>
                        <td style="vertical-align: inherit;">{{ $center->nit }}</td>
                        <td style="vertical-align: inherit;">{{ $center->address }}</td>
                        <td style="vertical-align: inherit;">{{ $center->cellphone }}</td>
                        @if($center->state)
                            <td style="vertical-align: inherit;" class="text-center">
                                <span style="vertical-align: inherit;" class="label label-success"> Activo </span>
                            </td>
                        @else
                            <td style="vertical-align: inherit;" class="text-center">
                                <span class="label label-danger label-mini text-center"> Inactivo </span>
                            </td>
                        @endif
                        <td style="vertical-align: inherit;" class="text-center">
                            <button class="btn btn-primary btn-md">
                                <a id="edit" href="{{ route('user.edit',Crypt::encrypt($center->center_id)) }}">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </button>
                            <button class="btn {{ $center->state?'btn-danger':'btn-success' }} delete-modal btn-md" data-id="{{ $center->center_id }}" data-state="{{ $center->state }}">
                                <i class="fa {{ $center->state?'fa-times':'fa-check' }}"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            </table>
            <div class="text-center">{{ $centers->links() }}</div>
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
</section>
@endsection
@section('script')
<script>
    $('.delete-modal').click(function() {
        var estado = $(this).data('state');
        let action;
        if(estado == 1){
          action = "{{ url('centro-deportivo/estado') }}/" + $(this).data('id');
          $('#titulo-modal').text('¿Esta seguro de desactivar este registro?');
          $('#boton-desactivar').val('Desactivar');
          $('#boton-desactivar').attr('class','btn btn-danger');
          console.log('desactivar');
        }else{
          action = "{{ url('centro-deportivo/estado') }}/" + $(this).data('id');
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