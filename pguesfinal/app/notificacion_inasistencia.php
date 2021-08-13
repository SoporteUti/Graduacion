<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class notificacion_inasistencia extends Model
{
    protected $table='notificacion_inasistencia';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $fillable = ['idestudiante','idsolicitud', 'condicion','idgrupsol','numero','idgrupo'];
    

   protected $guarded=[];

   

}
