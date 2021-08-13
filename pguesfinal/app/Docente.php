<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    //
     protected $table='docentes';
    protected $primaryKey ='iddocente';
    public $timestamps = false; 
    
    protected $fillable=['idcategoria','titulo','lugar','idpersona',];
    protected $guarded=[

    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'idpersona', 'idpersona');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iddocente', 'iddocente');
    }

    public function rolCarreras()
    {
        return $this->hasMany(Rol_carrera::class, 'iddocente', 'iddocente');
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
        if ($this->rolCarreras()->where('idrol',Rol::where('nombre',$role)->first()->idrol)->first()) {
            return true;
        }
        return false;
    }
}
