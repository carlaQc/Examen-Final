<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationPayment extends Model
{
    protected $table = 'info_reservation_payment';

    protected $primaryKey = 'state_payment_id';
}
