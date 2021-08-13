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
    Director general de trabajos de graduación
   <?php endif; ?>
   <?php endforeach; ?>
   <?php endif; ?>
   <?php endforeach; ?>


<br>Presente</h></p>
<p align="justify"><h >Estimado/a<br>Reciba cordiales saludos y deseos de éxitos en sus labores diarias.</h></p>
<p align="justify">


<h >En atención a lo establecido en el art. 204 del Reglamento General de la Gestión Académico – Administrativo de la Universidad de El Salvador, le solicitamos interponga sus buenos oficios para que la Junta Directiva de esta Facultad otorgue una prórroga  al Trabajo de Graduación que se detalla a continuación:</h>
</p><?php foreach($grupo as $gru): ?>
	<?php if($gru->codigoG==$codigo): ?>
<p align="justify"><h>Trabajo de Graduación desarrollado por el grupo N°:<?php echo e($gru->codigoG); ?>:</h></p>	
	<?php endif; ?>
	<?php endforeach; ?>

<?php foreach($grupo as $gru): ?>
			<?php if($gru->codigoG==$codigo): ?>
			 <?php $tema =$gru->tema;
			 		$idgrupo=$gru->idgrupo;
			 	?>
			<?php endif; ?>
			<?php endforeach; ?>
	<table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
		<thead>
			<tr >
				
				<th width="35%">Nombre</th>
				<th width="10%">Carné</th>
				
				
			</tr>
			
		</thead>
		<?php $rs =0;	?>
		<?php foreach($grupo as $gru): ?>
			<?php if($gru->codigoG==$codigo): ?>
			<?php foreach($estudianteg as $esg): ?>
			<?php if($esg->idgrupo==$gru->idgrupo): ?>
			<?php foreach($estudiante as $est): ?>
			<?php if($est->idestudiante==$esg->idestudiante): ?>
			<?php foreach($personas as $per): ?>
			<?php if($per->idpersona==$est->idpersona): ?>
		<?php $rs++;	?>	
			<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php endforeach; ?>
				
				
			
		<tbody>
			<?php $t =0;	?>	
			<?php foreach($grupo as $gru): ?>
			<?php if($gru->codigoG==$codigo): ?>
			<?php foreach($estudianteg as $esg): ?>
			<?php if($esg->idgrupo==$gru->idgrupo): ?>
			<?php foreach($estudiante as $est): ?>
			<?php if($est->idestudiante==$esg->idestudiante): ?>
			<?php foreach($personas as $per): ?>
			<?php if($per->idpersona==$est->idpersona): ?>
				<tr>	
						
				<td><?php echo e($per->nombres); ?><?php echo e(" "); ?><?php echo e($per->apellidos); ?></td>
				<td><?php echo e($est->carnet); ?></td>
				<?php if($t==0): ?>
				
				<?php $t++;	?>	
				<?php endif; ?>

			</tr>
			<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php endforeach; ?>

		
				
				
		</tbody>
		</table>
		<p align="justify"><h > Tema: <?php echo e($tema); ?></h>
<p align="justify"><h > Docente/es Asesor/es:</h>
	<table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
			<thead>
				<tr >
					<th width="45%"></th>
					<th width="20%"></th>
					<th width="15%"></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($grupo as $gru): ?>
			<?php if($gru->codigoG==$codigo): ?>
				<?php foreach($asesores as $ase): ?>
                <?php if($ase->idgrupo==$gru->idgrupo): ?>
                <?php foreach($docentes as $doc): ?>
                <?php if($ase->iddocente==$doc->iddocente): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona==$doc->idpersona): ?>
				<tr>
					<td ><?php echo e($doc->titulo); ?><?php echo e(" 
						"); ?><?php echo e($per->nombres); ?><?php echo e(" "); ?><?php echo e($per->apellidos); ?></td>
						
							
				</tr> 
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                 <?php endif; ?>
                <?php endforeach; ?>
			</tbody>
	</table>
	</p>



<p align="justify"><h >Sin otro particular. Atentamente.</h>
	<br>

<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4></p>
<br>
<table class="table table-hover" width="600px">
	<thead>
		<tr>
			<th width="40%">

 </th>
 	<th width="15%">

 </th>

<th width="40%">
	

</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="center"><?php foreach($rol_carrera as $rlc): ?>
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
			<?php  $iddepto=$d->iddepartamento;?>
			 <br >Departamento de <?php echo e($d->nombre); ?>

			<?php endif; ?>
			<?php endforeach; ?>
	<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?></td>
<td align="center">                   </td>
			<td align="center">
				<?php foreach($carrera as $c): ?>
	<?php if($c->iddepartamento == $iddepto): ?>
				<?php foreach($rol_carrera as $rlc): ?>
   	<?php if($rlc->idrol==2 && $rlc->idcarrera==$c->idcarrera): ?>
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
   Jefe de departamneto
   <?php endif; ?>
   <?php endforeach; ?>
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
			 <br >Departamento de <?php echo e($d->nombre); ?>

			<?php endif; ?>
			<?php endforeach; ?>
	<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?>



</td>
		</tr>
		
	</tbody>
</table>
	