<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categoria extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'categoria';

    protected $primaryKey = 'id_categoria';

    protected $fillable = [
        'nombre_categoria',
        'descripcion_categoria',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function productos()
    {
        return $this->hasMany(
            Producto::class,
            'id_categoria',
            'id_categoria'
        );
    }
}
