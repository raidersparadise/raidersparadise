<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\RolInterface;
use App\Repositories\RolRepository;

use App\Interfaces\ReporteInterface;
use App\Repositories\ReporteRepository;

use App\Interfaces\CategoriaInterface;
use App\Repositories\CategoriaRepository;

use App\Interfaces\InventarioInterface;
use App\Repositories\InventarioRepository;

use App\Interfaces\UsuarioInterface;
use App\Repositories\UsuarioRepository;

use App\Interfaces\ProveedorInterface;
use App\Repositories\ProveedorRepository;

use App\Interfaces\ProductoInterface;
use App\Repositories\ProductoRepository;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            RolInterface::class,
            RolRepository::class
        );

        $this->app->bind(
            ReporteInterface::class,
            ReporteRepository::class
        );

        $this->app->bind(
            CategoriaInterface::class,
            CategoriaRepository::class
        );

        $this->app->bind(
            InventarioInterface::class,
            InventarioRepository::class
        );

        $this->app->bind(
            UsuarioInterface::class,
            UsuarioRepository::class
        );

        $this->app->bind(
            ProveedorInterface::class,
            ProveedorRepository::class
        );

        $this->app->bind(
            ProductoInterface::class,
            ProductoRepository::class
        );
    }

    public function boot(): void
    {
        //
    }
}