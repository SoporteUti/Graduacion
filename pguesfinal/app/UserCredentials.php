<?php

namespace sispg;

use Illuminate\Database\Eloquent\Model;

class UserCredentials extends Model
{
	protected $table='users';
    protected $primaryKey='id';
    public $timestamps=false;

    protected $fillable=[

    	'name',
    	 'email', 'password', 'idpersona'

    ];
    protected $guarded=[];
}
