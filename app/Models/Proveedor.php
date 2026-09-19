<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'proveedor';

    protected $primaryKey = 'id_proveedor';

    protected $fillable = [
        'nombre_proveedor',
        'telefono_proveedor',
        'direccion_proveedor',
        'email_proveedor',
    ];

    public function productos()
    {
        return $this->hasMany(
            Producto::class,
            'id_proveedor',
            'id_proveedor'
        );
    }
}
