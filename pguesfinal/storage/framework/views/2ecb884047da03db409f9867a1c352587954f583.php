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
	
	


   <br>Honorables miembros de Junta Directiva
  

  
	


<br>Presente</h></p>
<p align="justify"><h ><br>Reciban cordiales saludos y deseos de éxitos en sus labores diarias.</h></p>
<p align="justify">

<?php foreach($grupo as $gru): ?>
<?php if($gru->codigoG==$codigo): ?>
<?php foreach($carrera as $c): ?>
	<?php if($c->idcarrera == $gru->idcarrera): ?>
			<?php foreach($departamento as $d): ?>
			<?php if($d->iddepartamento ==$c->iddepartamento): ?>
			<?php
			$depto=$d->nombre;
			$iddepto=$d->iddepartamento;
			$anio=$gru->fecharegistro;
			?>
			<?php endif; ?>
			<?php endforeach; ?>
	<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>


<?php    $newformat = date('Y',strtotime($anio));   ?>

<?php foreach($rol_carrera as $rlc): ?>
   	<?php if($rlc->idrol==3 && $rlc->anio == $newformat && $rlc->idcarrera==$idcarrera): ?>
   <?php foreach($docentes as $d): ?>
				<?php if($d->iddocente==$rlc->iddocente): ?>
					<?php foreach($personas as $p): ?>
					<?php if($p->idpersona==$d->idpersona): ?>
				<?php 	$coor = $p->nombres." ".$p->apellidos; ?> 
					<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
   <?php endforeach; ?>
  
   <?php endif; ?>
   <?php endforeach; ?>

   

<?php foreach($carrera as $c): ?>
	<?php if($c->iddepartamento == $iddepto): ?>
<?php foreach($rol_carrera as $rlc): ?>
   	<?php if($rlc->idrol==2  && $rlc->idcarrera==$c->idcarrera): ?>
   <?php foreach($docentes as $d): ?>
				<?php if($d->iddocente==$rlc->iddocente): ?>
					<?php foreach($personas as $p): ?>
					<?php if($p->idpersona==$d->idpersona): ?>
				<?php 	$jefe = $p->nombres." ".$p->apellidos; ?> 
					<?php endif; ?>
					<?php endforeach; ?>
				<?php endif; ?>
   <?php endforeach; ?>
  

   <?php endif; ?>
   <?php endforeach; ?>
   <?php endif; ?>
   <?php endforeach; ?>


<h >En atención a la solicitud presentada por el Coordinador General de Trabajos de Graduación del <?php echo e($depto); ?>, <?php echo e($coor); ?> y con el Visto Bueno del Jefe del <?php echo e($depto); ?>, <?php echo e($jefe); ?> y conforme a lo establecido en el Artículo 211 del Reglamento de la gestión Académico-Administrativa de la Universidad de El Salvador, tengo a bien solicitarles muy respetuosamente la <strong>Impugnación de Resultados</strong> del trabajo de graduación que se detalla a continuación:</h>
</p><?php foreach($grupo as $gru): ?>
	<?php if($gru->codigoG==$codigo): ?>
<p align="justify"><h>Trabajo de Graduación desarrollado por el grupo N°:<?php echo e($gru->codigoG); ?></h></p>	
	<?php endif; ?>
	<?php endforeach; ?>




			<?php foreach($grupo as $gru): ?>
			<?php if($gru->codigoG==$codigo): ?>
			 <?php $tema =$gru->tema;	$tipotema=$gru->idtipotema; $idgrupo=$gru->idgrupo?>
			<?php endif; ?>
			<?php endforeach; ?>
<h>Tema: <?php echo e($tema); ?></h>
<br>
<br>
<h>Los resultados son los siguientes</h>
<br>

