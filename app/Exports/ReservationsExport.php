<?php

namespace App\Exports;

use App\Reservation;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class ReservationsExport implements FromQuery,WithHeadings
{
	private $start;
    private $end;
    private $field;

	public function __construct($start,$end,$field){
        $this->start = $start;
        $this->end = $end;
		$this->field = $field;
	}

	use Exportable;
    public function headings(): array
    {
        return [
            'Administrador',
            'Paterno',
            'Materno',
            'CI Administrador',
            'Cliente',
            'Paterno',
            'Materno',
            'CI Cliente',
            'Email',
            'Estado de Reserva',
            'Cancha',
            'Pago',
            'Deuda',
            'Hora Inicio',
            'Hora Fin'
        ];
    }

    public function query(){
        if($this->field != "all"){
            return Reservation::leftjoin('users','user_id','users.id')
                    ->leftjoin('users as u','u.id','admin_id')
                    ->leftjoin('info_fields','info_reservations.field_id','info_fields.field_id')
                    ->leftjoin('info_centers','info_reservations.center_id','info_centers.center_id')
                    ->leftjoin('info_reservation_states','info_reservations.reservation_state_id','info_reservation_states.reservation_state_id')
                    ->select(
                        'u.name as admin_name',
                        'u.paternal as admin paternal',
                        'u.maternal as admin maternal',
                        'u.ci as admin_ci',
                        'users.name as cli_name',
                        'users.paternal as cli_paternal',
                        'users.maternal as cli_maternal',
                        'users.ci as cli_ci',
                        'users.email',
                        'info_reservation_states.state',
                        'info_fields.name_field',
                        'payment',
                        'pending_debt',
                        'info_reservations.start_date',
                        'info_reservations.end_date')
                    ->whereDate('info_reservations.start_date','>=',$this->start)
                    ->whereDate('info_reservations.start_date','<=',$this->end)
                    ->where('info_reservations.field_id',$this->field);
        }else{
            return Reservation::leftjoin('users','user_id','users.id')
                    ->leftjoin('users as u','u.id','admin_id')
                    ->leftjoin('info_fields','info_reservations.field_id','info_fields.field_id')
                    ->leftjoin('info_centers','info_reservations.center_id','info_centers.center_id')
                    ->leftjoin('info_reservation_states','info_reservations.reservation_state_id','info_reservation_states.reservation_state_id')
                    ->select(
                        'u.name as admin_name',
                        'u.paternal as admin paternal',
                        'u.maternal as admin maternal',
                        'u.ci as admin_ci',
                        'users.name as cli_name',
                        'users.paternal as cli_paternal',
                        'users.maternal as cli_maternal',
                        'users.ci as cli_ci',
                        'users.email',
                        'info_reservation_states.state',
                        'info_fields.name_field',
                        'payment',
                        'pending_debt',
                        'info_reservations.start_date',
                        'info_reservations.end_date')
                    ->whereDate('info_reservations.start_date','>=',$this->start)
                    ->whereDate('info_reservations.start_date','<=',$this->end);
        }
    }
}
