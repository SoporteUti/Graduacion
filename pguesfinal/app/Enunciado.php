<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Enunciado extends Model
{
    //

    protected $table='enunciado';
    protected $primaryKey='id';
    public $timestamps=false;

    protected $fillable=[

    	'enunciado',
	'idsolicitud',
	'idrol',
    	'condicion'

    ];

    protected $guarded=[];
}