<table class="table table-hover" cellspacing="10" border="0">
       <thead>
         <tr>
          <?php $cet=0; ?>
           <th  >Carnet</th>
           <th  >Nombre</th>
           <?php foreach($tiproceso as $tip): ?>
    <?php if($tip->idtipotema==$tipotema): ?>
    <?php foreach($etapas as $et): ?>
    <?php if($et->idtipotrabajo==$tip->idtipotema): ?> 
     <?php foreach($porcentaje as $pr): ?>
     <?php if($pr->idetapa==$et->idnuevaetapa): ?>
   <th>Etapa <?php echo e($et->idetapa); ?> <br> (<?php echo e($pr->porcentaje); ?>%)</th>
    <?php $cet++; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?> 
<th>Promedio <br> Final</th>


         </tr>
       </thead>
       <tbody>  <?php foreach($mostraintegrante as $mint): ?>
                <?php if($mint->idgrupo==$idgrupo): ?>
                <?php foreach($estudiantes as $est): ?>
                <?php if($mint->idestudiante==$est->idestudiante): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>
         <tr>
           
               <td><?php echo e($est->carnet); ?></td> <td><?php echo e($per->nombres." ".$per->apellidos); ?></td>
<?php for($j = 1; $j <=$cet; $j++): ?>
<td>
<?php foreach($notas as $not): ?>
<?php if($not->idestudiante==$est->idestudiante && $not->idetapa==$j ): ?>

 <?php echo e($not->nota); ?>

 
<?php endif; ?>
<?php endforeach; ?>
</td>
<?php endfor; ?>



<?php $prom=0; ?>
       <?php foreach($tiproceso as $tip): ?>
    <?php if($tip->idtipotema==$tipotema): ?>
    <?php foreach($etapas as $et): ?>
    <?php if($et->idtipotrabajo==$tip->idtipotema): ?> 
     <?php foreach($porcentaje as $pr): ?>
     <?php if($pr->idetapa==$et->idnuevaetapa): ?>
   
<?php foreach($notas as $not): ?>
<?php if($not->idestudiante==$est->idestudiante &&  $not->idetapa==$et->idetapa ): ?>


<?php $prom=$prom+$not->nota*($pr->porcentaje/100); ?>

<?php endif; ?>
<?php endforeach; ?>

    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?> 

<td ><strong><?php echo round($prom,1);?></strong></td>

         </tr> <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
           
       </tbody>
     </table>
<br>
<h> <strong>
<?php
if($gs1){
switch ($gs1->idsolicitud) {

case 1:
echo "Acuerdo de Aprobación de Tema: ".$gs1->nacuerdo;
break;
	case 3:
	echo "Acuerdo de Prórroga a Junta Directiva: ".$gs1->nacuerdo;
break;
case 4:
echo "Acuerdo de Ratificación del Tribunal Calificador: ".$gs1->nacuerdo;
break;
case 5:
echo "Acuerdo de Ratificación de los Resultados: ".$gs1->nacuerdo;
break;
case 6:
echo "Acuerdo de Modificación del Tema: ".$gs1->nacuerdo;
break;

           case 8:
echo "Acuerdo de Reprobación por abandono: ".$gs1->nacuerdo;
           break;

case 9:
echo "Acuerdo de Renuncia al Proceso de Graduación: ".$gs1->nacuerdo;
break;
case 10:
echo "Acuerdo de Impugnación de Resultados: ".$gs1->nacuerdo;
break;
        }
}
?>
</strong></h>

<p align="justify"><h >Se anexa la correspondencia relacionada a los acuerdos mencionados y la solicitud del  <?php echo e($depto); ?></h></p>
<p align="justify"><h >Sin otro particular. Atentamente.</h></p>

<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
<br>
<br>
<br>
<div><h align="center"> 
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
   <?php if($r->idrol==$rlc->idrol): ?>
   <br><?php echo e($r->nombre); ?> DE PROCESOS DE GRADUACIÓN
   <?php endif; ?>
   <?php endforeach; ?>
   <?php endif; ?>
   <?php endforeach; ?>
</h></div>

<br>



