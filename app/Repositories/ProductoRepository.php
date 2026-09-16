<?php

namespace App\Repositories;

use App\Interfaces\ProductoInterface;
use App\Models\Producto;

class ProductoRepository extends BaseRepository implements ProductoInterface
{
    public function __construct(Producto $producto)
    {
        parent::__construct($producto);
    }

    private function relaciones()
    {
        return [
            'categoria',
            'marca',
            'proveedor',
            'inventario'
        ];
    }

    public function getAll()
    {
        return $this->model
            ->with($this->relaciones())
            ->get();
    }

    public function getById(int $id)
    {
        return $this->model
            ->with($this->relaciones())
            ->find($id);
    }

    public function create(array $datos)
    {
        return $this->model
            ->create($datos)
            ->load($this->relaciones());
    }

    public function update(array $datos, int $id)
    {
        $producto = $this->model->find($id);

        if (!$producto) {
            return null;
        }

        $producto->update($datos);

        return $producto
            ->fresh()
            ->load($this->relaciones());
    }

    public function getByNombreProducto(string $nombre_producto)
    {
        return $this->model
            ->with($this->relaciones())
            ->where(
                'nombre_producto',
                'LIKE',
                '%' . $nombre_producto . '%'
            )
            ->get();
    }

    public function getByDescripcionProducto(string $descripcion_producto)
    {
        return $this->model
            ->with($this->relaciones())
            ->where(
                'descripcion_producto',
                'LIKE',
                '%' . $descripcion_producto . '%'
            )
            ->get();
    }

    public function getByPrecioProducto(float $precio_producto)
    {
        return $this->model
            ->with($this->relaciones())
            ->where(
                'precio_producto',
                $precio_producto
            )
            ->get();
    }

    public function getByEstadoProducto(string $estado_producto)
    {
        return $this->model
            ->with($this->relaciones())
            ->where(
                'estado_producto',
                'LIKE',
                '%' . $estado_producto . '%'
            )
            ->get();
    }

    public function getByImagenProducto(string $imagen_producto)
    {
        return $this->model
            ->with($this->relaciones())
            ->where(
                'imagen_producto',
                'LIKE',
                '%' . $imagen_producto . '%'
            )
            ->get();
    }

    public function getByComentarioProducto(string $comentario_producto)
    {
        return $this->model
            ->with($this->relaciones())
            ->where(
                'comentario_producto',
                'LIKE',
                '%' . $comentario_producto . '%'
            )
            ->get();
    }

    public function getByCategoria(int $id_categoria)
    {
        return $this->model
            ->with($this->relaciones())
            ->where('id_categoria', $id_categoria)
            ->get();
    }

    public function getByMarca(int $id_marca)
    {
        return $this->model
            ->with($this->relaciones())
            ->where('id_marca', $id_marca)
            ->get();
    }

    public function getByProveedor(int $id_proveedor)
    {
        return $this->model
            ->with($this->relaciones())
            ->where('id_proveedor', $id_proveedor)
            ->get();
    }
}