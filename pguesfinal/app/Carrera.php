<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    //

    protected $table='carreras';
    protected $primaryKey='idcarrera';
    public $timestamps=false;

    protected $fillable=[

    	'nombre',
    	'iddepartamento',
        'codigo',
        'motivo',
        'fechadebaja',
        'acuerdoBaja',
    	'condicion',
        'idcarrera'

    ];

    protected $guarded=[];

    public function tipotema()
    {
        return $this->hasMany('sispg\TipoTema');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'iddepartamento', 'iddepartamento');
    }

    public function rolCarreras()
    {
        return $this->hasMany(Rol_carrera::class, 'idcarrera', 'idcarrera');
    }

    public function estudiantes()
    {
        return $this->hasOne(Estudiante::class, 'idcarrera', 'idcarrera');
    }
}

