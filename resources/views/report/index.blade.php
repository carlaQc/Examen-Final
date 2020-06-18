@extends('layouts.app')
@section('content')
<section class="wrapper">
{{-- @include('layouts.newnotification') --}}

    <h3><i class="fa fa-angle-right"></i> <strong>Reportes</strong> </h3>
    <div class="row">
        <div class="col-md-12">
            <div class="content-panel table-responsive formi">
                <form id="form-export" class="form-inline" role="form" action="{{ route('report.filter') }}" method="POST">
                <div id="val"></div>
                @csrf
                    <div class="form-group">
                        <label for=""><strong>Fecha inicio:</strong></label>
                        @if(!empty($start))
                            <input id="start" type="date" class="form-control" name="start" value="{{ old('start') }}{{ $start }}">
                        @else
                            <input id="start" type="date" class="form-control" name="start" value="{{ old('start') }}">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for=""><strong>Fecha fin:</strong></label>
                        @if(!empty($end))
                            <input id="end" type="date" class="form-control" name="end" value="{{ old('end') }}{{ $end }}">
                        @else
                            <input id="end" type="date" class="form-control" name="end" value="{{ old('end') }}">
                        @endif
                    </div>
                    <div class="form-group">
                        <label for=""><strong>Campo:</strong></label>
                        <select id="field" name="field" class="form-control">
                            <option value="all"> Todas los campos </option>
                            @foreach($fields as $field)
                                @if(!empty($field_id))
                                    <option value="{{ $field->field_id }}"{{ $field->field_id == $field_id?'selected':'' }}> {{ $field->name_field }} </option>
                                @else    
                                    <option value="{{ $field->field_id }}"> {{ $field->name_field }} </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button id="fil" type="button" class="btn btn-theme">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">
                                Filtrar
                            </font>
                        </font>
                    </button>
                    @if(Auth::user()->rol_id == 2)
                        <div class="form-group">
                            <label for=""><strong>Reporte en Excel:</strong></label>
                            <button type="button" id="export-excel" class="btn btn-success">
                                <font style="vertical-align: inherit;">
                                    <i class="fa fa-file-excel-o"></i>
                                    <font style="vertical-align: inherit;">
                                        Descargar
                                    </font>
                                </font>
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="content-panel table-responsive">

                <table class="table table-striped table-advance table-hover">
                <thead>
                  <tr>
                    <th>Nombre Administrador</th>
                    <th>CI-ADMIN</th>
                    <th class="text-left">Nombre Cliente</th>
                    <th class="text-left">CI-CLI</th>
                    <th class="text-center">Estado de Reserva</th>
                    <th class="text-left">Cancha</th>
                    <th class="text-left">Pago</th>
                    <th class="text-left">Deuda</th>
                  </tr>
                </thead>
                    <tbody>
                        @if(!empty($report))
                            @foreach($report as $re)
                                <tr>
                                    <td style="vertical-align: inherit;">{{ $re->nombre_admin == ""? '---':'' }}{{ $re->nombre_admin }} {{ $re->paterno_admin }} {{ $re->materno_admin }}
                                    </td>
                                    <td style="vertical-align: inherit;">{{ $re->ci_admin == ""? '---':'' }}{{ $re->ci_admin }}</td>
                                    <td style="vertical-align: inherit;">{{ $re->nombre_cliente }} {{ $re->paterno_cliente }} {{ $re->materno_cliente }}</td>
                                    <td style="vertical-align: inherit;">{{ $re->ci_cliente == ""? '---':'' }}{{ $re->ci_cliente }}</td>

                                    @if($re->estado_reserva == "Pendiente")
                                        <td style="vertical-align: inherit;" class="text-center">
                                            <span class="label label-warning label-mini text-center"> {{ $re->estado_reserva }} </span>
                                        </td>
                                    @else
                                        @if($re->estado_reserva == "Reservado")
                                            <td style="vertical-align: inherit;" class="text-center">
                                                <span class="label label-success label-mini text-center"> {{ $re->estado_reserva }} </span>
                                            </td>
                                        @else
                                            <td style="vertical-align: inherit;" class="text-center">
                                                <span class="label label-danger label-mini text-center"> {{ $re->estado_reserva }} </span>
                                            </td>
                                        @endif
                                    @endif

                                    <td style="vertical-align: inherit;">{{ $re->nombre_cancha }}</td>
                                    <td style="vertical-align: inherit;">{{ $re->pago }}</td>
                                    <td style="vertical-align: inherit;">{{ $re->deuda }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')

    <script>
        var start = "1";
        var end = "1";
        var field = "1";
        $('#export-excel').on('click',  function(){
            if($('#start').val() != ""){
                start = $('#start').val();
                end = $('#end').val();
                field = $('#field').val();
                // alert(end);
                location.href = "{{ url('exportar-excel') }}/"+start+'/'+end+'/'+field; 
            }
        })
        // Validación
        $('#fil').on('click', function(){
            let validar = "";
            if($('#start').val() == ""){
                validar = `<li>Seleccionar una fecha de inicio.</li>`;
            }
            if($('#end').val() == ""){
                validar += `<li>Seleccionar una fecha .</li>`;
            }
            if($('#start').val() != "" && $('#end').val() != ""){
                $('#form-export').submit();
            }else{
                $('#val').html(`<div class="alert alert-warning alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong>`+validar+`</strong> 
                            </div>`);
            }
        });
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
