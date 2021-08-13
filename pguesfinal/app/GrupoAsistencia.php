<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class GrupoAsistencia extends Model
{
    protected $table='grupo_asistencia';
    protected $fillable = ['id','idgrupo','fecha_asistencia','hora_inicio','hora_final'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'idgrupo', 'idgrupo');
    }

    public function alumnos_asistencia()
    {
        return $this->hasMany(AlumnoAsistencia::class,'idgrupo');
    }
}
