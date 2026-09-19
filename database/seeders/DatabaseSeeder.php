<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            UsuarioSeeder::class,
            ReporteSeeder::class,
            ClienteSeeder::class,
            PqrSeeder::class,
            CategoriaSeeder::class,
            MarcaSeeder::class,
            ProveedorSeeder::class,
            ProductoSeeder::class,
            CarritoSeeder::class,
            DetalleCarritoSeeder::class,
            InventarioSeeder::class,
            PedidoSeeder::class,
            DetallePedidoSeeder::class,
            FacturaSeeder::class,
        ]);
    }
}
