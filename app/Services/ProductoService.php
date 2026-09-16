<?php

namespace App\Services;

use App\Interfaces\ProductoInterface;

class ProductoService
{
    public function __construct(
        private ProductoInterface $productoRepository
    ) {}

    public function getAll()
    {
        return $this->productoRepository->getAll();
    }

    public function getById(int $id)
    {
        return $this->productoRepository->getById($id);
    }

    public function create(array $datos)
    {
        return $this->productoRepository->create($datos);
    }

    public function update(array $datos, int $id)
    {
        return $this->productoRepository->update($datos, $id);
    }

    public function delete(int $id)
    {
        return $this->productoRepository->delete($id);
    }

    public function getByNombreProducto(string $nombre_producto)
    {
        return $this->productoRepository
            ->getByNombreProducto($nombre_producto);
    }

    public function getByDescripcionProducto(string $descripcion_producto)
    {
        return $this->productoRepository
            ->getByDescripcionProducto($descripcion_producto);
    }

    public function getByPrecioProducto(float $precio_producto)
    {
        return $this->productoRepository
            ->getByPrecioProducto($precio_producto);
    }

    public function getByEstadoProducto(string $estado_producto)
    {
        return $this->productoRepository
            ->getByEstadoProducto($estado_producto);
    }

    public function getByImagenProducto(string $imagen_producto)
    {
        return $this->productoRepository
            ->getByImagenProducto($imagen_producto);
    }

    public function getByComentarioProducto(string $comentario_producto)
    {
        return $this->productoRepository
            ->getByComentarioProducto($comentario_producto);
    }

    public function getByCategoria(int $id_categoria)
    {
        return $this->productoRepository
            ->getByCategoria($id_categoria);
    }

    public function getByMarca(int $id_marca)
    {
        return $this->productoRepository
            ->getByMarca($id_marca);
    }

    public function getByProveedor(int $id_proveedor)
    {
        return $this->productoRepository
            ->getByProveedor($id_proveedor);
    }
}