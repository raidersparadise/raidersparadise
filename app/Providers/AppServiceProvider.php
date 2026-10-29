<?php

namespace App\Providers;

use App\Support\Formato;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('partials.paginacion');

        // @cop($valor) imprime un valor en pesos colombianos: $ 1.250.000
        Blade::directive('cop', fn ($exp) => "<?php echo e(\\App\\Support\\Formato::cop($exp)); ?>");

        // Contador del carrito disponible en todas las vistas de la tienda
        View::composer('layouts.tienda', function ($view) {
            $items = 0;
            $usuario = auth()->user();
            if ($usuario && $usuario->cliente && $usuario->cliente->carrito) {
                $items = (int) $usuario->cliente->carrito->detalles()->sum('cantidad');
            }
            $view->with('carritoItems', $items);
        });
    }
}
