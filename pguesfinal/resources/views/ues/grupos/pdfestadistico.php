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
  <td><center><h4>Universidad de El Salvador<br>Facultad Multidisciplinaria Paracentral </h4><h5>Datos Estadisticos.</h5> </center></td>
  <td ><center><img src="img/ic_launcher.png"  width="100px" height="100px"  align="center"></img>  </center></td>
  </tr>
</table>
  </div>
  <div id="footer">
    <table width="100%" align="center" border="0" >
     <tr>
       <th> <p class="page">Página </p> </th>
       <th ><p align="right"> San Vicente, <?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?> - <?php $time = time();  echo date("(h:i:s A)", $time); ?> </p> </th>
     </tr>
     </table> 
  </div>
  <div id="content">
    <table width="90%"  align="center"  cellspacing ='10'  class="table table-bordered"  cellpadding="10">
<tr>
  <th colspan="4" ><h4 align="center"> <strong>Información.</strong></h4></th>
  </tr> 
<tr >
    <th >N° de Trabajos de Activos: </th>
    <td ><?= $gruposActivos ?></td>
    <th >N° de Trabajos de Inactivos: </th>
    <td ><?= $gruposInactivos ?></td>
</tr>

<tr>
    <th >N° de Estudiantes de Activos: </th>
    <td ><?= $estActivos ?>  </td>
    <th >N° de Estudiantes de Inactivos: </th>
    <td ><?= $estInactivos ?></td>
</tr>

</table>
  </div>
</body>
</html>