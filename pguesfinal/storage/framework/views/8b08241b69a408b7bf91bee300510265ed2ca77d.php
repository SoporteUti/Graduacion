<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">

        <style type="text/css">
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
        body center p {
        font-weight: bold;
        font-size: 14px;
        font-family: Times New Roman; 
        }
      body table tr {
        text-align: justify;
        font-family: Times New Roman; 
         font-size: 14px;
        }
        html {
margin: 0;
}
body {
font-family: "Times New Roman", serif;
margin: 2cm 2cm 2cm 2cm;
}
</style>
</head>

  <body > 
 
<table width="100%" align="center" border="0" >
  <tr>
  <td ><center><img src="img/minerva2.png"  width="100px" height="120px" align="center" ></img></center>
  </td>
  <td><center><h4>Universidad de El Salvador<br>Facultad Multidisplinaria Paracentral </h4><h5>Registro de Nota de Evaluación<br>
         </h5> </center></td>
  <td ><center><img src="img/ic_launcher.png"  width="100px" height="100px"  align="center"></img>  </center></td>
  </tr>
</table>
<br>
<h4>
    Grupo N°: <?= $grupos->codigoG ?>
</h4>
<br>
<h4>
    Tema: <?= $grupos->tema?>
</h4>
<br>
<table class="table table-hover" cellspacing="10" border="0">
       <thead>
         <tr>
          <?php $cet=0; ?>
           <th  >Carnet</th>
           <th  >Nombre</th>
          
    
    
   <th>Etapa <?php echo e($et->idetapa); ?> <br> (<?php echo e($pr->porcentaje); ?>%)</th>
    <?php $cet++; ?>
    
 
  
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
<br>
<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
</body>
</html>