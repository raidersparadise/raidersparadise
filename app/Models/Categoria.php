<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';
    protected $fillable = ['nombre_categoria', 'descripcion_categoria'];

    // Nota: el modelo original referenciaba Producto::class, que no existía. Ya fue creado.
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria', 'id_categoria');
    }
}
