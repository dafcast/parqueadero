<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = ['placa','marca','tipo'];

    public function propietario(){
        return $this->belongsTo('App\Propietario');
    }
}
