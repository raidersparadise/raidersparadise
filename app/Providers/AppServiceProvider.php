<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\RolInterface;
use App\Services\RolService;

use App\Interfaces\CategoriaInterface;
use App\Services\CategoriaService;

use App\Interfaces\InventarioInterface;
use App\Services\InventarioService;

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
    }

    public function boot(): void
    {
        //
    }
}