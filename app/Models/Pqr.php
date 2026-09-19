<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pqr extends Model
{
    use SoftDeletes;

    protected $table = 'pqr';

    protected $primaryKey = 'id_pqr';

    public $timestamps = false;

    protected $fillable = [
        'id_usuario',
        'id_cliente',
        'descripcion_pqr',
        'estado',
        'fecha',
    ];

    public function usuario()
    {
        return $this->belongsTo(
            Usuario::class,
            'id_usuario',
            'id_usuario'
        );
    }

    public function cliente()
    {
        return $this->belongsTo(
            Cliente::class,
            'id_cliente',
            'id_cliente'
        );
    }
}