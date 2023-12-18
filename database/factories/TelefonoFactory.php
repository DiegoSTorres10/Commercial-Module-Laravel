<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Telefono;
use Illuminate\Database\Eloquent\Factories\Factory;

class TelefonoFactory extends Factory
{
    protected $model = Telefono::class;
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
            'NumeroTelefonico' => $this->faker->regexify('[0-9]{15}'),
        ];
    }
}
