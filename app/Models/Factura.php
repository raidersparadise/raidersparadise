<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    public const IVA = 0.19;

    public const METODOS_PAGO = [
        'nequi' => 'Nequi',
        'pse' => 'PSE',
        'tarjeta' => 'Tarjeta crédito / débito',
        'contraentrega' => 'Pago contra entrega',
    ];

    protected $table = 'factura';
    protected $primaryKey = 'id_factura';
    protected $fillable = [
        'id_pedido', 'numero_factura', 'fecha_factura', 'subtotal', 'impuesto', 'total_factura',
        'estado_factura', 'pago', 'metodo_pago',
    ];

    protected $casts = ['fecha_factura' => 'datetime'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id_pedido');
    }

    public function getMetodoPagoTextoAttribute(): string
    {
        return self::METODOS_PAGO[$this->metodo_pago] ?? $this->metodo_pago;
    }
}
