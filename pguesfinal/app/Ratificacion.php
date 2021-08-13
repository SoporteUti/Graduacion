<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Ratificacion extends Model
{
    

    protected $table='ratificaciones';
    protected $primaryKey ='idratificaciones';
    public $timestamps = false; 
    
    protected $fillable=[
        
        'idgrupsol'];

    protected $guarded=[

    ];
}
