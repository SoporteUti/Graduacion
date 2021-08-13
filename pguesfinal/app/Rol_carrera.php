<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Rol_carrera extends Model
{
    //
     protected $table='rol_carreras';
    protected $primaryKey ='idrol_carrera';
    public $timestamps = false; 
    
    protected $fillable=['iddocente',
        'idcarrera','anio','idrol','condicion'];
    protected $guarded=[

    ];


    public function docentes()
    {
        return $this->belongsToMany(Docente::class, 'iddocente', 'iddocente');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'idrol', 'idrol');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'idcarrera', 'idcarrera');
    }
}
