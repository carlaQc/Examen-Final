<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\ScheduleStore;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReservationsExport;
use App\ScheduleDetail;
use App\Reservation;
use Carbon\Carbon;
use App\Schedule;
use App\Center;
use App\Field;
use App\User;
use App\Hour;
use App\Log;
use DB;

class ScheduleController extends Controller
{
    /**
     * Listar datos del calendario creado(Solo puede ver administradores) y podra modificar el estado de su horario.
     * Tipo: GET
     * URL: Calendario
     * @Autor: Ronald Mollericona Miranda
     */
    public function getSchedule()
    {
    	$date = Schedule::join('info_schedule_details as schedule','schedule.schedule_id','=','info_schedules.schedule_id')
                        ->join('info_hours','info_hours.schedule_detail_id','=','schedule.schedule_detail_id')
                        ->select('center_id','schedule.schedule_detail_id','schedule.day','schedule.state_day','info_hours.hour','info_hours.hour_secondary','info_hours.state_hour')
                        ->where('center_id',auth()->user()->center_id)
                        ->get();

        $hour = Hour::select('hour','hour_secondary','number')
                    ->orderBy('number','asc')
                    ->groupBy('number','hour','hour_secondary')
                    ->get();

        return view('prueba.index',[
            'date' => $date,
            'hours' => $hour
        ]);
    }

    /** SOLO CLIENTES
     * Listar datos del calendario creado/ Solo podran ver los clientes y el modulo de reserva es necesario enviar el id de la cancha seleccionada.
     * Tipo: GET
     * URL: Calendario/Reserva/{field_id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function getScheduleReservation($field_id)
    {
        $field_id = Crypt::decrypt($field_id);
        // Datos para armar el calendario /Obteneido los datos en numero. Ejemplo el dia y la hora
        $date = Schedule::join('info_schedule_details as schedule','schedule.schedule_id','=','info_schedules.schedule_id')
                        ->join('info_hours','info_hours.schedule_detail_id','=','schedule.schedule_detail_id')
                        ->select('field_id','center_id','schedule.schedule_detail_id','schedule.day','schedule.state_day','info_hours.hour','info_hours.hour_secondary','info_hours.state_hour','info_hours.number')
                        ->where('field_id',$field_id)
                        ->orderBy('number','asc')
                        ->orderBy('day','asc')
                        ->get();
        // Dato para mostrar las horas que se reservara
        $hour = Hour::select('hour','hour_secondary','number')
                    ->orderBy('number','asc')
                    ->groupBy('number','hour','hour_secondary')
                    ->get();
        // Se obtiene los datos de las reservas hechas en la semana
        $reserve = Reservation::where('field_id',$field_id)
                            ->whereDate('start_date','>=',date('Y-m-d'))
                            ->orderBy('start_date','asc')
                            ->get();

        $name_center = Center::select('name_center')
                                    ->where('center_id',$date->first()->center_id)
                                    ->first();
        $field = Field::leftjoin('info_schedules','info_schedules.field_id','info_fields.field_id')
                        ->where('info_fields.center_id',$date->first()->center_id)
                        ->where('info_schedules.state',1)
                        ->get();
        $name_field = Field::findOrFail($field_id);

        return view('prueba.reserva',[
            'date' => $date,
            'hours' => $hour,
            'reservation' => $reserve,
            'current_date' => date('d-m-Y'),
            'day' => date('N'),
            'h' => date('H')-8,
            'center' => $name_center,
            'field' => $field,
            'name_field' => $name_field
        ]);
    }

    /** SOLO ADMINISTRADORES DE LOS CENTROS DEPORTIVOS
     * Listar datos del calendario creado/ Solo podran ver los clientes y el modulo de reserva es necesario enviar el id del centro que se selecciono.
     * Tipo: GET
     * URL: Centro_Deportivo/Reserva/{center_id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function getScheduleReservationAdmin($center_id)
    {
        $center_id = Crypt::decrypt($center_id);
        $field = Field::where('center_id',$center_id)->first();
        $field_id = $field->field_id;
        // Datos para armar el calendario /Obteneido los datos en numero. Ejemplo el dia y la hora
        $date = Schedule::join('info_schedule_details as schedule','schedule.schedule_id','=','info_schedules.schedule_id')
                        ->join('info_hours','info_hours.schedule_detail_id','=','schedule.schedule_detail_id')
                        ->select('field_id','center_id','schedule.schedule_detail_id','schedule.day','schedule.state_day','info_hours.hour','info_hours.hour_secondary','info_hours.state_hour','info_hours.number')
                        ->where('field_id',$field_id)
                        ->orderBy('number','asc')
                        ->orderBy('day','asc')
                        ->get();
        // Dato para mostrar las horas que se reservara
        $hour = Hour::select('hour','hour_secondary','number')
                    ->orderBy('number','asc')
                    ->groupBy('number','hour','hour_secondary')
                    ->get();
        // Se obtiene los datos de las reservas hechas en la semana
        $reserve = Reservation::where('field_id',$field_id)
                            ->whereDate('start_date','>=',date('Y-m-d'))
                            ->orderBy('start_date','asc')
                            ->get();

        $name_center = Center::select('name_center')
                                    ->where('center_id',$date->first()->center_id)
                                    ->first();
        $field = Field::leftjoin('info_schedules','info_schedules.field_id','info_fields.field_id')
                        ->where('info_fields.center_id',$date->first()->center_id)
                        ->where('info_schedules.state',1)
                        ->get();
        $name_field = Field::select('field_id','name_field')->where('center_id',$center_id)->first();

        return view('prueba.reserva',[
            'date' => $date,
            'hours' => $hour,
            'reservation' => $reserve,
            'current_date' => date('d-m-Y'),
            'day' => date('N'),
            'h' => date('H')-8,
            'center' => $name_center,
            'field' => $field,
            'name_field' => $name_field
        ]);
    }

    /**
     * Se almacena los datos del nuevo calendario, de acuerdo a la cancha que se haya generado.
     * Tipo: POST
     * URL: Calendario/Guardar
     * @Autor: Ronald Mollericona Miranda
     */
    public function storeSchedule($field_id)
    {
        $field_id = Crypt::decrypt($field_id);
        $field = Field::findOrFail($field_id);
    	$schedule = new Schedule;
    	$schedule->center_id = $field->center_id;
        $schedule->field_id = $field->field_id;
    	$schedule->save();

    	for ($i = 0; $i < 7; $i++) {
    		$detail = new ScheduleDetail;
            $detail->schedule_id = $schedule->schedule_id;
    		$detail->day = $i+1;
    		$detail->save();
    		$h = 8;
    		for ($j = 0; $j < 14; $j++){
    			$date = new Hour;
                $date->schedule_detail_id = $detail->schedule_detail_id;
    			$date->hour = $h.':00';
    			$h++;
    			$date->hour_secondary = $h.':00';
                $date->number = $j;
    			$date->save();
    		}
    	}
        return redirect()->route('field.get')->with('status','Cancha y Horario creados exitosamente.');
    }

