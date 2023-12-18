<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\DatosEntrega;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatosEntregaFactory extends Factory
{

    protected $model = DatosEntrega::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'IdCliente' => function () {
                return Cliente::factory()->create()->IdCliente;
            },
            'NombreCompleto' => $this->faker->name,
            'Calle' => $this->faker->streetName,
            'NoExterior' => $this->faker->buildingNumber,
            'Nointerior' => $this->faker->randomNumber(3),
            'Colonia' => $this->faker->citySuffix,
            'Municipio' => $this->faker->city,
            'Estado' => $this->faker->state,
            'ClavePais' => $this->faker->randomElement(['MEX', 'ARG', 'BOL']),
            'CP' => $this->faker->postcode,
            'Referencias' => $this->faker->text,
        ];
    }
}
