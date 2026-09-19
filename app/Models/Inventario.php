<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventario extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'inventario';

    protected $primaryKey = 'id_inventario';

    protected $fillable = [
        'cantidad_disponible',
        'cantidad_minima',
        'id_producto',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function producto()
    {
        return $this->belongsTo(
            Producto::class,
            'id_producto',
            'id_producto'
        );
    }
}