<?php

use App\Vehiculo;
use Illuminate\Database\Seeder;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vehiculo::create([
            'placa' => 'ABC123',
            'marca' => 'marca',
            'tipo' => 'Tipo',
            'propietario_id' => 1
        ]);
    }
}
