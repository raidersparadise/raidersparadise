<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Modelo de autenticación del sistema. Reemplaza al User por defecto de Laravel
 * y trabaja sobre la tabla "usuario" definida por el equipo.
 */
class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'id_rol', 'nombre_usuario', 'apellido_usuario', 'email', 'password', 'telefono', 'activo',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'activo' => 'boolean',
        ];
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'id_usuario', 'id_usuario');
    }

    public function reportes()
    {
        return $this->hasMany(Reporte::class, 'id_usuario', 'id_usuario');
    }

    /** Devuelve el registro de cliente de este usuario, creándolo o enlazándolo si hace falta. */
    public function clienteAsociado(): Cliente
    {
        if ($this->cliente) {
            return $this->cliente;
        }
        $cliente = Cliente::firstOrNew(['email' => $this->email]);
        $cliente->fill([
            'id_usuario' => $this->id_usuario,
            'nombre_cliente' => $cliente->nombre_cliente ?: $this->nombre_usuario,
            'apellido_cliente' => $cliente->apellido_cliente ?: $this->apellido_usuario,
            'telefono' => $cliente->telefono ?: $this->telefono,
        ])->save();
        $this->setRelation('cliente', $cliente);

        return $cliente;
    }

    public function getNombreCompletoAttribute(): string
    {
        return trim($this->nombre_usuario.' '.$this->apellido_usuario);
    }

    public function getInicialesAttribute(): string
    {
        return mb_strtoupper(mb_substr($this->nombre_usuario, 0, 1).mb_substr($this->apellido_usuario, 0, 1));
    }

    public function tieneRol(string ...$roles): bool
    {
        return in_array($this->rol?->nombre_rol, $roles, true);
    }

    public function esAdmin(): bool
    {
        return $this->tieneRol(Rol::ADMIN);
    }

    public function esPersonal(): bool
    {
        return $this->tieneRol(Rol::ADMIN, Rol::VENDEDOR);
    }
}
