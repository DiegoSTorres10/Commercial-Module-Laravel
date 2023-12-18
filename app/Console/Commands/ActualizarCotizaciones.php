<?php

namespace App\Console\Commands;

use App\Models\Cotizacione;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ActualizarCotizaciones extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cotizaciones:actualizar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Actualiza el estatus de las cotizaciones y borra aquellas con más de 10 días vencidas';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cotizaciones = Cotizacione::where('Estatus', true)->get();

        foreach ($cotizaciones as $cotizacion) {
            $fechaVencimiento = Carbon::parse($cotizacion->FechaVencimiento);

            if ($fechaVencimiento->isPast()) {
                $cotizacion->update(['Estatus' => false]);

                // Verifica si la cotización tiene más de 10 días y la elimina
                if ($fechaVencimiento->diffInDays(Carbon::now()) > 10) {
                    $cotizacion->delete();
                }
            }
        }

        $this->info('Cotizaciones actualizadas correctamente.');
    }
}
