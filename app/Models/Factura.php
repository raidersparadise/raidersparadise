<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Factura extends Model
{
    use HasFactory, SoftDeletes;

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

    protected $casts = [
        'fecha_factura' => 'datetime',
        'total_factura' => 'decimal:2',
        'impuesto' => 'decimal:2',
        'pago' => 'decimal:2',
        'deleted_at' => 'datetime',
    ];

    public function pedido()
    {
        return $this->belongsTo(
            Pedido::class,
            'id_pedido',
            'id_pedido'
        );
    }
}