<?php

namespace App\Http\Controllers;

use App\Services\ProductoService;
use App\Http\Requests\Producto\StoreProductoRequest;
use App\Http\Requests\Producto\UpdateProductoRequest;

class ProductoController extends Controller
{
    protected $productoService;

    public function __construct(ProductoService $productoService)
    {
        $this->productoService = $productoService;
    }

    /**
     * Listar todos los productos.
     */
    public function index()
    {
        $productos = $this->productoService->getAll();

        return response()->json([
            'success' => 'Productos consultados correctamente',
            'data' => $productos
        ], 200);
    }

    /**
     * Crear un nuevo producto.
     */
    public function store(StoreProductoRequest $datos)
    {
        $producto = $this->productoService->create(
            $datos->validated()
        );

        return response()->json([
            'success' => 'Producto creado correctamente',
            'datosInsertado' => $producto
        ], 201);
    }

    /**
     * Consultar un producto por ID.
     */
    public function show(int $id)
    {
        $producto = $this->productoService->getById($id);

        return response()->json([
            'success' => 'Producto encontrado correctamente',
            'data' => $producto
        ], 200);
    }

    /**
     * Actualizar un producto.
     */
    public function update(UpdateProductoRequest $datosActualizar, int $id)
    {
        $producto = $this->productoService->update(
            $datosActualizar->validated(),
            $id
        );

        return response()->json([
            'success' => 'Producto actualizado correctamente',
            'data' => $producto
        ], 200);
    }

    /**
     * Eliminar un producto.
     */
    public function destroy(int $id)
    {
        $this->productoService->delete($id);

        return response()->json([
            'success' => 'Producto eliminado correctamente'
        ], 200);
    }

    /**
     * Buscar productos por nombre.
     */
    public function getByNombreProducto(string $nombre_producto)
    {
        $productos = $this->productoService
            ->getByNombreProducto($nombre_producto);

        return response()->json([
            'success' => 'Productos filtrados por nombre correctamente',
            'data' => $productos
        ], 200);
    }

    /**
     * Buscar productos por descripción.
     */
    public function getByDescripcionProducto(string $descripcion_producto)
    {
        $productos = $this->productoService
            ->getByDescripcionProducto($descripcion_producto);

        return response()->json([
            'success' => 'Productos filtrados por descripción correctamente',
            'data' => $productos
        ], 200);
    }

    /**
     * Buscar productos por precio.
     */
    public function getByPrecioProducto(float $precio_producto)
    {
        $productos = $this->productoService
            ->getByPrecioProducto($precio_producto);

        return response()->json([
            'success' => 'Productos filtrados por precio correctamente',
            'data' => $productos
        ], 200);
    }

    /**
     * Buscar productos por estado.
     */
    public function getByEstadoProducto(string $estado_producto)
    {
        $productos = $this->productoService
            ->getByEstadoProducto($estado_producto);

        return response()->json([
            'success' => 'Productos filtrados por estado correctamente',
            'data' => $productos
        ], 200);
    }

    /**
     * Buscar productos por imagen.
     */
    public function getByImagenProducto(string $imagen_producto)
    {
        $productos = $this->productoService
            ->getByImagenProducto($imagen_producto);

        return response()->json([
            'success' => 'Productos filtrados por imagen correctamente',
            'data' => $productos
        ], 200);
    }

    /**
     * Buscar productos por comentario.
     */
    public function getByComentarioProducto(string $comentario_producto)
    {
        $productos = $this->productoService
            ->getByComentarioProducto($comentario_producto);

        return response()->json([
            'success' => 'Productos filtrados por comentario correctamente',
            'data' => $productos
        ], 200);
    }

    /**
     * Buscar productos por categoría.
     */
    public function getByCategoria(int $id_categoria)
    {
        $productos = $this->productoService
            ->getByCategoria($id_categoria);

        return response()->json([
            'success' => 'Productos filtrados por categoría correctamente',
            'data' => $productos
        ], 200);
    }

    /**
     * Buscar productos por marca.
     */
    public function getByMarca(int $id_marca)
    {
        $productos = $this->productoService
            ->getByMarca($id_marca);

        return response()->json([
            'success' => 'Productos filtrados por marca correctamente',
            'data' => $productos
        ], 200);
    }

    /**
     * Buscar productos por proveedor.
     */
    public function getByProveedor(int $id_proveedor)
    {
        $productos = $this->productoService
            ->getByProveedor($id_proveedor);

        return response()->json([
            'success' => 'Productos filtrados por proveedor correctamente',
            'data' => $productos
        ], 200);
    }
}