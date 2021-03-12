<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    /**
     * Nombre de La Tabla que hace referencia el modelo
     *
     * @var string
     */
    protected $table = "empleados";

    /**
     * Campos permitidos en asignacion masiva
     *
     * @var array
     */
    protected $fillable = [
        'nombres', 'apellidos', 'empresa_id', 'email', 'telefono'
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
        'full_name'
    ];

    /**
     * Mutator para nombres
     *
     * @param [type] $value
     * @return void
     */
    public function setNombresAttribute($value)
	{
    	$this->attributes['nombres'] = ucwords(strtolower($value));
	}

    /**
     * Mutator Para Apellidos
     *
     * @param [type] $value
     * @return void
     */
    public function setApellidosAttribute($value)
	{
    	$this->attributes['apellidos'] = ucwords(strtolower($value));
	}

    /**
     * Accesor para Nombre Completo
     *
     * @return void
     */
    public function getFullNameAttribute()
    {
        return $this->nombres . ' ' . $this->apellidos;
    }
}
