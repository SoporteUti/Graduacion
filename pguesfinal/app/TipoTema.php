<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class TipoTema extends Model
{
    //

    protected $table='tipotemas';
    protected $primaryKey='idtipotema';
    public $timestamps=false;

    protected $fillable=[

    	'tema',
    	'condicion',
    	'idcarrera',
    	'idtipotema'

    ];

    protected $guarded=[];

    public function nuevaetapas()
    {
        return $this->HasMany(nuevaetapa::class, 'idtipotrabajo', 'idtipotema');
    }

    public function carrera()
    {
        return $this->belongsTo('sispg\Carrera');
    }

    public function grupo()
    {
        return $this->hasOne(Grupo::class, 'idtipotema', 'idtipotema');
    }
}