    /**
     * Envia todos los datos a la vista create. Se envia los datos Day y Hour para poder guardarlo en la base de datos.
     * Tipo: GET
     * URL: Calendario/Nuevo/{field_id}/{day}/{hour}
     * @Autor: Ronald Mollericona Miranda
     */
    public function createScheduleReservation($field_id,$day,$hour)
    {
        $field_id = Crypt::decrypt($field_id);
        $day = Crypt::decrypt($day);
        $hour = Crypt::decrypt($hour);

        $field = Field::findOrFail($field_id);
        $data = Center::findOrFail($field->center_id);
        $fecha_actual = Carbon::now();
        // $current_date = $fecha_actual->toDateTimeString('d-m-Y');
        $current_date = $fecha_actual->format('Y-m-d H:i:s');

        $new_day = $day - date("N");
        $day_start = date("Y-m-d",strtotime(date("Y-m-d")."+ ".$new_day." days"));

        $hour_start = date("H:i:s", ($hour+12)*3600);
        $hour_end = date("H:i:s", ($hour+13)*3600);

        $start_date = $day_start.' '.$hour_start;
        $end_date = $day_start.' '.$hour_end;

        return view('prueba.create',[
            'data' => $data,
            'field' => $field,
            'day' => $day,
            'hour' => $hour,
            'current_date' => $current_date,
            'start_date' => $start_date,
            'end_date' => $end_date
        ]);
    }

