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
   <?php if($r->idrol==$rlc->idrol): ?>
   <br><?php echo e($r->nombre); ?>

   <?php endif; ?>
   <?php endforeach; ?>
   <?php endif; ?>
   <?php endforeach; ?>

<br>Presente</h></p>
<p align="justify"><h >Estimado/a<br>Reciba cordiales saludos y deseos de éxitos en sus labores diarias.</h></p>
<p align="justify">


<h >El motivo de la presente es notificarle que el grupo que se detalla no podrá completar la etapa <?php echo e($gruposol->etapa); ?> en el tiempo correspondiente. Remito a usted los datos del grupo que solicita  prórroga INTERNA del   Proyecto  de Trabajo de Graduación:</h>
</p><?php foreach($grupo as $gru): ?>
	<?php if($gru->codigoG==$codigo): ?>
<p align="justify"><h>Grupo N°:<?php echo e($gru->codigoG); ?>:</h></p>	
	<?php endif; ?>
	<?php endforeach; ?>

	<table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
		<thead>
			<tr >
				<th width="5%">N°</th>
				<th width="40%">Nombre</th>
				<th width="20%">Carné</th>
				<th width="20%">Firma</th>
			</tr>
		</thead>
		<tbody>
			<?php $cont=1; ?>
			<?php foreach($grupo as $gru): ?>
			<?php if($gru->codigoG==$codigo): ?>
			<?php foreach($estudianteg as $esg): ?>
			<?php if($esg->idgrupo==$gru->idgrupo): ?>
			<?php foreach($estudiante as $est): ?>
			<?php if($est->idestudiante==$esg->idestudiante): ?>
			<?php foreach($personas as $per): ?>
			<?php if($per->idpersona==$est->idpersona): ?>
				<tr>
				<td><?php echo $cont; $cont++ ?>  </td>
				<td><?php echo e($per->nombres); ?><?php echo e(" "); ?><?php echo e($per->apellidos); ?></td>
				<td><?php echo e($est->carnet); ?></td>
				<td>_____________</td>			
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
<p align="justify"><h>		Tema:</h>
			<?php foreach($grupo as $gru): ?>
			<?php if($gru->codigoG==$codigo): ?>
			<h ><?php echo e($gru->tema); ?></h>	
			<?php endif; ?>
			<?php endforeach; ?>
</p>
 <?php foreach($proint as $pi): ?>
<?php foreach($gso as $gs): ?>

   
 <?php if($gs->idgrupsol==$pi->idgrupsol): ?>  
<palign="justify">
     
   

<h >La prórroga solicitada es del  <?php echo e($pi->fechaInicio); ?> hasta <?php echo e($pi->fechaFinal); ?></h>


                    </p>

                    <?php endif; ?>
<?php endforeach; ?>
                    <?php endforeach; ?>
<p align="justify"><h >Sin otro particular. Atentamente.</h></p>


<br>
<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
<br>
<br>
<table class="table table-hover" width="600px">
	<thead>
		<tr>
			<th width="50%">

 </th>

<th width="50%">
	

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
   <?php if($r->idrol==$rlc->idrol): ?>
   <br><?php echo e($r->nombre); ?>

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
			 <br ><?php echo e($d->nombre); ?>

			<?php endif; ?>
			<?php endforeach; ?>
	<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
<?php endforeach; ?></td>
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
   <?php if($r->idrol==$rlc->idrol): ?>
   <br><?php echo e($r->nombre); ?>

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
			 <br ><?php echo e($d->nombre); ?>

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


