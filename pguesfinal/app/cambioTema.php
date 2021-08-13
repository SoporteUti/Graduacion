<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class cambioTema extends Model
{
    

    protected $table='cambio_tema';
    protected $primaryKey ='idcambiotema';
    public $timestamps = false; 
    
    protected $fillable=[
        'nuevotema',
        'motivo',
        'idgrupsol'];

    protected $guarded=[

    ];
}
