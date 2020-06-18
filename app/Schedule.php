<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'info_schedules';

    protected $primaryKey = 'schedule_id';
}