        /**
     * Se almacena los datos de la reserva en la tabla info_reservations.
     * Tipo: POST
     * URL: Calendario/Nuevo/{center_id}/{rol_id}/{day}/{hour}
     * @Autor: Ronald Mollericona Miranda
     */
    public function storeScheduleReservation(ScheduleStore $request,$field_id,$rol_id,$day,$hour)
    {  
        $field_id = Crypt::decrypt($field_id);
        $rol_id = Crypt::decrypt($rol_id);
        $day = Crypt::decrypt($day);
        $hour = Crypt::decrypt($hour);

        $date_expire = date("Y-m-d H:i:s",strtotime(date("Y-m-d H:i:s")."+ 3 minute"));
        $field = Field::findOrFail($field_id);
        $res = new Reservation;
        $res->center_id = $field->center_id;
        $res->field_id = $field_id;
        // Administradores y empleado
        $value = Field::findOrFail($field_id);
        if($rol_id == 2 || $rol_id == 3){
            $res->reservation_state_id = 2;
            $res->admin_id = auth()->user()->id;
            $res->state_payment_id = $request->state_payment_id;
            if($request->payment == $value->price){
                $res->pending_debt = 0;
                $res->payment = $value->price;
            }else{
                $res->pending_debt = $value->price - $request->payment;
                $res->payment = $request->payment;
            }
        }else{
        // Clientes que realicen la reserva
            $res->reservation_state_id = 1;
            $res->user_id = auth()->user()->id;
            $res->date_expire = $date_expire;
            $res->payment = 0;
            $res->pending_debt = $value->price;
        }
        $res->name_reservation =  $request->name_reservation;
        $res->current_date = $request->current_date;
        $res->start_date = $request->start_date;
        $res->end_date = $request->end_date;
        $res->day = $day;
        $res->hour = $hour;
        $res->save();

        // Log registro de actividad
        $log = new Log;
        $log->user_id = auth()->user()->id;
        $log->reservation_id = $res->reservation_id;
        $log->name = auth()->user()->name;
        $log->date = date('Y-m-d H:m:i');
        $log->data = null;
        $log->new_data = 'idCancha:'.$field_id.','.'dia:'.$day.','.'hora:'.$hour.','.'pago:'.$res->payment.','.'deuda:'.$res->pending_debt.','.'nombreReserva:'.$request->name_reservation.','.'fechaReserva:'.$request->current_date.','.'fechaInicio:'.$request->start_date.','.'fechaFin:'.$request->end_date;
        $log->url = url()->current();
        $log->save();
        // Log registro de actividad

        return redirect()->route('scheduleReserve.get',Crypt::encrypt($field_id));
    }

