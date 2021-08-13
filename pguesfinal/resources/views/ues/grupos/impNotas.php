<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
          html {
margin:5cm 2cm 2cm 2cm;
}
     
    @page { font-family: "Times New Roman", serif;}
    #header { position: fixed; left: 0px; top: -125px; right: 0px; height: 100px; background-color: white; text-align: center;  }
    #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 200px; background-color: white; font-family: Times New Roman; }
    #footer .page:after { content: counter(page, decimal);   }
    body center h5 {
        font-weight: bold;
        font-size: 20px;
        font-family: Times New Roman; 
        }
      body center h4 {
        font-weight: bold;
        font-size: 18px;
        font-family: Times New Roman; 
        }
      body table tr {
        text-align: justify;
        font-family: Times New Roman; 
         font-size: 14px;
        } 

        

  </style>


  <body > 
 <div id="header">
<table width="100%" align="center" border="0" >
  <tr>
  <td ><center><img src="img/minerva2.png"  width="100px" height="120px" align="center" ></img></center>
  </td>
  <td><center><h4>Universidad de El Salvador<br>Facultad Multidisciplinaria Paracentral </h4><h5>Registro de Nota por Evaluación<br>
         </h5> </center></td>
  <td ><center><img src="img/ic_launcher.png"  width="100px" height="100px"  align="center"></img>  </center></td>
  </tr>
  
</table>
</div>
<div id="footer">
   <table width="100%" align="center" border="0" >
     <tr>
       <th ><p><?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?> - <?php $time = time();  echo date("(h:i:s A)", $time); ?> </p> </th>
              <th> <p  align="right" class="page">Página </p> </th>
     </tr>
     </table> 
  </div>
  <div id="content">

<p><?php foreach($tiproceso as $tip) {?>
    <?php if($tip->idtipotema==$grupos->idtipotema) {?>
    <?php foreach($etapas as $et) {?>
    <?php if($et->idtipotrabajo==$tip->idtipotema) {?>
	<?php if ($et->idnuevaetapa==$seleEtapas) {?>
<h4 align="center">ETAPA N° <?=$et->idetapa?>: <?= $et->idnombreetapa ?></h4>
<?php $etapas=$et->idetapa?>
<?php } ?> 
<?php } ?> 
<?php } ?> 
<?php } ?> 
<?php } ?> 

<h4 align="left">  

 <br> 
<?php foreach($grupos->periodo->fechas->sortBy('idnuevaetapa') as $eta) {?>
<?php if($eta->idnuevaetapa==$seleEtapas) {?>
Fecha de Evaluación: <?= \Carbon\Carbon::parse($eta->fechasetapas)->format('d-m-Y')?>
	<?php } ?>   
    <?php } ?>         
</h4>

<h4 align="left">
    Código: <?= $grupos->codigoG ?>
</h4>

<h4 align="justify">
    Tema: <?= $grupos->tema?>
</h4>
</p>
<br>
<h4 align="center">ESTUDIANTE/S</h4>
<br>
<table width="90%"  align="center"  cellspacing ='10'   class=" table table-bordered"  style="border: gray 1px solid;" cellpadding="10">
  <thead>
    <tr>
      <th>N°</th>
      <th>Carné</th>
      <th>Nombre</th>
      <th align="center">Nota</th>
<th>Estado</th>
      <th>Firma</th>
    </tr>
  </thead>
  <?php $cont=1; ?>
  <?php foreach($mostraintegrante as $mint) {?>
          <?php if($mint->idgrupo==$grupos->idgrupo) {?>
            <?php foreach($estudiantes as $est) {?>
              <?php if($mint->idestudiante==$est->idestudiante) {?>
                <?php foreach($personas as $per) {?>
                  <?php if($per->idpersona == $est->idpersona) {?>
  <tr>
    <td><?php echo $cont; $cont++ ?></td>
    
                  <td> <?= $est->carnet?>  </td>
				    <td align="justify"> <?=$per->nombres?> <?=$per->apellidos?> </td>
					
					
					
					<?php  foreach($notas as $not) {?>
					<?php  if($not->idestudiante==$est->idestudiante && $not->idetapa===$etapas ) {?>
					
					<td align="center" ><?= number_format($not->nota,2) ?></td> 
<?php if($not->nota>=6.0){ ?>
        <td>Aprobado</td>          
  <?php } ?>
   <?php if($not->nota<6.0){ ?>
        <td>Reprobado</td>          
  <?php } ?>
					 <?php } ?>
					<?php } ?>
					
					
    <td>F.____________________</td>
                  
  
  </tr>
  <?php } ?>
                <?php } ?>
              <?php } ?>
            <?php } ?>
         <?php } ?>
        <?php } ?>  

</table>
<br>


<?php if($contador!=$etapas ) {?>
<h4 align="center">Docente Asesor/es</h4>
<table  width="90%"  align="center"  cellspacing ='10'    cellpadding="10">
         <thead>
            <tr >
              <th width="5%">N°</th>
            <th width="40%">Nombres</th>
            <th width="40%">Firma</th>
            </tr>
         </thead>
         <tbody>
         <?php $cont=1; ?>

               <?php foreach($asesores as $ase) {?>
                <?php if($ase->idgrupo==$grupos->idgrupo) {?>
                         <?php foreach($docentes as $doc) {?>
                              <?php if($ase->iddocente==$doc->iddocente) {?>
                     <?php foreach($personas as $per) {?>
                <?php if($per->idpersona==$doc->idpersona) {?>
                 <?php foreach($tipoasesor as $tias) {?>
                <?php if($tias->idtipoasesor==$ase->idtipoasesor) {?>
               <tr>
                  <td><?php echo $cont; $cont++ ?>  </td>
                  <td><?= $doc->titulo." ".$per->nombres." ".$per->apellidos." - ".$tias->tipoasesor?></td>
                  <td> F.____________________ </td>
               </tr>
         
               <?php } ?> 
               <?php } ?> 
               <?php } ?> 
               <?php } ?> 
               <?php } ?> 
               <?php } ?> 
               <?php } ?> 
               <?php } ?>  
 
         </tbody>
   </table>
<?php } ?> 

<?php if($contador==$etapas) {?>

<h4 align="center">TRIBUNAL EVALUADOR</h4>
<table  width="90%"  align="center"  cellspacing ='10'    cellpadding="10">
         <thead>
            <tr >
              <th width="5%">N°</th>
            <th width="40%">Nombres</th>
            <th width="40%">Firma</th>
            </tr>
         </thead>
         <tbody>
         <?php $cont=1; ?>
               
            <?php foreach($gruposoli as $gs) {?>


<?php if( $gs->idsolicitud==4 && $gs->condicion==true && $gs->estado==1 && $gs->idgrupo==$grupos->idgrupo ) {?>
<?php foreach ($dt as $d ) {?>
                <?php if($d->idgrupsol==$gs->idgrupsol ) {?>
               <tr>
                  <td><?php echo $cont; $cont++ ?>  </td>
                  <td><?=$d->docente->titulo?>. <?=$d->docente->persona->full_name?></td>
                  <td> F.____________________ </td>
               </tr>
              <?php } ?>

   <?php } ?> 
<?php } ?>
       <?php } ?>
 
         </tbody>
   </table>
 <?php }  ?>  

   <br>
   <br>
   
   <h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
 </div>
</div>
</body>
</html>