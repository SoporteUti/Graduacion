<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $table='periodos';
    protected $primaryKey ='idperiodo';
    public $timestamps = false; 
    
    protected $fillable=[
        'idperiodo',
        'idgrupo',
        'fInicio',
        'fFin'];

    protected $guarded=[

    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'idgrupo', 'idgrupo');
    }

    public function fechas()
    {
        return $this->hasMany(Fecha::class, 'idperiodo', 'idperiodo');
    }

}
