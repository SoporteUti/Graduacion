<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Prorrogai extends Model
{
    

    protected $table='prorrogai';
    protected $primaryKey ='idprorrogai';
    public $timestamps = false; 
    
    protected $fillable=[
        'fechaInicio',
        'fechaFinal',
        'motivo',
        'idgrupsol'];

    protected $guarded=[

    ];
}
