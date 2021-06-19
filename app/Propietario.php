<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    public function vehiculo(){
        return $this->hasOne('App\Vehiculo');
    }
}
