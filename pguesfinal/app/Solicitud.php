<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table='solicitudes';
    protected $primaryKey='idsolicitud';
    public $timestamps=false;

    protected $fillable=[
    	
    	'nombre','condicion','idsolicitud'
        
    ];

    protected $guarded=[];

   public function grupo_solicitud()
    {
        return $this->hasOne(grupo_solicitud::class, 'idsolicitud', 'idsolicitud');
    }

}
