<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class GrupoDocente extends Model
{
    //

    protected $table='grupos_docentes';
    protected $primaryKey='idgrudoc';
    public $timestamps=false;

    protected $fillable=[

    	'iddocente',
    	'idtipoasesor',
    	'idgrupo'

    ];

    protected $guarded=[];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'idgrupo', 'idgrupo');
    }
}

