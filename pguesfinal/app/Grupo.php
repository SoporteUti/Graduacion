<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Grupo extends Model
{
    

    protected $table='grupos';
    protected $primaryKey ='idgrupo';
    public $timestamps = false; 
    
    protected $fillable=['codigoG',
        'tema',
        'idtipotema',
        'fecharegistro',
        'condicion', 
        'propuesta',
        'carta',
         'idcarrera',
         'idgrupo'];

    protected $guarded=[

    ];

   protected $appends=[
        'year_registry'
    ];

    public function getYearRegistryAttribute(){
        return Carbon::createFromFormat('Y-m-d',$this->fecharegistro)->year;
    }

    public function docente_tribunal()
    {
        return $this->hasMany(DocenteSolicitud::class, 'idgrupsol', 'idgrupo');
    }

    public function carrera()
    {
        return $this->hasOne(Carrera::class, 'idcarrera', 'idcarrera');
    }
 public function departamento()
    {
        return $this->hasOne(Departamento::class, 'iddepartamento', 'iddepartamento');
    }

    public function estudiantes_grupo()
    {
        return $this->hasMany('sispg\EstudianteGrupos', 'idgrupo', 'idgrupo');
    }

    public function grupo_solicitud()
    {
        return $this->hasMany(grupo_solicitud::class, 'idgrupo', 'idgrupo');
    }

    public function grupo_docente()
    {
        return $this->hasOne(GrupoDocente::class, 'idgrupo', 'idgrupo');
    }

    public function grupo_asistencia()
    {
        return $this->hasMany(GrupoAsistencia::class, 'idgrupo', 'idgrupo');
    }

    public function periodo()
    {
        return $this->hasOne(Periodo::class, 'idgrupo', 'idgrupo');
    }

    public function grupo_etapas()
    {
        return $this->hasMany(etapas_grupos::class, 'idgrupo', 'idgrupo');
    }

    public function tema_grupo()
    {
        return $this->belongsTo(TipoTema::class, 'idtipotema', 'idtipotema');
    }



}
