
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

      <br>
      Coordinación General de Trabajos de Graduación
<?php
      $idcarrera=$gru->idcarrera;
      $anio=$gru->fecharegistro;
      ?>
      <?php endif; ?>
      <?php endforeach; ?>
  <?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>
<br>

</h4>
<h5 align="right">
San Vicente, <?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?></h5>
<p align="justify">



<h>
  
  
  <?php    $newformat = date('Y',strtotime($anio));   ?>
  
  

   <?php foreach($rol_carrera as $rlc): ?>
    <?php if($rlc->idrol==4): ?>
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
    Coordinador general de trabajos de graduación
   <?php endif; ?>
   <?php endforeach; ?>
   <?php endif; ?>
   <?php endforeach; ?>

  
  


<br>Presente</h></p>
<p align="justify"><h >Estimado/a<br>Reciba cordiales saludos y deseos de éxitos en sus labores diarias.</h></p>
<p align="justify">


<h >Por este medio, muy respetuosamente le solicito interponga sus buenos oficios ante la Junta Directiva para que se otorgue una  <strong>corrección en el nombre</strong> del Trabajo de Graduación que se detalla a continuación:</h>

<p align="justify"><h></h>
      <?php foreach($grupo as $gru): ?>
      <?php if($gru->codigoG==$codigo): ?>
      <h >Tema: <?php echo e($gru->tema); ?></h>  
      <?php endif; ?>
      <?php endforeach; ?>
</p>
<h >Propuesta de Tema que se pide aprobar con la modificación : <strong><?php echo e($nuevotema); ?></strong> </h>
<br>
<br>
<h >Motivo: <?php echo e($motivo); ?></h>
<br>
<br>
<p align="justify"><h > Docente/es Asesor/es:</h></p>
  <table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
      <thead>
        <tr >
          <th width="45%"></th>
          <th width="20%"></th>
          <th width="15%"></th>
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
<h>Esperando una resolución favorable.</h>



<p align="justify"><h >Sin otro particular. Atentamente.</h></p>

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
 <br>
   Jefe de departamento
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
<br>
<br>
<br>

