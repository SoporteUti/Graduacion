<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Ponderacion extends Model
{
    

    protected $table='ponderacion';
    protected $primaryKey='idponderacion';
    public $timestamps=false;

    protected $fillable=[

    	'idponderacion',
    	'idetapa',
    	'porcentaje'

    ];

    protected $guarded=[];

}
