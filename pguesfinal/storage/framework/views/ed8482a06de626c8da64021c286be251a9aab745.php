<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    html {
      margin: 5cm 2cm 2cm 2cm;
    }

    @page  {
      font-family: "Times New Roman", serif;
    }

    #header {
      position: fixed;
      left: 0px;
      top: -125px;
      right: 0px;
      height: 100px;
      background-color: white;
      text-align: center;
    }

    #footer {
      position: fixed;
      left: 0px;
      bottom: -180px;
      right: 0px;
      height: 200px;
      background-color: white;
      font-family: Times New Roman;
    }

    #footer .page:after {
      content: counter(page, decimal);
    }

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
    <table width="100%" align="center" border="0">
      <tr>
        <td>
          <center><img src="img/minerva2.png" width="100px" height="110px" align="center"></img></center>
        </td>
        <td>
          <center>
            <h4>Universidad de El Salvador<br>Facultad Multidisciplinaria Paracentral </h4>
            
            <h5>Estudiantes Ciclo <?php echo e($ciclo); ?>.</h5>
           
          </center>
        </td>
        <td>
          <center><img src="img/ic_launcher.png" width="100px" height="100px" align="center"></img> </center>
        </td>
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
    <table  width="90%"  align="center"  cellspacing ='10'   class=" table table-bordered "  style="border: gray 1px solid;" cellpadding="10">

<!-- <table class="table table-hover dataTable"> -->
        <thead  >
          <tr align="center">
            <th>N°</th>
            <th>Carné</th><!--celda-->
            <th>Nombres</th><!--celda-->
            <th>Apellidos</th><!--&& $element->idcarrera==Auth::user()->idcarrera-->
          </tr>
        </thead>
        <tbody>
         <?php $cont=1; ?>
          <?php foreach($persona as $per) { ?>
            <?php if($per->tipo=='estudiante') { ?>
              <?php foreach ($estudiantes as $element) { ?>
                <?php if($element->idpersona==$per->idpersona && $element->idcarrera==Auth::user()->idcarrera) { ?>
                  <?php if($element->ciclo==$ciclo) {?>
          <tr>
            <td ><?php echo $cont; $cont++ ?></td>
            <td ><?= $element->carnet ?></td>
            <td><?= $per->nombres ?></td>
            <td><?= $per->apellidos ?></td>
                       
          </tr>
                  <?php } ?> 
                <?php } ?>     
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </tbody>
</table>

    
  </div>
</body>

</html>