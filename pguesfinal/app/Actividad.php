<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    //

    protected $table='actividades';
    protected $primaryKey='idactividad';
    public $timestamps=false;

    protected $fillable=[

    	'nombre',
    	'condicion'

    ];

    protected $guarded=[];
}

