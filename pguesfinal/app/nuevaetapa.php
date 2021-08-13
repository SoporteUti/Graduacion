<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class nuevaetapa extends Model
{
    protected $table='nuevaetapa';
    protected $primaryKey='idnuevaetapa';
    public $timestamps=false;

    protected $fillable=[
    	
    	'idtipotrabajo','idetapa','idnombreetapa','idnuevaetapa','condicion'
        
    ];

    protected $guarded=[];


    public function tipotemas()
    {
        return $this->belongsTo(TipoTema::class, 'idtipotrabajo', 'idtipotema');
    }

    public function ponderacion()
    {
        return $this->hasOne(Ponderacion::class, 'idetapa', 'idnuevaetapa');
    }
}
