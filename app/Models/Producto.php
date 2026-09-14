<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    protected $fillable = [
        'id_categoria',
        'id_marca',
        'id_proveedor',
        'nombre_producto',
        'descripcion_producto',
        'precio_producto',
        'estado_producto',
        'imagen_producto',
        'comentario_producto',
    ];
}