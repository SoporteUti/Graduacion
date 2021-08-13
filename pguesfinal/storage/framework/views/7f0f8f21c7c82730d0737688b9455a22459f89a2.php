<!DOCTYPE html>
<html lang="es">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
          html {
margin:6cm 2cm 2cm 2cm;
}
     
    @page  { font-family: "Times New Roman", serif;}
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 100px; background-color: white; text-align: center;  }
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
  <td><center><h4>Universidad de El Salvador<br>Facultad Multidisciplinaria Paracentral </h4><h5>Listado de Usuarios Departamento de 

    <?php foreach($departamento as $depto): ?>
<?php if($depto->iddepartamento==$iddepto): ?>

<?php echo e($depto->nombre); ?>

 <?php endif; ?>
  <?php endforeach; ?>
</h5></center></td>
  <td ><center><img src="img/ic_launcher.png"  width="100px" height="100px"  align="center"></img>  </center></td>
  </tr>
  
</table>
  </div>
  <div id="footer">
    <table width="100%" align="center" border="0" >
     <tr>
  
       <th ><p ><?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?> - <?php $time = time();  echo date("(h:i:s A)", $time); ?> </p> </th>
              <th> <p  align="right" class="page">Página </p> </th>
     </tr>
     </table> 
  </div>
  <div id="content">
    <table width="100%" cellpadding ='0' align="center"  cellspacing ='10'   class=" table table-bordered"  cellpadding="10">

                 <thead>
                   <tr>
                     <th>N°</th>
                     <th>Nombre Completo</th> 
                     
                     <th>Rol/es</th>
                    

                   </tr>
                 </thead>
                 <tbody>
                  <?php $cont=1; ?>
                  <?php foreach($docentesU as $doc): ?>
                  
                      
                  <tr>
                   <td><?php echo $cont; $cont++ ?></td>
                   <td hidden="" ><?php echo e($doc->idpersona); ?></td>
                   <td ><?php echo e($doc->nombre); ?> <?php echo e($doc->apellidos); ?></td>
                   

                  
                 
                   <td>  
                    <ul>
                   	<?php foreach($docentes as $ds): ?>
                   	<?php if($doc->idpersona== $ds->idpersona): ?>

                   	<?php foreach($rol_carreras as $rc): ?>
                   	<?php if($rc->iddocente==$ds->iddocente): ?>
                   	

                   	

                   <?php foreach($roles as $rl): ?>
                   <?php if($rl->idrol==$rc->idrol): ?>
                   <li type="disc">

                   <?php echo e($rl->nombre); ?>

                   <?php endif; ?>
                   <?php endforeach; ?>

                   	-
                  
				   <?php foreach($carreras as $car): ?>
                   <?php if($car->idcarrera==$rc->idcarrera): ?>
                   <?php echo e($car->nombre); ?>

                   </li>
                   <?php endif; ?>
                   <?php endforeach; ?>

                   <?php endif; ?>
                   	<?php endforeach; ?>
                   	<?php endif; ?>
                   	<?php endforeach; ?>
                    </ul>
                  </td> 
             
                     </tr>
             
                     <?php endforeach; ?>
                   </tbody>
                 </table>
  </div>

</body>
</html>