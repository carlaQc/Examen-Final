<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'info_reservations';
    
    protected $primaryKey = 'reservation_id';
  
	public function center(){
		return $this->belongsTo(Center::class,'center_id');
	}
}
