<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public const ADMIN = 'Administrador';
    public const VENDEDOR = 'Vendedor';
    public const CLIENTE = 'Cliente';

    protected $table = 'rol';
    protected $primaryKey = 'id_rol';
    protected $fillable = ['nombre_rol', 'descripcion'];

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'id_rol', 'id_rol');
    }
}
