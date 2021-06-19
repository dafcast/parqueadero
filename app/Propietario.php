<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    protected $fillable = ['nombre','cedula'];
    
    public function vehiculo(){
        return $this->hasOne('App\Vehiculo');
    }
}
