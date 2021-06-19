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
            'Marca' => 'marca',
            'propietario_id' => 1
        ]);
    }
}
