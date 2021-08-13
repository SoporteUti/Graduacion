<div style="width: 20px;float: left;">
<img src="<?php echo e(public_path('img/minerva2.png')); ?>"  width="100px" height="110px"  ></img>
</div>
<h4 align="center">
Universidad de El Salvador<br>
Facultad Multidisciplinaria Paracentral<br>
<?php foreach($grupo as $gru): ?>
<?php if($gru->codigoG==$codigo): ?>
<?php foreach($carrera as $c): ?>
  <?php if($c->idcarrera == $gru->idcarrera): ?>
      <?php foreach($departamento as $d): ?>
      <?php if($d->iddepartamento ==$c->iddepartamento): ?>
      Departamento de <?php echo e($d->nombre); ?>

      
<?php       $iddepto=$d->iddepartamento;
      $idcarrera=$gru->idcarrera;
      $anio=$gru->fecharegistro;
      ?>
      <?php endif; ?>
      <?php endforeach; ?>
  <?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>
<br >

Coordinación General de Trabajos de Graduación
<br >
</h4>
<h5 align="right">
San Vicente, <?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?></h5>
<p align="justify">

<h>
  
  
  <?php    $newformat = date('Y',strtotime($anio));   ?>
  
  

   <?php foreach($rol_carrera as $rlc): ?>
    <?php if($rlc->idrol==4 ): ?>
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
    Director general de trabajos de graduación
   <?php endif; ?>
   <?php endforeach; ?>
   <?php endif; ?>
   <?php endforeach; ?>

<br>Presente</h></p>
<p align="justify"><h >Estimado/a<br>Reciba cordiales saludos y deseos de éxitos en sus labores diarias.</h></p>
<p align="justify">


<h >En correspondencia a lo que establece el Art. 205 del Reglamento de la Gestión Académico Administrativa de la Universidad de El Salvador, le solicitamos que se gestione ante la Junta Directiva la <strong>reprobación</strong>  por abandono de parte del/la estudiante con carnet N°: <?php echo e($estudianteselec); ?> al Trabajo de Graduación que se detalla a continuación:</h>
<p align="justify">
         <?php foreach($grupo as $gru): ?>
         <?php if($gru->codigoG==$codigo): ?>
Código: <?php echo e($gru->codigoG); ?>

         <br>
         <h >Tema:<?php echo e($gru->tema); ?></h>   
         <?php endif; ?>
         <?php endforeach; ?> 
</p>

</p><?php foreach($grupo as $gru): ?>
   <?php if($gru->codigoG==$codigo): ?>
   
   <?php endif; ?>
   <?php endforeach; ?>

      <p align="justify"><h > Docente/es Asesor/es:</h></p>
   <table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
         <thead>
            <tr >
               <th width="45%"></th>
               <th width="20%"></th>
               <th width="25%"></th>
            </tr>
         </thead>
         <tbody>
            <?php foreach($asesores as $ase): ?>
                <?php if($ase->idgrupo==$gru->idgrupo): ?>
                <?php foreach($docentes as $doc): ?>
                <?php if($ase->iddocente==$doc->iddocente): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona==$doc->idpersona): ?>
            <tr>
               <td><?php echo e($doc->titulo); ?><?php echo e(" "); ?><?php echo e($per->nombres); ?><?php echo e(" "); ?><?php echo e($per->apellidos); ?></td>
                  <td></td>
                  <td></td>
                     
            </tr> 
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
         </tbody>
   </table>
<br>


<br> 
<p align="justify">
<h>Dicha petición obedece a que el/la estudiante no se ha presentado a  las asesorias programadas en repetidas ocaciones  sin presentar ninguna justificación</h>
<br>
<h >Sin otro particular. Atentamente.</h></p>

<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
<br> <br> <p>
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
 <?php if($r->idrol==$rlc->idrol && $r->idrol==3): ?>
   Coordinador general de trabajos de graduación
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php foreach($grupo as $gru): ?>
 <?php if($gru->codigoG==$codigo): ?>
  <?php foreach($carrera as $c): ?>
   <?php if($c->idcarrera == $gru->idcarrera): ?>
  <?php foreach($departamento as $d): ?>
   <?php if($d->iddepartamento ==$c->iddepartamento): ?>
    Departamento de <?php echo e($d->nombre); ?>

   <?php endif; ?>
  <?php endforeach; ?>
   <?php endif; ?>
  <?php endforeach; ?>
 <?php endif; ?>
<?php endforeach; ?>

</div>


<div style="width: 250px; float: right; "> 

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
   Jefe de departamento de 
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>
<?php foreach($grupo as $gru): ?>
 <?php if($gru->codigoG==$codigo): ?>
  <?php foreach($carrera as $c): ?>
   <?php if($c->idcarrera == $gru->idcarrera): ?>
  <?php foreach($departamento as $d): ?>
   <?php if($d->iddepartamento ==$c->iddepartamento): ?>
    <?php echo e($d->nombre); ?>

   <?php endif; ?>
  <?php endforeach; ?>
   <?php endif; ?>
  <?php endforeach; ?>
 <?php endif; ?>
<?php endforeach; ?>
</div>
   
</p>  