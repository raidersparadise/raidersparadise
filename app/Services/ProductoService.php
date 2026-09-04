<?php

namespace App\Services;

use App\Interfaces\ProductoInterface;
use App\Models\Producto;

class ProductoService implements ProductoInterface
{
    // Obtener todos los productos
    public function getAll()
    {
        return Producto::with([
            'categoria',
            'marca',
            'proveedor',
            'inventario'
        ])->get();
    }

    // Obtener producto por ID
    public function getById(int $id)
    {
        return Producto::with([
            'categoria',
            'marca',
            'proveedor',
            'inventario'
        ])->findOrFail($id);
    }

    // Crear un producto
    public function create(array $datos)
    {
        return Producto::create($datos);
    }

    // Actualizar un producto
    public function update(array $datos, int $id)
    {
        $producto = Producto::findOrFail($id);

        $producto->update($datos);

        return $producto->load([
            'categoria',
            'marca',
            'proveedor',
            'inventario'
        ]);
    }

    // Eliminar un producto
    public function delete(int $id)
    {
        $producto = Producto::findOrFail($id);

        $producto->delete();

        return true;
    }

    // Buscar productos por nombre
    public function getByNombreProducto(string $nombre_producto)
    {
        return Producto::with([
            'categoria',
            'marca',
            'proveedor',
            'inventario'
        ])
        ->where(
            'nombre_producto',
            'LIKE',
            '%' . $nombre_producto . '%'
        )
        ->get();
    }

    // Buscar productos por descripción
    public function getByDescripcionProducto(string $descripcion_producto)
    {
        return Producto::where(
            'descripcion_producto',
            'LIKE',
            '%' . $descripcion_producto . '%'
        )->get();
    }

    // Buscar productos por precio
    public function getByPrecioProducto(float $precio_producto)
    {
        return Producto::where(
            'precio_producto',
            $precio_producto
        )->get();
    }

    // Buscar productos por estado
    public function getByEstadoProducto(string $estado_producto)
    {
        return Producto::where(
            'estado_producto',
            'LIKE',
            '%' . $estado_producto . '%'
        )->get();
    }

    // Buscar productos por imagen
    public function getByImagenProducto(string $imagen_producto)
    {
        return Producto::where(
            'imagen_producto',
            'LIKE',
            '%' . $imagen_producto . '%'
        )->get();
    }

    // Buscar productos por comentario
    public function getByComentarioProducto(string $comentario_producto)
    {
        return Producto::where(
            'comentario_producto',
            'LIKE',
            '%' . $comentario_producto . '%'
        )->get();
    }

    // Buscar productos por categoría
    public function getByCategoria(int $id_categoria)
    {
        return Producto::with([
            'categoria',
            'marca',
            'proveedor',
            'inventario'
        ])
        ->where('id_categoria', $id_categoria)
        ->get();
    }

    // Buscar productos por marca
    public function getByMarca(int $id_marca)
    {
        return Producto::with([
            'categoria',
            'marca',
            'proveedor',
            'inventario'
        ])
        ->where('id_marca', $id_marca)
        ->get();
    }

    // Buscar productos por proveedor
    public function getByProveedor(int $id_proveedor)
    {
        return Producto::with([
            'categoria',
            'marca',
            'proveedor',
            'inventario'
        ])
        ->where('id_proveedor', $id_proveedor)
        ->get();
    }
}