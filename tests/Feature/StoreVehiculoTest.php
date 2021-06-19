<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreVehiculoTest extends TestCase
{
    /** @test*/
    public function testInsertCorrect()
    {

        $response = $this->postJson('api/vehiculos', [
            "placa" => Str::random(6),
            "marca" => "Marca",
            "nombre" => "Nombre",
            "cedula" => rand(10000000,999999999)
        ]);

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }

    /** @test*/
    public function testInsertNull()
    {

        $response = $this->postJson('api/vehiculos', [
            "placa" => "",
            "marca" => "",
            "nombre" => "",
            "cedula" => ""
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'created' => false,
                'message' => [
                    "placa" => [ "El campo placa es obligatorio."],
                    "marca" => [ "El campo marca es obligatorio."],
                    "nombre" => [ "El campo nombre es obligatorio."],
                    "cedula" => [ "El campo cedula es obligatorio."]
                ]
            ]);
    }

    /** @test*/
    public function testInsertRepeat()
    {

        $response = $this->postJson('api/vehiculos', [
            "placa" => "ABC123",
            "marca" => "Marca",
            "nombre" => "Nombre",
            "cedula" => "111111111"
        ]);

        $response
            ->assertStatus(400)
            ->assertJson([
                'created' => false,
                'message' => [
                    "placa" => [ "El valor del campo placa ya está en uso."],
                    "cedula" => [ "El valor del campo cedula ya está en uso."]
                ]
            ]);
    }
}
