<div style="width: 20px;float: left;">
<img src="<?php echo e(public_path('img/minerva2.png')); ?>"  width="100px" height="110px"  ></img>
</div>
<style type="text/css">
	p{
		font-size: small;
	}
	.table{
		font-size: small;
	}
   
html {
margin:2cm 2cm 2cm 2cm;
}

</style>

<h4 align="center">
Universidad de El Salvador<br>
Facultad Multidisciplinaria Paracentral<br>
Departamento de <?php echo e($grupo->carrera->departamento->nombre); ?>

<br>
Coordinación General de Trabajos de Grado
<br>

<?php
			$idcarrera=$grupo->idcarrera;
			$anio=$grupo->fecharegistro;
			?>

</h4>
<h5 align="right">
San Vicente, <?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?></h5>
<p align="justify">

<h>
   
   
   <?php    $newformat = date('Y',strtotime($grupo->fecharegistro));   ?>
   
   


  <br>
      <?php foreach($rol_carrera as $rlc): ?>
         <?php if($rlc->idrol==4 && $rlc->idcarrera!=$grupo->carrera->idcarrera): ?>
      <?php foreach($docentes as $d): ?>
               <?php if($d->iddocente==$rlc->iddocente): ?>
                  <?php foreach($personas as $p): ?>
                  <?php if($p->idpersona==$d->idpersona): ?>
                 <?php echo e($d->titulo); ?><?php echo e(" "); ?><?php echo e($p->nombres); ?><?php echo e(" "); ?><?php echo e($p->apellidos); ?>

                  <?php endif; ?>
                  <?php endforeach; ?>
               <?php endif; ?>
      <?php endforeach; ?>
     

   <?php foreach($rol as $r): ?>
   <?php if($r->idrol==$rlc->idrol && $r->idrol==4): ?>
   <br>
    Director General de Trabajos de Grado
   
            <?php else: ?>
               <?php if($r->idrol==$rlc->idrol): ?>
               <br><?php echo e($r->nombre); ?> 
               <?php endif; ?>
               <?php endif; ?>
   <?php endforeach; ?>
   <?php endif; ?>
   <?php endforeach; ?>


<br>Presente.</h></p>

<p align="justify"><h >Estimado/a<br>Reciban un afectuoso saludo, deseándole éxito en sus funciones cotidianas.</h></p>
<p align="justify">
<h ><?php foreach($enunciado as $en): ?>
  <?php if($en->idsolicitud==4 && $en->idrol==3): ?>
  <?php echo e($en->enunciado); ?>

  <?php endif; ?>
  <?php endforeach; ?>, le solicitamos interponga sus buenos oficios para que se gestione ante la Junta Directiva de esta Facultad <STRONG>la Ratificación del Tribunal Calificador</STRONG>  para el  Trabajo de Grado siguiente:</h>

<p align="justify"><h></h>
         

         Código: <?php echo e($grupo->codigoG); ?><br>
         <br><h >Tema:<?php echo e($grupo->tema); ?></h>   
         
</p>


<p align="justify"><h >Bachilleres:</h></p>
   <table class="table table-hover" width="600px"  cellspading="2px" align="center" >
         <thead>
            <tr >
               <th width="5%">N°</th>
            <th width="40%">Nombre</th>
            <th width="20%">Carné</th>
            </tr>
         </thead>
         <tbody>
         <?php $cont=1; ?>
         
         <?php foreach($grupo->estudiantes_grupo as $per): ?>
            <tr>
            <td><?php echo $cont; $cont++ ?>  </td>
            <td>Br.<?php echo e($per->estudiante->persona->full_name); ?></td>
            <td><?php echo e($per->estudiante->carnet); ?></td>        
            </tr>
         
         <?php endforeach; ?>
         
         </tbody>
   </table> 


<p align="justify"><h >Tribunal Calificador</h></p>
   <table class="table table-hover" width="600px"  cellspading="2px" align="center" >
         <thead>
            <tr >
                <th width="5%">N°</th>
            <th width="40%">Nombre</th>
            </tr>
         </thead>
         <tbody>
         <?php $cont=1; ?>
               <?php foreach($dt as $d): ?>
               <?php if($d->idgrupsol==$gruposol->idgrupsol): ?>
               <tr>
                  <td><?php echo $cont; $cont++ ?>  </td>
                  <td><?php echo e($d->docente->titulo); ?><?php echo e($d->docente->persona->full_name); ?></td>
               </tr>
               <?php endif; ?>
         <?php endforeach; ?>
         </tbody>
   </table>
<p align="justify"><h >Sin otro particular. Atentamente.</h></p>
<?php /*quite un <br>*/ ?>
<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>

<div style="width: 250px; float: left;"> 

<?php foreach($rol_carrera as $rlc): ?>
 <?php if($rlc->idrol==3 && $rlc->anio == $newformat && $rlc->idcarrera==$idcarrera): ?>
  <?php foreach($docentes as $d): ?>
   <?php if($d->iddocente==$rlc->iddocente): ?>
  <?php foreach($personas as $p): ?>
   <?php if($p->idpersona==$d->idpersona): ?>
      <?php echo e($d->titulo); ?><?php echo e(" "); ?><?php echo e($p->nombres); ?><?php echo e(" "); ?><?php echo e($p->apellidos); ?>

   <?php endif; ?>
  <?php endforeach; ?>
   <?php endif; ?>
  <?php endforeach; ?>
 <?php foreach($rol as $r): ?>
 <?php if($r->idrol==$rlc->idrol && $r->idrol==3): ?><br>
   Coordinador General de Trabajos de Grado
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>
Departamento de <?php echo e($grupo->carrera->departamento->nombre); ?>

     
</div>

<div style="width: 250px; float: right;"> 

<?php foreach($rol_carrera as $rlc): ?>
 <?php if($rlc->idrol==2 && $rlc->idcarrera==$idcarrera): ?>
  <?php foreach($docentes as $d): ?>
   <?php if($d->iddocente==$rlc->iddocente): ?>
  <?php foreach($personas as $p): ?>
   <?php if($p->idpersona==$d->idpersona): ?>
      <?php echo e($d->titulo); ?><?php echo e(" "); ?><?php echo e($p->nombres); ?><?php echo e(" "); ?><?php echo e($p->apellidos); ?>

   <?php endif; ?>
  <?php endforeach; ?>
   <?php endif; ?>
  <?php endforeach; ?>
 <?php foreach($rol as $r): ?>
 <?php if($r->idrol==$rlc->idrol && $r->idrol==2): ?>
  <br>
   Jefe de Departamento
   <br>
   Departamento de 
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php echo e($grupo->carrera->departamento->nombre); ?>

</div>




<br>
<br>
<br>
