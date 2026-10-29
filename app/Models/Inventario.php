<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = 'inventario';
    protected $primaryKey = 'id_inventario';
    protected $fillable = ['id_producto', 'cantidad_disponible', 'cantidad_minima'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    public function getNivelAttribute(): string
    {
        if ($this->cantidad_disponible <= 0) {
            return 'agotado';
        }

        return $this->cantidad_disponible <= $this->cantidad_minima ? 'bajo' : 'ok';
    }
}
