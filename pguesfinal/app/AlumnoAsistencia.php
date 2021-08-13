<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class AlumnoAsistencia extends Model
{
    protected $table='alumno_asistencias';
    protected $fillable = ['id','grupo_asistencia_id','idestudiante','asistencia'];
    
    protected $cast = ['asistencia'=>'boolean'];
    
  /*  public function setAsistenciaAttribute($value)
    {
        $this->asistencia = ($value==='')?false:$value;
    }*/

    public function grupo_asistencia()
    {
        return $this->belongsTo(GrupoAsistencia::class, 'grupo_asistencia_id');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'idestudiante', 'idestudiante');
    }

}
