<div style="width: 20px;float: left;">
<img src="<?php echo e(public_path('img/minerva2.png')); ?>"  width="100px" height="110px"  ></img>
</div>

<h4 align="center">
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
    Director general de trabajos de graduación
   <?php endif; ?>
   <?php endforeach; ?>
   <?php endif; ?>
   <?php endforeach; ?>

<br>Presente</h></p>
<h >Reciba cordiales saludos y deseos de &eacute;xitos en sus labores diarias.</h>

<p align="justify"><h >
	<?php foreach($enunciado as $en): ?>
	<?php if($en->idsolicitud==10 && $en->idrol==3): ?>
	<?php echo e($en->enunciado); ?>

	<?php endif; ?>
	<?php endforeach; ?>, solicitamos  que interponga sus buenos oficios ante la Junta Directiva de &eacute;sta Facultad para que sean <strong>Impugnados los Resultados</strong> obtenidos en el  trabajo de graduaci&oacute;n.</h></p>

<?php foreach($grupo as $gru): ?>
 <?php if($gru->codigoG==$codigo): ?>
  <p align="justify"><h>C&oacute;digo de Grupo: <?php echo e($gru->codigoG); ?>.</h>	
 <?php    $idgrupo=$gru->idgrupo;   ?>
 <?php endif; ?>
<?php endforeach; ?>
<br>
<h>Tema:</h>
<?php foreach($grupo as $gru): ?>
 <?php if($gru->codigoG==$codigo): ?>
  <h ><?php echo e($gru->tema); ?></h>	
 <?php endif; ?>
<?php endforeach; ?>
</p>
<h>Estudiantes:</h>
<table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
	<thead>
		<tr >
			<th width="5%">N°</th>
			<th width="40%">Nombre</th>
			<th width="20%">Carn&eacute;</th>	
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
			<td>Br.<?php echo e($per->nombres); ?><?php echo e(" "); ?><?php echo e($per->apellidos); ?></td>
			<td><?php echo e($est->carnet); ?></td>			
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

<p align="justify"><h > Tribunal Evaluador:</h></p>
<table class="table table-hover" width="600px"  cellspading="2px" align="center" >
         <thead>
            <tr >
            	<th width="5%">N°</th>
            <th width="40%">Nombres</th>
            </tr>
         </thead>
         <tbody>
         <?php $cont=1; ?>
               <?php foreach($dt as $d): ?>
               	<?php foreach($gruposoli as $gs): ?>
               <?php if($d->idgrupsol==$gs->idgrupsol && $gs->idgrupo==$idgrupo): ?>
               <tr>
                  <td><?php echo $cont; $cont++ ?>  </td>
                  <td><?php echo e($d->docente->titulo); ?> <?php echo e($d->docente->persona->full_name); ?></td>
               </tr>
               <?php endif; ?>
               <?php endforeach; ?>
         <?php endforeach; ?>
         </tbody>
   </table>
<br>
<p align="justify"><h >Se anexa la solicitud  presentada por los Bachilleres en donde expresan los motivos por los cuales estan inconformes con las calificaciones obtenidas.</h></p>
<h >Sin otro particular. Atentamente.</h>
<br>



<div class="panel panel-default">
	<div class="panel-body">
		
	</div>
	<div class="panel-footer">
		<h4 align="center" >"HACIA LA LIBERTAD POR LA CULTURA"</h4>
	</div>
</div>

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
   <?php if($r->idrol==$rlc->idrol && $r->idrol==3): ?>
   <br>Coordinador general de trabajos de graduación
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
   <br>Jefe de departamento de 
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
			 <?php echo e($d->nombre); ?>

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


 