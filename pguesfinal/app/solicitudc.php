<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class solicitudc extends Model
{
    //

    protected $table='solicitudes_c';
    protected $primaryKey='id';
    public $timestamps=false;

    protected $fillable=[

    	'motivo',
    	'condicion',
    	'idgrupsol'

    ];

    protected $guarded=[];
}

