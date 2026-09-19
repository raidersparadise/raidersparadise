<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rol extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'rol';

    protected $primaryKey = 'id_rol';

    protected $fillable = [
        'nombre_rol',
        'descripcion',
    ];

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    public function usuarios()
    {
        return $this->hasMany(
            Usuario::class,
            'id_rol',
            'id_rol'
        );
    }
}
//intento 2