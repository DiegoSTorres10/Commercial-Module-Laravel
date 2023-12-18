<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PaisSeeder::class);
        $this->call(TipoClienteSeeder::class);
        $this->call(AccesoModuloSeeder::class);
        $this->call(ClienteSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(TelefonosSeeder::class);
        $this->call(DatosEntregaSeeder::class);
        $this->call(DatosFacturacioneSeeder::class);
        $this->call(NotasSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(TipoProdServiciosSeeder::class);
        $this->call(TiposMonedasSeeder::class);
        $this->call(ListaPrecioSeeder::class);
        $this->call(ProductosServiciosSeeder::class);
        $this->call(AlmaceneSeeder::class);
        $this->call(TipoMovimientoSeeder::class);
        $this->call(RazonesSeeder::class);
        $this->call(InventarioSeeder::class);
        $this->call(TiposPagoSeeder::class);
    }
}
