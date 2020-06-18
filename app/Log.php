<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table='info_logs';

    protected $primaryKey = 'log_id';
}
