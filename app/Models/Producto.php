<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'producto';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'id_categoria', 'id_marca', 'id_proveedor', 'sku', 'nombre_producto', 'descripcion_producto',
        'precio_producto', 'estado_producto', 'destacado', 'imagen_producto', 'comentario_producto',
    ];

    protected $casts = [
        'precio_producto' => 'decimal:2',
        'destacado' => 'boolean',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id_marca');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor', 'id_proveedor');
    }

    public function inventario()
    {
        return $this->hasOne(Inventario::class, 'id_producto', 'id_producto');
    }

    public function detallesPedido()
    {
        return $this->hasMany(DetallePedido::class, 'id_producto', 'id_producto');
    }

    public function scopeActivos(Builder $q): Builder
    {
        return $q->where('estado_producto', 'activo');
    }

    public function getStockAttribute(): int
    {
        return (int) ($this->inventario->cantidad_disponible ?? 0);
    }

    public function getDisponibleAttribute(): bool
    {
        return $this->estado_producto === 'activo' && $this->stock > 0;
    }

    /** URL pública de la imagen (soporta imágenes de muestra y archivos subidos). */
    public function getImagenUrlAttribute(): string
    {
        $img = $this->imagen_producto;
        if (! $img) {
            return asset('images/productos/generico.svg');
        }
        if (str_starts_with($img, 'http')) {
            return $img;
        }

        return asset($img);
    }
}
