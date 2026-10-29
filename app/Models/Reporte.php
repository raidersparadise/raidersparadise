<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    protected $table = 'reporte';
    protected $primaryKey = 'id_reporte';
    protected $fillable = ['id_usuario', 'tipo_reporte', 'formato', 'fecha_desde', 'fecha_hasta', 'fecha_generacion'];

    protected $casts = ['fecha_desde' => 'date', 'fecha_hasta' => 'date', 'fecha_generacion' => 'datetime'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
