@extends('layouts.app')
@section('content')
<section class="wrapper">
<!--main content start-->

{{-- Se verifica si el administrador del centro deportivo habilito el horario --}}
@if(!empty($field->first()->state))
<h3 class="text-center"><strong>Configuración - Horario "{{ $center->name_center }}"</strong></h3>

<div class="col-md-12">
    <div class="content-panel table-responsive">
        @include('layouts.newnotification')

        <table class="table table-striped table-advance table-hover">

        <h4><i class="fa fa-angle-right"></i> Canchas Disponibles:
            @foreach($field as $f)
                <a style="text-decoration:none;" href="{{ route('scheduleReserve.get',Crypt::encrypt($f->field_id)) }}">
                    &nbsp;&nbsp;<button type="button" class="btn btn-round btn-info">{{ $f->name_field}}</button>&nbsp;
                </a>
            @endforeach

            <a class="text-center">
                &nbsp; Fecha Actual: {{ $current_date }}
            </a>
        </h4>

        <hr>
            <thead>
                <tr>
                    <th class="text-center">
                    	<i class="fa fa-clock-o"></i> HORA
                    </th>
                    <th class="text-center">
                        <a style="text-decoration:none;float:center;" href="">
                            <button type="button" class="btn btn-warning">
                                LUNES
                            </button> 
                        </a>
                    <th class="text-center">
                        <a style="text-decoration:none;float:center;" href="">
                            <button type="button" class="btn btn-warning">
                                MARTES
                            </button> 
                        </a>
                    </th>
                    <th class="text-center">
                        <a style="text-decoration:none;float:center;" href="">
                            <button type="button" class="btn btn-warning">
                                MIERCOLES
                            </button> 
                        </a>
                    </th>
                    <th class="text-center">
                        <a style="text-decoration:none;float:center;" href="">
                            <button type="button" class="btn btn-warning">
                                JUEVES
                            </button> 
                        </a>
                    <th class="text-center">
                        <a style="text-decoration:none;float:center;" href="">
                            <button type="button" class="btn btn-warning">
                                VIERNES
                            </button> 
                        </a>
                    </th>
                    <th class="text-center">
                        <a style="text-decoration:none;float:center;" href="">
                            <button type="button" class="btn btn-warning">
                                SABADO
                            </button> 
                        </a>
                    </th>
                    <th class="text-center">
                        <a style="text-decoration:none;float:center;" href="">
                            <button type="button" class="btn btn-warning">
                                DOMINGO
                            </button> 
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @php($start=0)
                @php($end=7)
                @php($sw=0)
{{-- Se genera la tabla de Horario --}}
                @foreach($hours as $hour)
                <tr>
                    {{-- Muestra la hora --}}
                    <td class="text-center"> {{ $hour->hour }} - {{ $hour->hour_secondary }} </td>
                    {{-- Se obtiene todos los datos de la fecha / para mostrar en el calendario --}}
                    @for($i=$start; $i<$end; $i++)

                        {{-- Cuando el administrador del centro deportivo inhabilita el dia de reserva --}}
                        @if($sw == 0 && $date[$i]->state_day == 0)
                        {{-- Modificar estilo del boton --}}
                        <td class="text-center"> 
                            <button disabled="true" type="button" class="btn btn-default">
                                INHABILITADO
                            </button> 
                        </td>
                        @php($sw=1)
                        {{-- fin Modificar estilo del boton --}}
                        @endif

                        {{-- Cuando el adminstrador inhabilita una hora --}}
                        @if($sw == 0 && $date[$i]->state_hour == 0)
                        {{-- Modificar estilo del boton --}}
                        <td class="text-center"> 
                            <button disabled="true" type="button" class="btn btn-default">
                                INHABILITADO
                            </button> 
                        </td>
                        @php($sw=1)
                        {{-- fin Modificar estilo del boton --}}
                        @endif

                        {{-- Cuando el dia ya paso se inhabilita el boton --}}
                        @if($sw == 0 && $date[$i]->day < $day)
                        {{-- Modificar estilo del boton --}}
                        <td class="text-center"> 
                            <button disabled="true" type="button" class="btn btn-default">
                                INHABILITADO
                            </button> 
                        </td>
                        @php($sw=1)
                        {{-- fin Modificar estilo del boton --}}
                        @endif

                        {{-- El horario se acopla al horario actual/se coordina la hora actual --}}
                        {{-- la hora y el dia del calendario son menores a la hora actual se restringe la reserva y se inhabilita el boton --}}
                        @if($sw == 0 && $date[$i]->day == $day && $date[$i]->number < $h)
                        {{-- Modificar estilo del boton --}}
                            <td class="text-center"> 
                                <button disabled="true" type="button" class="btn btn-default">
                                    INHABILITADO
                                </button> 
                            </td>
                        {{-- fin Modificar estilo del boton --}}
                        @php($sw=1)
                        @endif

                        {{-- verificacion de reserva en el estado --}}
                        @if($sw==0)
                        @foreach($reservation as $r)
                            @if($r->hour == $date[$i]->number && $r->day == $date[$i]->day)

                                @if($r->reservation_state_id == 1)
                                {{-- Estado pendiente / cuando es creado por un cliente y no poe el administrador del centro deportivo --}}
                                {{-- Modificar estilo del boton --}}

                                @if(Auth::user()->rol_id == 2 || Auth::user()->rol_id == 3)
                                {{-- Crypt::encrypt($r->reservation_id) Encripta los datos     --}}
                                    <td class="text-center"> 
                                        <a style="text-decoration:none;float:center;" href="{{ route('scheduleStateReservation.edit',Crypt::encrypt($r->reservation_id)) }}"> 
                                            <button type="button" class="btn btn-warning">
                                                PENDIENTE
                                            </button> 
                                        </a>
                                    </td>
                                @endif
                                @if(Auth::user()->rol_id == 1 || Auth::user()->rol_id == 4)
                                    <td class="text-center"> 
                                        {{-- <a style="text-decoration:none;float:center;" href="{{ route('scheduleStateReservation.edit',$data[$i]->center_id) }}"> --}}
                                            <button type="button" class="btn btn-warning">
                                                PENDIENTE
                                            </button> 
                                        {{-- </a> --}}
                                    </td>
                                @endif

                                {{-- fin Modificar estilo del boton --}}
                                @php($sw=1)  
                                @endif

                                {{-- Cuando el estado de la reserva ya fue aceptado o fue creado por el administrador --}}
                                @if($r->reservation_state_id == 2)
                                {{-- Modificar estilo del boton --}}
                                    <td class="text-center"> 
                                        <button type="button" class="btn btn-success">
                                            RESERVADO 
                                        </button> 
                                    </td>
                                {{-- fin Modificar estilo del boton --}}
                                @php($sw=1)
                                @endif
                            @endif
                        @endforeach
                        @endif

                        {{-- si el horario esta libre o expiro alguna reserva puede hacer una nueva reserva --}}
                        @if($sw == 0)
                        {{-- en route se envia: center_id, day, number(envia la hora) --}}
                        {{-- Modificar estilo del boton --}}
                            <td class="text-center"> 
                                <a style="text-decoration:none;float:center;" href="{{ route('scheduleReserve.create',[Crypt::encrypt($date[$i]->field_id), Crypt::encrypt($date[$i]->day), Crypt::encrypt($date[$i]->number)]) }}">
                                    <button type="button" class="btn btn-primary">
                                        HABILITADO
                                    </button> 
                                </a>
                            </td>
                        {{-- fin Modificar estilo del boton --}}  
                        @endif    
                        @php($sw=0)  
                        {{-- Fin de modulo de reserva --}}
                    
                    @php($start = $i+1)
                    @endfor
                    @php($end = $end+7)
                </tr>
                @endforeach
{{-- Fin de la tabla de Horario --}}
            </tbody>
        </table>
    </div><!-- /content-panel -->
</div><!-- /col-md-12 --> 
<!-- /MAIN CONTENT -->
{{-- Modal  --}}
@else
<h3 class="text-center"><strong>Horario "{{ $center->name_center }}" - No Disponible </strong></h3>
@endif
</section>
@endsection
