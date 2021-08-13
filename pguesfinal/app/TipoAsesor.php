<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class TipoAsesor extends Model
{
    //

    protected $table='tipoasesores';
    protected $primaryKey='idtipoasesor';
    public $timestamps=false;

    protected $fillable=[

    	'tipoasesor',
    	'condicion',
    	'idcarrera',

    ];

    protected $guarded=[];
}

