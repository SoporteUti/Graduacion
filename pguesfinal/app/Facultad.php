<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Facultad extends Model
{
    //

    protected $table='facultades';
    protected $primaryKey='idfacultad';
    public $timestamps=false;

    protected $fillable=[

        'codigo',
    	'nombre',
    	//'decano',
    	'telefono',
    	'direccion',
    	'condicion'

    ];

    protected $guarded=[];
}

