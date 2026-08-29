<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleCarrito extends Model
{
    protected $table = 'detalle_carrito';

    protected $primaryKey = 'id_detalle_carrito';

    protected $fillable = [
        'id_carrito',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function carrito()
    {
        return $this->belongsTo(Carrito::class, 'id_carrito', 'id_carrito');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}