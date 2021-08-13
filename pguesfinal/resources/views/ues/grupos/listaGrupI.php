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
  <td ><center><img src="img/minerva2.png"  width="100px" height="120px" align="center" ></img></center>
  </td>
  <td><center><h4>Universidad de El Salvador<br>Facultad Multidisciplinaria Paracentral </h4><h5>Lista de Grupos Inactivos  <br>
          <?php if (Auth::user()->idrol!==4){?>
            <?php foreach($carreras as $car) {?>
                <?php if($car->idcarrera==Auth::user()->idcarrera) {?>
            <?= $car->nombre ?>
            <?php } ?>
            <?php } ?>
          <?php } ?></h5> </center></td>
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
  <table width="100%"  align="center"  cellspacing ='10'   class=" table table-bordered"  style="border: gray 1px solid;" cellpadding="10">
                <thead><!--fila-->
                  <tr>
                    <th hidden=""></th><!--celda-->
                    <th width="1%">N°</th>
                    <th width="13%">Código</th><!--celda-->
                    <th >Tema</th><!--celda-->
                    <?php if (Auth::user()->idrol==4){?>
                    <th>Carrera</th>
                    <?php } ?>
                    <th>Tipo de Proceso</th><!--celda-->
                    <th >Fecha de Registro</th><!--celda-->   
                    </tr>   
                </thead>
                <?php $cont=1; ?>

               <?php foreach($grupos as $grup) {?>
                <?php if($grup->condicion==false) {?>
                {{-- @if($grup->idcarrera==Auth::user()->idcarrera)  filtra por carrera--}} 
                <tr>
                <td><?php echo $cont; $cont++ ?></td>
                <td hidden="">{{ $grup->idgrupo}}</td>                  
                    <td><?= $grup->codigoG ?></td>
                    <td><?= $grup->tema ?></td>
                    <?php if (Auth::user()->idrol==4){?>
                    <td>
                        <?php foreach($carreras as $car) {?>
                        <?php if($car->idcarrera ==$grup->idcarrera ) {?>
                        <?= $car->nombre ?>
                        <?php } ?> 
                        <?php } ?> 
                    </td>
                    <?php } ?> 
                    <td>
                        <?php foreach($tiproceso as $tip) {?>
                        <?php if($tip->idtipotema ==$grup->idtipotema ) {?>
                        <?= $tip->tema ?>
                        <?php } ?> 
                        <?php } ?> 
                    </td>                      
                    <td><?=   \Carbon\Carbon::parse($grup->fecharegistro )->format('d-m-Y')  ?></td>
                  </tr>
                 <?php } ?> 
                 <?php } ?> 

            
           
</table>
  </div>

</body>
</html>