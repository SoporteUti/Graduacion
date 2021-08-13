<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
     protected $table='roles';
    protected $primaryKey ='idrol';
    public $timestamps = false; 
    
    protected $fillable=['nombre',
        'condicion'];
    protected $guarded=[

    ];

    public function rolCarreras()
    {
        return $this->hasMany(Rol_carrera::class, 'idrol', 'idrol');
    }


}
