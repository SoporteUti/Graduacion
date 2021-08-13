<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class EstudianteGrupos extends Model
{
    //

    protected $table='estudiante_grupos';
    protected $primaryKey='idestgru';
    public $timestamps=false;

    protected $fillable=[

    	'idestudiante',
    	'idgrupo'

    ];

    protected $guarded=[];

    public function estudiante()
    {
        return $this->belongsTo('sispg\Estudiante','idestudiante');
    }

    public function grupo()
    {
        return $this->belongsTo('sispg\Grupo', 'idgrupo');
    }}

