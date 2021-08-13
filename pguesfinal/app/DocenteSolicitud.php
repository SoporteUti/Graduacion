<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class DocenteSolicitud extends Model
{
    protected $fillable = ['iddocentes_tribunal','iddocente','idgrupsol'];

    protected $primaryKey = 'iddocentes_tribunal';

    protected $table = "docentes_tribunal";

    public $timestamps = false;


    public function docente()
    {
        return $this->hasOne(Docente::class, 'iddocente', 'iddocente');
    }


    public function grupo()
    {
        return $this->belongsTo(Docente::class, 'idgrupsol', 'idgrupo');

        //la primera es foranea y la otra es pk local respectivamente
    }
}
