<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Nota;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotaFactory extends Factory
{

    protected $model = Nota::class;
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
            'Tema' => $this->faker->sentence,
            'NombreElaborador' => $this->faker->name,
            'FechaProximoSeguimiento' => $this->faker->date,
            'FechaCreacion' => $this->faker->date,
            'Estatus' => $this->faker->boolean,
            'Observaciones' => $this->faker->paragraph,
        ];
    }
}
