<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito';
    protected $primaryKey = 'id_carrito';
    protected $fillable = ['id_cliente', 'fecha_agregado'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function detalles()
    {
        return $this->hasMany(DetalleCarrito::class, 'id_carrito', 'id_carrito');
    }

    public function getTotalAttribute(): float
    {
        return (float) $this->detalles->sum('subtotal');
    }

    public function getCantidadItemsAttribute(): int
    {
        return (int) $this->detalles->sum('cantidad');
    }
}
