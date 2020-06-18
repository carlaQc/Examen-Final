@extends('layouts.app')
@section('content')

<section class="wrapper">
<!--main content start-->
<h3 style="margin-left: 20px;"><i class="fa fa-angle-right"></i> <strong>Gestion de Usuarios -</strong> Centro Deportivo</h3>
<div class="col-md-12">
    <div class="content-panel table-responsive">
        <table class="table table-striped table-advance table-hover" >
        <h4 style="float:left;"><i class="fa fa-angle-right"></i> AGENDA DE RESERVAS</h4>
    
        <hr>
            <thead>
                <tr>
                    <th><i class="fa fa-user"></i> Hora</th>
                    <th><i class="fa fa-envelope"></i> Lunes</th>
                    <th class="text-center"><i class="fa fa-user"></i> Martes</th>
                    <th class="text-center"><i class="fa fa-phone"></i> Miercoles</th>
                    <th class="text-center"><i class="fa fa-box"></i> Jueves</th>
                    <th class="text-center"><i class="fa fa-edit"></i> Viernes</th>
                    <th class="text-center"><i class="fa fa-cog"></i> Sabado</th>
                    <th class="text-center"><i class="fa fa-cog"></i> Domingo</th>
                </tr>
            </thead>
            <tbody>

            	@php($start=0)
            	@php($end=7)
                @foreach($hours as $hour)
                <tr>
                	<td class="text-center"> {{ $hour->hour }} - {{ $hour->hour_secondary }} </td>
                    @for($i=$start; $i<$end; $i++)
                    	{{-- Agregar boton para que pueda enviarlo a un controlador y cambiar de estado Cambiar el estado del boton en este caso (disable si esta en cero, y estara habilitado cuando este en uno)--}}
                    	<td class="text-center"> {{$date[$i]->state_hour}} </td>
                    @php($start = $i+1)
                    @endfor
                    @php($end = $end+7)
                </tr>
                @endforeach

            </tbody>
        </table>
    </div><!-- /content-panel -->
</div><!-- /col-md-12 --> 
<!-- /MAIN CONTENT -->
{{-- Modal  --}}
</section>
@endsection
<style>
    #edit{
        color : #FFFFFF;
    }
</style>