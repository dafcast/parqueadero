<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetVehiculoTest extends TestCase
{
    /** @test */
    public function searchVehicle()
    {
        $response = $this->get('/api/vehiculos/search/?placa=ABC123');

        $response
            ->assertStatus(200)
            ->assertJson([[
                'id' => 1,
                'placa' => "ABC123",
                'marca' => 'marca',
                'propietario_id' => 1,
            ]]);
        ;
    }


    /** @test */
    public function getVehicles()
    {
        $response = $this->get('/api/vehiculos');

        $response
            ->assertStatus(200);
    }
}
