<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $table = 'factura';

    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha_factura',
        'total_factura',
        'impuesto',
        'estado_factura',
        'pago',
        'metodo_pago',
        'id_pedido',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido', 'id_pedido');
    }
}