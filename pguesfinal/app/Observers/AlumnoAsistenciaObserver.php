<?php 

namespace sispg\Observers;

/**
 * 
 */
use sispg\{
    AlumnoAsistencia,
      notificacion_inasistencia,
      grupo_solicitud,
      etapas_grupos,
    Notifications\NotificacionInasistencia,
    Notifications\NotificacionReprobacionDefinitiva
};

use sispg\Utils\UtilFunctions;


class AlumnoAsistenciaObserver
{
    public function saved(AlumnoAsistencia $al)
    {
       $gs= new grupo_solicitud;
       $ni=new notificacion_inasistencia;
       $gs1= new grupo_solicitud;
       $ni1=new notificacion_inasistencia;
       $consulta = etapas_grupos::all();
        $date = new \DateTime(); 
        foreach ($consulta as $c) {
                     if ($c->idgrupo==$al->grupo_asistencia->idgrupo && $c->estado==1) {
                       $etapa=$c->idnuevaetapa;
                   }
               }
      
       
      $var=AlumnoAsistencia::where('idestudiante','=',$al->idestudiante)->where('asistencia','=',false)->count();

$var1=notificacion_inasistencia::where('idestudiante','=',$al->idestudiante)->count();

        switch ($var) {
           case 3:
         if($var1==0){
           UtilFunctions::getUserNotify('ASESOR',$al->grupo_asistencia->idgrupo)->notify(new NotificacionInasistencia($al,UtilFunctions::ASESOR));
         
$gs->idsolicitud=7;
$gs->idgrupo=$al->grupo_asistencia->idgrupo;
$gs->condicion=true;
$gs->etapa=$etapa;
$gs->estado=5;
$gs->fecha=$date->format('d-m-Y');
$gs->save();

$ni->idgrupsol=$gs->idgrupsol;
$ni->idestudiante=$al->idestudiante;
$ni->idsolicitud=7;
$ni->condicion=true;
$ni->numero="PRIMERA";
$ni->idgrupo=$al->grupo_asistencia->idgrupo;
$ni->save();}
           break;

           case 6:
           if($var1==1){
           UtilFunctions::getUserNotify('ASESOR',$al->grupo_asistencia->idgrupo)->notify(new NotificacionInasistencia($al,UtilFunctions::ASESOR));
         $gs->idsolicitud=7;
$gs->idgrupo=$al->grupo_asistencia->idgrupo;
$gs->condicion=true;
$gs->etapa=$etapa;
$gs->estado=5;
$gs->fecha=$date->format('d-m-Y');
$gs->save();

$ni->idgrupsol=$gs->idgrupsol;
$ni->idestudiante=$al->idestudiante;
$ni->idsolicitud=7;
$ni->numero="SEGUNDA";
$ni->condicion=true;
$ni->idgrupo=$al->grupo_asistencia->idgrupo;
$ni->save();}
           break;

           case 9:
       if($var1==2){
           UtilFunctions::getUserNotify('ASESOR',$al->grupo_asistencia->idgrupo)->notify(new NotificacionReprobacionDefinitiva($al,UtilFunctions::ASESOR));
        $gs->idsolicitud=7;
$gs->idgrupo=$al->grupo_asistencia->idgrupo;
$gs->condicion=true;
$gs->etapa=$etapa;
$gs->estado=5;
$gs->fecha=$date->format('d-m-Y');
$gs->save();

$ni->idgrupsol=$gs->idgrupsol;
$ni->idestudiante=$al->idestudiante;
$ni->idsolicitud=7;
$ni->numero="TERCERA";
$ni->condicion=true;
$ni->idgrupo=$al->grupo_asistencia->idgrupo;
$ni->save();



$gs1->idsolicitud=8;
$gs1->idgrupo=$al->grupo_asistencia->idgrupo;
$gs1->condicion=true;
$gs1->etapa=$etapa;
$gs1->estado=3;
$gs1->fecha=$date->format('d-m-Y');
$gs1->save();

$ni1->idgrupsol=$gs1->idgrupsol;
$ni1->idestudiante=$al->idestudiante;
$ni1->idsolicitud=8;
$ni1->condicion=true;
$ni1->idgrupo=$al->grupo_asistencia->idgrupo;
$ni1->save();
}

           break;

        }

           // UtilFunctions::getUserNotify('ASESOR',$al->grupo_asistencia->idgrupo)->notify(new NotificacionInasistencia($al,UtilFunctions::ASESOR));

    }
}

