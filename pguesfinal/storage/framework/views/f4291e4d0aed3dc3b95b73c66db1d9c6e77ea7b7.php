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
  

  
	


<br>Presente.</h></p>
<p align="justify"><h ><br>Reciban cordiales saludos y deseos de &eacute;xitos en sus labores diarias.</h></p>
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


<h >En atenci&oacute;n a la solicitud presentada por el Coordinador General de Trabajos de Graduaci&oacute;n del departamento de <?php echo e($depto); ?>, <?php echo e($coor); ?> y con el Visto Bueno del Jefe del departamento de <?php echo e($depto); ?>, <?php echo e($jefe); ?> y 
	<?php foreach($enunciado as $en): ?>
	<?php if($en->idsolicitud==1 && $en->idrol==4): ?>
	<?php echo e($en->enunciado); ?>

	<?php endif; ?>
	<?php endforeach; ?>, tengo a bien solicitarles muy respetuosamente la aprobaci&oacute;n del trabajo de graduaci&oacute;n que se detalla a continuaci&oacute;n as&iacute; como el nombramiento de los Docentes Asesores:</h>
</p><?php foreach($grupo as $gru): ?>
	<?php if($gru->codigoG==$codigo): ?>
<p align="justify"><h>Trabajo de Graduaci&oacute;n código: <?php echo e($gru->codigoG); ?></h></p>	
	<?php endif; ?>
	<?php endforeach; ?>




			<?php foreach($grupo as $gru): ?>
			<?php if($gru->codigoG==$codigo): ?>
			 <?php $tema =$gru->tema;	?>
			<?php endif; ?>
			<?php endforeach; ?>
	<table class="table table-hover" width="600px"  cellspacing="1px" cellpadding="1px" align="center" >
		<thead>
			<tr >
				
				<th width="25%">Nombre</th>
				<th width="10%">Carn&eacute;</th>
				
				
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
						
				<td>Br.<?php echo e($per->nombres); ?><?php echo e(" "); ?><?php echo e($per->apellidos); ?></td>
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
	<p align="justify"><h > Tema: <?php echo e($tema); ?></h></p>
	
	<p align="justify"><h > Docente/es Asesor/es propuestos:</h></p>
	<table  class= "table table-bordered" width="1000px"  cellspacing="1px" cellpadding="1px" align="center" >
			<thead>
				<tr >
					
					<th width="100%"></th>
					
					
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
<p align="justify"><h >Anexo la correspondencia relacionada a la solicitud enviada por el Coordinador General de Trabajos de Graduaci&oacute;n del departamento de <?php echo e($depto); ?> con el respectivo visto bueno del Jefe de Departamento</h></p>


<p align="justify"><h >Sin otro particular. Atentamente.</h></p>


<div class="panel panel-default">
	<div class="panel-body">
		
	</div>
	<div class="panel-footer">
		<h4 align="center" >"HACIA LA LIBERTAD POR LA CULTURA"</h4>
	</div>
</div>

<p>
	
</p>	
<p>
	
</p>
<br>
	
<table class="table table-hover" width="600px">
	<thead>
		<tr>
			<th width="100%">

 </th>


		</tr>
	</thead>
	<tbody>
		<tr>
			<td ><?php foreach($rol_carrera as $rlc): ?>
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
   <br><?php echo e($r->nombre); ?> DE PROCESOS DE GRADUACI&Oacute;N
   <?php endif; ?>
   <?php endforeach; ?>
   <?php endif; ?>
   <?php endforeach; ?>
 </td>
			
		</tr>
		
	</tbody>
</table>


 