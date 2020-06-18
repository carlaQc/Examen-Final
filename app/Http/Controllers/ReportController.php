<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;
use App\Field;

class ReportController extends Controller
{
	/**
	 *  Se obtiene todas las canchas del centro deportivo y se redicciona a la ventana de reportes
	 */
    public function getReport(){
    	$field = Field::where('center_id',auth()->user()->center_id)->get();
    	return view('report.index',[
    		'fields' => $field
    	]);
    }
    /**
     * 	Se tiene un reporte de todas las reservas realizadas
     */
    public function filterReport(Request $request){
    	$field = Field::where('center_id',auth()->user()->center_id)->get();
        if($request->field != "all"){
            $report = Reservation::leftjoin('users','info_reservations.user_id','users.id')
                    ->leftjoin('users as u','u.id','admin_id')
                    ->leftjoin('info_fields','info_reservations.field_id','info_fields.field_id')
                    ->leftjoin('info_centers','info_reservations.center_id','info_centers.center_id')
                    ->leftjoin('info_reservation_states','info_reservations.reservation_state_id','info_reservation_states.reservation_state_id')
                    ->select('info_reservation_states.state as estado_reserva','u.name as nombre_admin','u.paternal as paterno_admin','u.maternal as materno_admin','u.email as email_admin','u.ci as ci_admin','users.name as nombre_cliente','users.paternal as paterno_cliente','users.maternal as materno_cliente','users.email as email_cliente','users.ci as ci_cliente','info_reservations.name_reservation as nombre_reserva','info_reservations.field_id','info_reservations.current_date as fecha_reserva','info_reservations.start_date as fecha_reserva_inicio','info_reservations.end_date as fecha_reserva_fin','info_fields.name_field as nombre_cancha','info_centers.name_center as nombre_centro','payment as pago','pending_debt as deuda','info_fields.price as precio_total_cancha')
                    ->whereDate('info_reservations.start_date','>=',$request->start)
                    ->whereDate('info_reservations.start_date','<=',$request->end)
                    ->where('info_reservations.field_id',$request->field)
                    ->get();
        }else{
            $report = Reservation::leftjoin('users','info_reservations.user_id','users.id')
                    ->leftjoin('users as u','u.id','admin_id')
                    ->leftjoin('info_fields','info_reservations.field_id','info_fields.field_id')
                    ->leftjoin('info_centers','info_reservations.center_id','info_centers.center_id')
                    ->leftjoin('info_reservation_states','info_reservations.reservation_state_id','info_reservation_states.reservation_state_id')
                    ->select('info_reservation_states.state as estado_reserva','u.name as nombre_admin','u.paternal as paterno_admin','u.maternal as materno_admin','u.email as email_admin','u.ci as ci_admin','users.name as nombre_cliente','users.paternal as paterno_cliente','users.maternal as materno_cliente','users.email as email_cliente','users.ci as ci_cliente','info_reservations.name_reservation as nombre_reserva','info_reservations.field_id','info_reservations.current_date as fecha_reserva','info_reservations.start_date as fecha_reserva_inicio','info_reservations.end_date as fecha_reserva_fin','info_fields.name_field as nombre_cancha','info_centers.name_center as nombre_centro','payment as pago','pending_debt as deuda','info_fields.price as precio_total_cancha')
                    ->whereDate('info_reservations.start_date','>=',$request->start)
                    ->whereDate('info_reservations.start_date','<=',$request->end)
                    ->get();
        }
        $start = $request->start;
        $end = $request->end;
        $field_id = $request->field;

    	return view('report.index',[
    		'report'   => $report,
    		'start'    => $start,
    		'end'	   => $end,
    		'fields'   => $field,
            'field_id' => $field_id
    	]);
    }
}
