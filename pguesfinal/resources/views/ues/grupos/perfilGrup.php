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
<body>
  <div id="header">
  <table width="100%" align="center" border="0" >
  <tr>
  <td ><center><img src="img/minerva2.png"  width="100px" height="110px" align="center" ></img></center>
  </td>
  <td><center><h4>Universidad de El Salvador<br>Facultad Multidisciplinaria Paracentral </h4><h5>Expediente de Grupo</h5> </center></td>
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
  <table width="90%"  align="center"  cellspacing ='10'  class="table table-bordered"  cellpadding="10">
<tr>
  <th colspan="2" ><h4><center><strong>Información General</strong></center> </h4></th>
  </tr> 
 <tr >
    <th >Código: </th>
    <td >
     <?= $grupos->codigoG ?>
    </td>
    </tr>

  <tr >
    <th  >Tema: </th>
    <td ><?= $grupos->tema?></td>
  </tr>

  <tr >
    <th  >Carrera: </th>
    <td >
      <?php foreach($carreras as $car) {?>
        <?php if($car->idcarrera==$grupos->idcarrera) {?>
          <?= $car->nombre?>
         <?php } ?> 
       <?php } ?> 
    </td>
    </tr>

  <tr >
    <th  >Tipo de Proceso: </th>
    <td >
      <?php foreach($tiproceso as $tip) {?>
        <?php if($tip->idtipotema==$grupos->idtipotema) {?>
          <?= $tip->tema?>
        <?php } ?> 
       <?php } ?> 
      </td>
  </tr>
  <tr >
    <th  >Fecha de Registro: </th>
    <td >
     <?= \Carbon\Carbon::parse($grupos->fecharegistro )->format('d-m-Y') ?> 
    </td>
    </tr>
  <tr >
    <th  >Integrantes: </th>
    <td >
        <?php foreach($mostraintegrante as $mint) {?>
          <?php if($mint->idgrupo==$grupos->idgrupo) {?>
            <?php foreach($estudiantes as $est) {?>
              <?php if($mint->idestudiante==$est->idestudiante) {?>
                <?php foreach($personas as $per) {?>
                  <?php if($per->idpersona == $est->idpersona) {?>
                    <?= $est->carnet?> <?=$per->nombres?> <?=$per->apellidos?> <br>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            <?php } ?>
         <?php } ?>
        <?php } ?>            
                  </td>
  </tr>
  <tr >

    <th  >Asesor/es: </th>
    <td >
      <?php foreach($asesores as $ase) {?>
        <?php if($ase->idgrupo==$grupos->idgrupo) {?>
          <?php foreach($docentes as $doc) {?>
            <?php if($ase->iddocente==$doc->iddocente) {?>
              <?php foreach($personas as $per) {?>
                <?php if($per->idpersona==$doc->idpersona) {?>
                  <?php foreach($tipoasesor as $tias) {?>
                    <?php if($tias->idtipoasesor==$ase->idtipoasesor) {?>
                      <?= $doc->titulo?> <?=$per->nombres?> <?=$per->apellidos?> - <?=$tias->tipoasesor?>
                   <br>
                   <?php } ?>
                  <?php } ?>
                <?php } ?>
             <?php } ?>
           <?php } ?>
          <?php } ?>
       <?php } ?>
    <?php } ?>           
                  </td>
  </tr>
 <tr>
   <th>Número de Acuerdo: </th>
   <?php foreach($nAcuerdos as $na) {?>
        <?php if($na->idgrupo==$grupos->idgrupo && $na->idsolicitud==1 ) {?>
          <?php if($na->nacuerdo!="") {?>
   <td>    <?= $na->nacuerdo ?>   </td>
       <?php } ?>
        <?php } ?>
    <?php } ?> 
 </tr>
   
  
</table>




                

                


  <table width="90%"  align="center"  cellspacing ='10'   class="table table-bordered"   cellpadding="10" >
    <thead>
    <tr>
  <th colspan="4" align="center"><center><h4><strong>Actividades</strong></h4></center></th>
  </tr>
      <tr>
        <th>N°</th>
        <th>Actividades Realizadas</th> 
        <th>Fecha</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody >
      <?php $cont=0; ?>
      
        <?php foreach($gsol as $gs) { ?>
            <?php if($gs->idgrupo==$grupos->idgrupo ) {?>
              <?php foreach($Solicitudes as $sol) {?>
                <?php if($sol->idsolicitud==$gs->idsolicitud){?>

                  <tr>
                    <?php $cont++; ?>
                    
                   <td><?php echo $cont;  ?></td>

                   <td ><?= $sol->nombre ?></td>
                   <td ><?= \Carbon\Carbon::parse($gs->fecha )->format('d-m-Y') ?> </td> 

                

                   <?php if($gs->condicion==false) {?>
                    <td >Cancelado </td> 
                   <?php } else { ?> 

                   <?php if($gs->estado==0) {?>
                    <td >Enviado a: Junta Directiva  </td> 
                   <?php } else { ?>

                   <?php if($gs->estado==1) {?>
                    <td >Aprobado  </td>
                   <?php } else {?>

                   
                 <?php foreach($roles as $rl) {?>
                  <?php if($gs->estado==$rl->idrol) {?> 
                  <td>Enviado a: <?= $rl->nombre ?>  </td>
                  <?php } ?>

                  <?php } ?> 
                  
                  <?php } ?>   
                  <?php } ?>  
                  <?php } ?>          
                </tr>
              <?php } ?>
            <?php } ?>
          <?php } ?> 
        <?php } ?> 

    </tbody>
  </table>
  </div>

</body>
</html>