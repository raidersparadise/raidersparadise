<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['id_producto' => 1, 'id_categoria' => 1, 'id_marca' => 1, 'id_proveedor' => 1, 'nombre_producto' => 'Camiseta Raiders Negra', 'descripcion_producto' => 'Camiseta oficial de algodon.', 'precio_producto' => 45000, 'estado_producto' => 'activo', 'imagen_producto' => 'https://example.com/camiseta-negra.jpg', 'comentario_producto' => 'Tallas S a XL'],
            ['id_producto' => 2, 'id_categoria' => 2, 'id_marca' => 3, 'id_proveedor' => 3, 'nombre_producto' => 'Gorra Raiders Clasica', 'descripcion_producto' => 'Gorra ajustable con escudo bordado.', 'precio_producto' => 65000, 'estado_producto' => 'activo', 'imagen_producto' => 'https://example.com/gorra.jpg', 'comentario_producto' => 'Color negro'],
            ['id_producto' => 3, 'id_categoria' => 3, 'id_marca' => 4, 'id_proveedor' => 2, 'nombre_producto' => 'Chaqueta Raiders', 'descripcion_producto' => 'Chaqueta deportiva impermeable.', 'precio_producto' => 180000, 'estado_producto' => 'activo', 'imagen_producto' => 'https://example.com/chaqueta.jpg', 'comentario_producto' => 'Edicion limitada'],
            ['id_producto' => 4, 'id_categoria' => 4, 'id_marca' => 2, 'id_proveedor' => 4, 'nombre_producto' => 'Jogger Deportivo', 'descripcion_producto' => 'Jogger comodo para entrenamiento.', 'precio_producto' => 95000, 'estado_producto' => 'activo', 'imagen_producto' => 'https://example.com/jogger.jpg', 'comentario_producto' => 'Tallas M y L'],
            ['id_producto' => 5, 'id_categoria' => 5, 'id_marca' => 5, 'id_proveedor' => 5, 'nombre_producto' => 'Llavero Raiders', 'descripcion_producto' => 'Llavero metalico con escudo oficial.', 'precio_producto' => 20000, 'estado_producto' => 'activo', 'imagen_producto' => 'https://example.com/llavero.jpg', 'comentario_producto' => 'Producto nuevo'],
        ];

        foreach ($products as $product) {
            DB::table('producto')->updateOrInsert(['id_producto' => $product['id_producto']], $product);
        }
    }
}