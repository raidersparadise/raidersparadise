<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Marca;
use App\Models\Proveedor;
use App\Models\Inventario;
use Illuminate\Database\Eloquent\Relations\HasOne;


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
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marca');
    }
    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }
    public function inventario(): HasOne
    {
        return $this->hasOne(
        Inventario::class,
        'id_producto',
        'id_producto'
        );
    }

}