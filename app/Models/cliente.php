<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    
    protected $table = 'cliente';

    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'nombre_cliente',
        'apellido_cliente',
        'email',
        'telefono',
        'direccion',
    ];
}
