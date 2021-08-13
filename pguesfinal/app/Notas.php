<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    //

    protected $table='notas';
    protected $primaryKey='idnotas';
    public $timestamps=false;

    protected $fillable=[

    	'idgrupo',
    	'idestudiante',
    	'nota',
    	'idetapa',
    	'condicion'

    ];

    protected $guarded=[];
}

