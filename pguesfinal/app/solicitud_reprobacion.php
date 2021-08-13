<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class solicitud_reprobacion extends Model
{
    protected $fillable = ['idestudiante','idgrupsol','motivo'];

    protected $primaryKey = 'idalumnos_reprobacion';

    protected $table = "alumnos_reprobacion";

    public $timestamps = false;


}
