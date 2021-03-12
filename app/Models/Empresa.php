<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    /**
     * Nombre de La Tabla que hace referencia el modelo
     *
     * @var string
     */
    protected $table = "empresas";

    /**
     * Campos permitidos en asignacion masiva
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'email', 'logo', 'website'
    ];

    /**
     * Los campos que deben ser ocultos
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * Campos Adicionales
     *
     * @var array
     */
    protected $appends = [

    ];
}
