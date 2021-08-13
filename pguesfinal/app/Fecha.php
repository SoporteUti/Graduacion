<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    protected $table='fechas';
    protected $primaryKey ='idfecha';
    public $timestamps = false; 
    
    protected $fillable=[
        'idfecha',
        'idperiodo',
        'idnuevaetapa',
        'fechasetapas',
        'condicion'];

    protected $guarded=[

    ];

    public function periodo()
    {
        return $this->belongsTo(Periodo::class, 'idperiodo', 'idperiodo');
    }

    public function etapa()
    {
        return $this->belongsTo(nuevaetapa::class, 'idnuevaetapa', 'idnuevaetapa');
    }
}
