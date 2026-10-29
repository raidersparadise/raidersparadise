<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pqr extends Model
{
    public const TIPOS = ['peticion' => 'Petición', 'queja' => 'Queja', 'reclamo' => 'Reclamo', 'sugerencia' => 'Sugerencia'];
    public const ESTADOS = ['recibida', 'asignada', 'en proceso', 'requerido', 'cerrada', 'rechazada'];

    protected $table = 'pqr';
    protected $primaryKey = 'id_pqr';
    protected $fillable = ['id_usuario', 'id_cliente', 'tipo', 'asunto', 'descripcion_pqr', 'estado', 'respuesta', 'fecha', 'fecha_cierre'];

    protected $casts = ['fecha' => 'date', 'fecha_cierre' => 'datetime'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }

    public function responsable()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }

    public function getTipoTextoAttribute(): string
    {
        return self::TIPOS[$this->tipo] ?? $this->tipo;
    }

    public function getRadicadoAttribute(): string
    {
        return 'PQR-'.str_pad((string) $this->id_pqr, 4, '0', STR_PAD_LEFT);
    }
}
