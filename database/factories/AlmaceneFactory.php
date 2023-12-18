<?php

namespace Database\Factories;

use App\Models\Almacene;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlmaceneFactory extends Factory
{
    protected $model = Almacene::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'NombreAlmacen' => $this->faker->name, 
            'DescripcionAlmacen' => $this->faker->text,
            'NumeroTelefonico' => $this->faker->regexify('[0-9]{10}'),
            'Calle' => $this->faker->streetName,
            'NoExterior' => $this->faker->buildingNumber,
            'Nointerior' => $this->faker->randomNumber(3),
            'Colonia' => $this->faker->citySuffix,
            'Municipio' => $this->faker->city,
            'Estado' => $this->faker->state,
            'ClavePais' => $this->faker->randomElement(['MEX', 'ARG', 'BOL', 'USA']),
            'CP' => $this->faker->postcode,
        ];
    }
}
