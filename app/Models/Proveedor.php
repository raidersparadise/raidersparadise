<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';
    protected $fillable = ['nit', 'nombre_proveedor', 'telefono_proveedor', 'direccion_proveedor', 'email_proveedor'];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_proveedor', 'id_proveedor');
    }
}
