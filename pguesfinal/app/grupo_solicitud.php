<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class grupo_solicitud extends Model
{
    //

    protected $table='grupo_solicitud';
    protected $primaryKey='idgrupsol';
    public $timestamps=false;

    protected $fillable=[

    	'idsolicitud',
    	'idgrupo',
    	'estado',
    	'pdf',
        'nacuerdo',
    	'condicion',
    	'etapa',
    	'fecha',
        'aprobado',
        'solicitudcoor',
        'solicituddir'

    ];

    protected $guarded=[];

   public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'idgrupo', 'idgrupo');
    }

    public function solicitud()
    {
        return $this->belongsTo(Solicitud::class, 'idsolicitud', 'idsolicitud');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'estado', 'idrol');
    }

}

