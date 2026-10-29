<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * php artisan migrate:fresh --seed
     */
    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            UsuarioSeeder::class,   // 5 usuarios de prueba
            CatalogoSeeder::class,  // categorías, marcas, proveedores, productos e inventario
            DemoVentasSeeder::class, // pedidos, facturas y PQR de ejemplo para los reportes
        ]);
    }
}
