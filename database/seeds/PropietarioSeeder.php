<?php

use App\Propietario;
use Illuminate\Database\Seeder;

class PropietarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Propietario::create([
            'nombre' => 'Nombre',
            'cedula' => '111111111'
        ]);
    }
}
