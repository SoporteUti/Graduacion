<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Prorrogajd extends Model
{
    

    protected $table='prorrogajd';
    protected $primaryKey ='idprorrogajd';
    public $timestamps = false; 
    
    protected $fillable=[
        
       
        'motivo',
        'idgrupsol'];

    protected $guarded=[

    ];
}
