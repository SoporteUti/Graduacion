<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //
    protected $table='categorias';
    protected $primaryKey='idcategoria';
    public $timestamps=false;

    protected $fillable=[

    	'nombrecat',
    	'condicion'

    ];

    protected $guarded=[];
}
