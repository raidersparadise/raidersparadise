<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PqrController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DetalleCarritoController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\DetallePedidoController;
use App\Http\Controllers\FacturaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get(
    'carrito/cliente/{id_cliente}',
    [CarritoController::class, 'getByCliente']
);

Route::apiResource('carrito', CarritoController::class);

Route::get(
    'cliente/nombre/{nombre}',
    [ClienteController::class, 'getByName']
);

Route::get(
    'cliente/apellido/{apellido}',
    [ClienteController::class, 'getByLastname']
);

Route::apiResource('cliente', ClienteController::class);

Route::get(
    'detalle_carrito/carrito/{id_carrito}',
    [DetalleCarritoController::class, 'getByCarrito']
);

Route::get(
    'detalle_carrito/producto/{id_producto}',
    [DetalleCarritoController::class, 'getByProducto']
);

Route::apiResource('detalle_carrito', DetalleCarritoController::class);

Route::get(
    'pedido/estado/{estado}',
    [PedidoController::class, 'getByEstado']
);

Route::get(
    'pedido/fecha/{fecha}',
    [PedidoController::class, 'getByFecha']
);

Route::get(
    'pedido/total/{total}',
    [PedidoController::class, 'getByTotal']
);

Route::get(
    'pedido/cliente/{id_cliente}',
    [PedidoController::class, 'getByCliente']
);

Route::apiResource('rol', RolController::class);

Route::apiResource('usuario', UsuarioController::class);

Route::apiResource('reporte', ReporteController::class);

Route::apiResource('pqr', PqrController::class);

Route::apiResource('categoria', CategoriaController::class);

Route::apiResource('marca', MarcaController::class);

Route::apiResource('proveedor', ProveedorController::class);

Route::apiResource('producto', ProductoController::class);

Route::apiResource('inventario', InventarioController::class);

Route::apiResource('pedido', PedidoController::class);

Route::apiResource('detalle_pedido', DetallePedidoController::class);

Route::apiResource('factura', FacturaController::class);