<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{

    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'FechaAlta' => $this->faker->date,
            'RFC' => $this->faker->regexify('[A-Z0-9]{14}'),
            'CURP' => $this->faker->regexify('[A-Z0-9]{18}'),
            'NombreCompleto' => $this->faker->name,
            'Email' => $this->faker->unique()->safeEmail,
            'ClaveTipo' => $this->faker->randomElement(['CNI', 'CNA']),
            'Calle' => $this->faker->streetName,
            'NoExterior' => $this->faker->buildingNumber,
            'Nointerior' => $this->faker->randomNumber(3),
            'Colonia' => $this->faker->citySuffix,
            'Municipio' => $this->faker->city,
            'Estado' => $this->faker->state,
            'ClavePais' => $this->faker->randomElement(['MEX', 'ARG', 'BOL']),
            'CP' => $this->faker->postcode,
        ];
    }
}
