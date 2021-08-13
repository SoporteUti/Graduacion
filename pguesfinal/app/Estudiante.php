<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    

    protected $table='estudiantes';
    protected $primaryKey ='idestudiante';
    public $timestamps = false; 
    
    protected $fillable=['idestudiante','carnet',
        'idcarrera','anioegreso','pera','horassoc','curriculum','partida','idpersona','carta','ciclo'];
    protected $guarded=[

    ];

   public function persona()
    {
        return $this->belongsTo(Persona::class, 'idpersona', 'idpersona');
    }

    public function alumno_asistencia()
    {
        return $this->hasOne(AlumnoAsistencia::class, 'idestudiante', 'idestudiante');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'idcarrera', 'idcarrera');
    }

    public function estudiante_grupo()
    {
        return $this->hasOne('sispg\EstudianteGrupos', 'idestudiante', 'idestudiante');
    }

    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401);
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }
   
    public function hasRole($role)
    {

        // if ($this->rolCarreras()->where('idrol',Rol::where('nombre',$role)->first()->idrol)->first()) {
        //     return true;
        // }
        return Rol::where('nombre',$role)->first()->idrol === $this->persona->user->idrol;
    }
}
