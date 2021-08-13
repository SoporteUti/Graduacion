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
  <td><center><h4>Universidad de El Salvador<br>Facultad Multidisciplinaria Paracentral </h4><h5> Registro de Nota por Evaluación<br></h5> </center></td>
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
<br>
<h4 align="justify">
    Código: <?= $grupos->codigoG ?>
<br>
<br>
    Tema: <?= $grupos->tema?>
</h4>
<br>
      
        <?php $codigo=$grupos->codigoG ?>
       <?php $tema =$grupos->tema; 
       $tipotema=$grupos->idtipotema;
        $idgrupo=$grupos->idgrupo ?>
       

<table width="100%"  align="center" cellspacing ='10' class="table table-bordered" cellpadding="10">
  <thead>
    <tr>
      <?php $cet=0; ?>
        <th>Carnet</th>
        <th>Nombre</th>
          <?php foreach($tiproceso as $tip) {?>
            <?php if($tip->idtipotema==$tipotema) {?>
              <?php foreach($etapas as $et) {?>
                <?php if($et->idtipotrabajo==$tip->idtipotema && $et->condicion==true) {?>
                  <?php foreach($porcentaje as $pr) {?>
                    <?php if($pr->idetapa==$et->idnuevaetapa) {?>
        <th align="center">Etapa <?= $et->idetapa ?> <br> (<?= $pr->porcentaje ?> %)</th>
      <?php $cet++; ?>
                    <?php } ?>
                <?php } ?>
              <?php } ?>
            <?php } ?>
         <?php } ?>
        <?php } ?>
        <th>Promedio <br> Final</th>
<th>Estado</th>
    </tr>
  </thead>
    <tbody>
      <?php foreach($mostraintegrante as $mint) {?>
        <?php if($mint->idgrupo==$idgrupo) {?>
          <?php foreach($estudiantes as $est) {?>
            <?php if($mint->idestudiante==$est->idestudiante) {?>
              <?php foreach($personas as $per) {?>
                <?php if($per->idpersona == $est->idpersona) {?>
        <tr> 
          <td><?= $est->carnet ?></td> 
          <td><?= $per->nombres ?> <?=$per->apellidos ?></td>
              <?php for ($j = 1; $j <=$cet; $j++) {?>
          <td align="center">
                <?php foreach($notas as $not) {?>
                  <?php if($not->idestudiante==$est->idestudiante && $not->idetapa==$j && $not->idgrupo == $idgrupo ) {?>
                    <?php if($not->nota!=0) {?>
                    <?= number_format($not->nota,2) ?>
                    <?php } ?>
                    <?php if($not->nota==0) {?>
                    <?= "-" ?>
                    <?php } ?>
                  <?php } ?>
                <?php } ?></td>
              <?php } ?>
      <?php $prom=0; ?>
        <?php foreach($tiproceso as $tip) {?>
          <?php if($tip->idtipotema==$tipotema) {?>
            <?php foreach($etapas as $et) {?>
              <?php if($et->idtipotrabajo==$tip->idtipotema) {?>
                <?php foreach($porcentaje as $pr) {?>
                  <?php if($pr->idetapa==$et->idnuevaetapa) {?>
                    <?php foreach($notas as $not) {?>
                      <?php if($not->idestudiante==$est->idestudiante &&  $not->idetapa==$et->idetapa &&$not->idgrupo == $idgrupo ) {?>
      <?php $prom=$prom+$not->nota*($pr->porcentaje/100); ?>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            <?php } ?>
         <?php } ?>
        <?php } ?>  
          <td align="center" ><strong><?php echo round($prom,1);?></strong></td>
<?php if($prom>=6.0){ ?>
        <td>Aprobado</td>          
  <?php } ?>
   <?php if($prom<6){ ?>
        <td>Reprobado</td>          
  <?php } ?>
        </tr> 
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            <?php } ?>
         <?php } ?>
        <?php } ?>      
    </tbody>
  </table>
<br> 


<?php foreach($carrera as $c) {?>
  <?php if($c->idcarrera == $grupos->idcarrera) {?>
<?php } ?>
        <?php } ?> 
<?php $idcarrera=$grupos->idcarrera; ?>

<?php $anio=$grupos->fecharegistro; ?>
<?php    $newformat = date('Y',strtotime($anio));   ?>



<br>
<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
</div>
</div>
</body>
</html>