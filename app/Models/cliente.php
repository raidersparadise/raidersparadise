<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cliente';

    protected $primaryKey = 'id_cliente';

    public $timestamps = false;

    protected $fillable = [
        'nombre_cliente',
        'apellido_cliente',
        'email_cliente',
        'telefono_cliente',
        'direccion_cliente',
    ];
}