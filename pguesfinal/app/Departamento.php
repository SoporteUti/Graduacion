<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    

    protected $table='departamentos';
    protected $primaryKey ='iddepartamento';
    public $timestamps = false; 
    
    protected $fillable=['codigo',
        'nombre','idfacultad',
     'condicion'];
    protected $guarded=[

    ];

    public function carreras()
    {
        return $this->hasMany(Carrera::class, 'iddepartamento', 'iddepartamento');
    }

    public function docentes()
    {
        return $this->hasMany(Docente::class,'iddepartamento','iddepartamento');
    }
}