    /**
     * Envia todos los datos a la vista state. Se envia todos los datos de la reserva que se realizo.
     * Tipo: GET
     * URL: Calendario/Reserva/Cliente/{id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function editScheduleReservation($id)
    {
        $id = Crypt::decrypt($id);
        $data = Reservation::leftjoin('users','info_reservations.user_id','users.id')
                            ->leftjoin('users as u','u.id','admin_id')
                            ->leftjoin('info_fields','info_reservations.field_id','info_fields.field_id')
                            ->leftjoin('info_centers','info_reservations.center_id','info_centers.center_id')
                            ->select('info_reservations.reservation_state_id','u.name as name_admin','u.paternal as paternal_admin','u.maternal as maternal_admin','u.email as email_admin','u.ci as ci_admin','info_reservations.reservation_id','users.name','users.paternal','users.maternal','users.email','users.ci','info_reservations.name_reservation','info_reservations.current_date','info_reservations.start_date','info_reservations.end_date','info_fields.field_id','info_fields.name_field','info_reservations.center_id','info_centers.name_center','payment','pending_debt','info_fields.price')
                            ->findOrFail($id);
// return $data;
        return view('prueba.update_state',[
            'data' => $data
        ]);
    }

    /**
     * Se hace un cambio de estado a las reservas realizadas por los clientes de pendiente a reservado.
     * Tipo: PUT
     * URL: Calendario/Reserva/Cliente/Actualizar/{id}/{field_id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function updateScheduleReservation(Request $request,$id,$field_id)
    {
        $id = Crypt::decrypt($id);
        $field_id = Crypt::decrypt($field_id);

        $reservation = Reservation::findOrFail($id);
        $value = Field::findOrFail($field_id);
        if(!empty($request->debt)){
            // Log registro de actividad
            $log = new Log;
            $log->user_id = auth()->user()->id;
            $log->reservation_id = $reservation->reservation_id;
            $log->name = auth()->user()->name;
            $log->date = date('Y-m-d H:m:i');
            $log->data = 'idCancha:'.$reservation->field_id.','.'dia:'.$reservation->day.','.'hora:'.$reservation->hour.','.'pago:'.$reservation->payment.','.'deuda:'.$reservation->pending_debt.','.'nombreReserva:'.$reservation->name_reservation.','.'fechaReserva:'.$reservation->current_date.','.'fechaInicio:'.$reservation->start_date.','.'fechaFin:'.$reservation->end_date;

            $reservation->state_payment_id = 3;
            $reservation->payment = $value->price;
            $reservation->pending_debt = 0;
            $reservation->save();
            
            $log->new_data = 'pago:'.$value->price.','.'deuda:'.$reservation->pending_debt;
            $log->url = url()->current();
            $log->save();
            // Log registro de actividad
            return redirect()->route('scheduleReserve.get', Crypt::encrypt($field_id))->with('status','Se Cancelo el monto total de '.$value->price.'Bs de la reserva '.$reservation->name_reservation.'!');  
        }else{
            if($value->price == $request->payment){
                $reservation->payment = $value->price;
                $reservation->pending_debt = 0;
                $reservation->state_payment_id = 3;
            }else{
                $reservation->payment = $request->payment;
                $reservation->pending_debt = $reservation->pending_debt - $request->payment;
                $reservation->state_payment_id = 2;
            }
        $reservation->admin_id = auth()->user()->id;
        $reservation->reservation_state_id = 2;
        $reservation->date_expire = null;
        $reservation->save();

        // Log registro de actividad
        $log = new Log;
        $log->user_id = auth()->user()->id;
        $log->reservation_id = $reservation->reservation_id;
        $log->name = auth()->user()->name;
        // Dato anterior
        $log->date = date('Y-m-d H:m:i');
        // Dato actual(cambios)
        $log->data = 'idCancha:'.$value->field_id.','.'dia:'.$value->day.','.'hora:'.$value->hour.','.'pago:'.$value->payment.','.'deuda:'.$value->pending_debt.','.'nombreReserva:'.$value->name_reservation.','.'fechaReserva:'.$value->current_date.','.'fechaInicio:'.$value->start_date.','.'fechaFin:'.$value->end_date;
        $log->new_data = 'pago:'.$reservation->payment.','.'deuda:'.$reservation->pending_debt.','.'estadoPago:'.$reservation->state_payment_id.','.'estadoReserva:'.$reservation->reservation_state_id.','.'fechaExpiración:'.$reservation->date_expire;
        $log->url = url()->current();
        $log->save();
        // Log registro de actividad

        $user = User::where('id',$reservation->user_id)->select('name','paternal')->first();
        return redirect()->route('scheduleReserve.get', Crypt::encrypt($field_id))->with('status','Se Actualizo los datos de reserva del cliente '.$user->name.' '.$user->paternal.'!');
        }
    }

    /**
     * Listar datos del calendario creado/ Solo podran ver los clientes y el modulo de reserva es necesario enviar el id del centro que se selecciono.
     * Tipo: GET
     * URL: Calendario/Reserva/{field_id}
     * @Autor: Ronald Mollericona Miranda
     */
    public function updateScheduleState($field_id)
    {
        $field_id = Crypt::decrypt($field_id);
        // Datos para armar el calendario /Obteneido los datos en numero. Ejemplo el dia y la hora
        $date = Schedule::join('info_schedule_details as schedule','schedule.schedule_id','=','info_schedules.schedule_id')
                        ->join('info_hours','info_hours.schedule_detail_id','=','schedule.schedule_detail_id')
                        ->select('field_id','center_id','schedule.schedule_detail_id','schedule.day','schedule.state_day','info_hours.hour','info_hours.hour_secondary','info_hours.state_hour','info_hours.number')
                        ->where('field_id',$field_id)
                        ->orderBy('number','asc')
                        ->orderBy('day','asc')
                        ->get();
        // Dato para mostrar las horas que se reservara
        $hour = Hour::select('hour','hour_secondary','number')
                    ->orderBy('number','asc')
                    ->groupBy('number','hour','hour_secondary')
                    ->get();
        // Se obtiene los datos de las reservas hechas en la semana
        $reserve = Reservation::where('field_id',$field_id)
                            ->whereDate('start_date','>=',date('Y-m-d'))
                            ->orderBy('start_date','asc')
                            ->get();

        $name_center = Center::select('name_center')
                                    ->where('center_id',$date->first()->center_id)
                                    ->first();
        $field = Field::leftjoin('info_schedules','info_schedules.field_id','info_fields.field_id')
                        ->where('info_fields.center_id',$date->first()->center_id)
                        ->where('info_schedules.state',1)
                        ->get();

        return view('prueba.config_schedule',[
            'date' => $date,
            'hours' => $hour,
            'reservation' => $reserve,
            'current_date' => date('d-m-Y'),
            'day' => date('N'),
            'h' => date('H')-8,
            'center' => $name_center,
            'field' => $field
        ]);
    }

    public function excel($start,$end,$field)
    {
        return (new ReservationsExport($start,$end,$field))->download('Reporte'.date('Y-m-d H:m:i').'.xls');
    }    
}
