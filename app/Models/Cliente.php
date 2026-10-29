<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'id_usuario', 'documento', 'nombre_cliente', 'apellido_cliente', 'email', 'telefono', 'direccion', 'ciudad',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'id_cliente', 'id_cliente');
    }

    public function carrito()
    {
        return $this->hasOne(Carrito::class, 'id_cliente', 'id_cliente');
    }

    public function pqrs()
    {
        return $this->hasMany(Pqr::class, 'id_cliente', 'id_cliente');
    }

    public function getNombreCompletoAttribute(): string
    {
        return trim($this->nombre_cliente.' '.$this->apellido_cliente);
    }

    /** Devuelve (o crea) el carrito activo del cliente. */
    public function carritoActivo(): Carrito
    {
        return $this->carrito()->firstOrCreate([], ['fecha_agregado' => now()->toDateString()]);
    }
}
