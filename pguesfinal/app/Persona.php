<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    

    protected $table='personas';
    protected $primaryKey ='idpersona';
    public $timestamps = false; 
    
    protected $fillable=['nombres',
        'apellidos',
     'condicion','sexo','fechanac','direccion','correo','dui', 'telefono','tipo'];
    protected $guarded=[

    ];


    protected $appends = ['full_name'];

    public function getFullNameAttribute()
    {
        return "{$this->nombres} {$this->apellidos}"; 
    }

    public function user()
    {
        return $this->hasOne(User::class, 'idpersona', 'idpersona');
    }

    public function docente()
    {
        return $this->hasOne(Docente::class, 'idpersona', 'idpersona');
    }

    public function estudiante()
    {
        return $this->hasOne(Estudiante::class, 'idpersona', 'idpersona');
    }

    public function getFotoAssetAttribute(){

        return "storage/fotos/{$this->foto_url}";
    }
}
