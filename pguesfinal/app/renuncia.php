<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class renuncia extends Model
{
    //

    protected $table='est_renuncia';
    protected $primaryKey='id_est_renuncia';
    public $timestamps=false;

    protected $fillable=[

    
    	'idestudiante',
    	'idgrupsol',
    	
    	'condicion'

    ];

    protected $guarded=[];
}

