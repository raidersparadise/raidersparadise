<?php

namespace App\Interfaces;

interface ProductoInterface extends BaseInterface
{
    public function getByNombreProducto(string $nombre_producto);

    public function getByDescripcionProducto(string $descripcion_producto);

    public function getByPrecioProducto(float $precio_producto);

    public function getByEstadoProducto(string $estado_producto);

    public function getByImagenProducto(string $imagen_producto);

    public function getByComentarioProducto(string $comentario_producto);

    public function getByCategoria(int $id_categoria);

    public function getByMarca(int $id_marca);

    public function getByProveedor(int $id_proveedor);
}
