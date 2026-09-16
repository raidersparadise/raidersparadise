<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\RolInterface;
use App\Services\RolService;

use App\Interfaces\CategoriaInterface;
use App\Services\CategoriaService;

use App\Interfaces\InventarioInterface;
use App\Services\InventarioService;

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
            RolService::class
        );

        $this->app->bind(
            CategoriaInterface::class,
            CategoriaService::class
        );

        $this->app->bind(
            InventarioInterface::class,
            InventarioService::class
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