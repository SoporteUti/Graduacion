<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class etapas_grupos extends Model
{
    //

    protected $table='etapas_grupos';
    protected $primaryKey='idetapa_grupo';
    public $timestamps=false;

    protected $fillable=[

    	'idetapa_grupo',
    	'idgrupo',
    	'idnuevaetapa',
    	'estado',
    	'condicion'

    ];

    protected $guarded=[];


    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'idgrupo', 'idgrupo');
    }
}
