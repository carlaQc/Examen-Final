<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $table = 'info_centers';

    protected $primaryKey = 'center_id';

    public function users(){
        return $this->hasMany(User::class,'center_id');
    }
}
