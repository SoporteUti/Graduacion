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
			<?php echo e($d->nombre); ?>

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
   <?php if($r->idrol==$rlc->idrol): ?>
   <br><?php echo e($r->nombre); ?>

   <?php endif; ?>
   <?php endforeach; ?>
   <?php endif; ?>
   <?php endforeach; ?>

  
	
<br>
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
<br>Presente</h></p>
<p align="justify"><h >Estimado/a<br>Reciba cordiales saludos y deseos de éxitos en sus labores diarias.</h></p>
<p align="justify">




<?php foreach($ni as $ni): ?>
                <?php if($ni->idgrupsol==$gruposol->idgrupsol): ?>
                <?php foreach($estudiante as $est): ?>
                <?php if($ni->idestudiante==$est->idestudiante): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>

                <?php
			$carnet=$est->carnet;
			$nombre= $per->nombres." ".$per->apellidos;
			?>
        
                            
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?> 

    <?php
			if($numero=="PRIMERA") $veces=3;
			if($numero=="SEGUNDA") $veces=6;
			if($numero=="TERCERA") $veces=9;
			?>


<h >Por medio de la presente le comunico que el/la estudiante <?php echo e($nombre); ?> CON Carnet N° <?php echo e($carnet); ?> no se ha presentado de manera consecutiva durante <?php echo e($veces); ?>

 sesiones de asesoría que estaban Programadas. Luego de tres días hábiles no ha presentado ninguna justificante al respecto, por tanto, le hago
llegar la <?php echo e($numero); ?> notificación de inasistencia.</h>
</p><?php foreach($grupo as $gru): ?>
	<?php if($gru->codigoG==$codigo): ?>
<p align="justify"><h>Miembro del grupo N°:<?php echo e($gru->codigoG); ?>:</h></p>	
	<?php endif; ?>
	<?php endforeach; ?>

	
<p align="justify">
<h>			Tipo de Proceso de graduación:</h>
			<?php foreach($grupo as $gru): ?>
			<?php if($gru->codigoG==$codigo): ?>
			<?php foreach($tipotema as $tp): ?>
			<?php if($tp->idtipotema==$gru->idtipotema): ?>
			<h ><?php echo e($tp->tema); ?></h>	
			<?php endif; ?>
			<?php endforeach; ?>
			<?php endif; ?>
			<?php endforeach; ?>
</p><p align="justify"><h>		Tema:</h>
			<?php foreach($grupo as $gru): ?>
			<?php if($gru->codigoG==$codigo): ?>
			<h ><?php echo e($gru->tema); ?></h>	
			<?php endif; ?>
			<?php endforeach; ?>
</p>

<p align="justify"><h >Sin otro particular. Atentamente.</h></p>
<!-- <p align="justify"><h >Bachilleres:</h></p>
	<table class="table table-hover" width="600px"  cellspading="2px" align="center" >
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
			<?php foreach($estudianteg as $esg): ?>
			<?php if($esg->idgrupo==$gru->idgrupo): ?>
			<?php foreach($estudiante as $est): ?>
			<?php if($est->idestudiante==$esg->idestudiante): ?>
			<?php foreach($personas as $per): ?>
			<?php if($per->idpersona==$est->idpersona): ?>
				<tr>
					<td><?php echo e($per->nombres); ?><?php echo e(" "); ?><?php echo e($per->apellidos); ?></td>
						<td><?php echo e($est->carnet); ?></td>
						<td>F.______________</td>			
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
<br> -->

<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
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
<br><br>

<p>
	
</p>	