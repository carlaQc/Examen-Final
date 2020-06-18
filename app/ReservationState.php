<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationState extends Model
{
    protected $table = 'info_reservation_states';
    
    protected $primaryKey = 'reservation_state_id';
}
