<?php

use Illuminate\Database\Seeder;
use sispg\Persona;
use sispg\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$persona = Persona::create([
    		'nombres'=>"Julio",
    		'apellidos'=>'Perez',
    		'condicion'=>true,
    		'sexo'=>1,
    		'fechanac'=>"1996-11-14",
    		'direccion'=>"San Vicente",
    		'correo'=>"julio@dreux.com",
    		'dui'=>"12345678-9",
    		'telefono'=>"1234-1234",
    		'tipo'=>"docente"
    	]);   

    	$user = User::create(['name'=>"Julio",
    		'email'=>"julio@dreux.com",
    		'password'=>bcrypt('admin123'),
    		'idpersona'=>$persona->id
    	]);

    
    }
}
