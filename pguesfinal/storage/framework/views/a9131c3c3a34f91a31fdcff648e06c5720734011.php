<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
    html {
      margin: 6cm 2cm 2cm 2cm;
    }

    @page  {
      font-family: "Times New Roman", serif;
    }

    #header {
      position: fixed;
      left: 0px;
      top: -180px;
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
            <h4>Universidad de El Salvador<br>Facultad Multidisplinaria Paracentral </h4>
            <h5>Información.</h5>
          </center>
        </td>
        <td>
          <center><img src="img/ic_launcher.png" width="100px" height="100px" align="center"></img> </center>
        </td>
      </tr>
    </table>
  </div>
  <div id="footer">
    <p class="page">Página </p>
  </div>
  <div id="content">
    <table width="90%" align="center" cellspacing='10' class="table table-bordered" cellpadding="10">
      <tr>
        <th colspan="4">
          <h4 align="center"> <strong>Generalidades.</strong></h4>
        </th>
      </tr>
 
      <tr>
        <th>Departamento: </th>
        <td> <?php echo e($departamento->nombre ?? ''); ?>

        </td>
        <th>Año: </th>
        <td><?php echo e($anioseleccionado ?? ''); ?></td>
      </tr>
      <tr>
        <th>Carrrera: </th>
        <td colspan="3">
          <?php echo e($carrera->nombre ?? ''); ?>

        </td>
      </tr>
      <tr>
        <th>Estado: </th>
        <td> <?php echo e($estado ?? ''); ?></td>

        <th>Total: </th>
        <td> <?php echo e(count($grupos)); ?></td>
      </tr>
    </table>

    <table width="100%" align="center" cellspacing='10' class=" table table-bordered" style="border: gray 1px solid;"
      cellpadding="10">
      <tr>
        <th colspan="4">
          <h4 align="center"> <strong>Grupos.</strong></h4>
        </th>
      </tr>
      <thead>
        <!--fila-->
        <tr>
          <!--celda-->
          <th>N°</th>
          <th>Código</th>
          <!--celda-->
          <th>Tema</th>
          <!--celda-->
          <th>Fecha de Registro</th>
          <!--celda-->
        </tr>
      </thead>
      <?php 
      $cont=1;
       ?>

      <?php foreach($grupos as $grupo): ?>
      <tr>
        <td><?php echo e($cont++); ?></td>
        <td><?php echo e($grupo->codigoG); ?></td>
        <td><?php echo e($grupo->tema); ?></td>
        <td><?php echo e(\Carbon\Carbon::parse($grupo->fecharegistro )->format('d-m-Y')); ?></td>
      </tr>
      <?php endforeach; ?>

    </table>
  </div>
</body>

</html>