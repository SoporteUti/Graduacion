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
  <td  ><center><img src="img/minerva2.png"  width="100px" height="120px" align="center" ></img></center> </td>
  <td><center><h4>Universidad de El Salvador<br>Facultad Multidisciplinaria Paracentral </h4><h5>Información de Docente</h5></center></td>
  <td ><center><img src="img/ic_launcher.png"  width="100px" height="100px"  align="center"></img>  </center></td>
  </tr>
  
</table>
  </div>
  <div id="footer">
    <table width="100%" align="center" border="0" >
     <tr>
       <th ><p ><?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?> - <?php $time = time();  echo date("(h:i:s A)", $time); ?> </p> </th>
       <th> <p align="right" class="page">Página </p> </th>
     </tr>
     </table> 
  </div>
  <div id="content">
  <table  width="70%"  align="center"  cellspacing ='10'   class=" table table-bordered "  style="border: gray 1px solid;" cellpadding="10">
   <tr>
  <th colspan="2"><h4> <strong>Información General</strong></h4></th>
  </tr>
  <tr >
    <th >Nombres: </th>
    <td ><?= $personas->nombres ?></td>
    
  </tr>
  <tr> 
    <th >Apellidos: </th>
    <td ><?= $personas->apellidos ?></td>
  </tr>
  <tr>
  <th>Sexo: </th>
  <td > 
    <?php foreach($docentes as $doc) {?>
      <?php if($doc->idpersona==$personas->idpersona) {?>
        <?php if($personas->sexo==0) {?>  
          Femenino
        <?php } ?>
        <?php if($personas->sexo==1)  {?>
          Masculino
       <?php } ?>      
       <?php } ?>
     <?php } ?>
  </td>
  </tr>
  <tr>
    <th>Categoria: </th>
    <td >
        <?php foreach($docentes as $doc) {?>
          <?php if($doc->idpersona==$personas->idpersona) {?>
            <?php foreach($categorias as $cat) {?>
              <?php if($cat->idcategoria==$doc->idcategoria) {?>
                <option value="{{$cat->idcategoria}}"><?= $cat->nombrecat ?></option>
              <?php } ?> 
            <?php } ?> 
          <?php } ?> 
        <?php } ?> 

        <?php foreach($categorias as $cat) {?>
          <?php if($cat->condicion==true) {?>

          <?php } ?>
        <?php } ?>
  </td>
  </tr>
   <tr>
    <th>D.U.I: </th>
    <td > <?= $personas->dui ?></td>
  </tr>

  

   <tr>
    <th>Fecha de Nacimiento: </th>
    <td ><?=  \Carbon\Carbon::parse($personas->fechanac )->format('d-m-Y')  ?></td> 
     </tr>

  <tr>
    <th >Título: </th>
    <td >
      <?php foreach($docentes as $do) {?>
        <?php if($personas->idpersona==$do->idpersona) { ?>
          <?= $do->titulo ?>
        <?php } ?>
      <?php } ?>       
  </td>
  </tr> 
  
  <tr>
  <th colspan="2"><h4> <strong>Contacto</strong></h4></th>
  </tr>
  <tr>
    <th>Teléfono: </th>
    <td > <?= $personas->telefono ?></td>
   </tr>

  <tr>
    <th>Correo: </th>
    <td ><?= $personas->correo ?></td>
     </tr>

  <tr>
    <th>Dirección: </th>
    <td ><?= $personas->direccion ?></td>
     </tr>

  <tr>
    <th>Lugar de Trabajo: </th>
    <td >
      <?php foreach($docentes as $do) {?>
        <?php if($personas->idpersona==$do->idpersona) {?>
          <?=$do->lugar ?>
        <?php } ?>
      <?php } ?> 
    </td>
  </tr>
  
</table>
  </div>

</body>
</html>