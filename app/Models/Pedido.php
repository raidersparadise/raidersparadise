<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public const ESTADOS = [
        'pendiente' => 'Pendiente',
        'programado' => 'Programado',
        'en_curso' => 'En camino',
        'entregado' => 'Entregado',
        'cancelado' => 'Cancelado',
    ];

    protected $table = 'pedido';
    protected $primaryKey = 'id_pedido';
    protected $fillable = ['id_cliente', 'fecha', 'estado', 'total', 'direccion_envio', 'ciudad_envio', 'notas'];

    protected $casts = [
        'fecha' => 'datetime',
        'total' => 'decimal:2',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function detalles()
    {
        return $this->hasMany(DetallePedido::class, 'id_pedido', 'id_pedido');
    }

    public function factura()
    {
        return $this->hasOne(Factura::class, 'id_pedido', 'id_pedido');
    }

    public function getEstadoTextoAttribute(): string
    {
        return self::ESTADOS[$this->estado] ?? ucfirst($this->estado);
    }

    public function getCodigoAttribute(): string
    {
        return 'RP-'.str_pad((string) $this->id_pedido, 5, '0', STR_PAD_LEFT);
    }
}
