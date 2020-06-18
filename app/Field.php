<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
	protected $table = 'info_fields';
	
    protected $primaryKey = 'field_id';
}
