

<?php $__env->startSection('contenido'); ?>

 <div class="col-md-12 " style="margin-top:20px;">
 <br/>

<div class="panel  panel-info">
        <div class="panel-heading"> <h5><img src="<?php echo e(URL::asset('img/historial.png')); ?>" width="20px" height="20px"></img>Historial de Usuario</h5> </div>
          <table id="user" class="table table-striped table-bordered">

  <tr>
    <td><label class="control-labe">Usuario</label></td>
    <td><?php echo $usuario->name ?></td>
       
  </tr>
  <tr>             
    <td> <label class="control-labe">Docente</label></td>
    <td><?php echo $persona->nombres.' '.$persona->apellidos ?></td>
  </tr>
</table>
</div>



    <div class="panel">
<div class="panel-heading" style="background:#00a65a; color:white"> <strong><h4><img src="<?php echo e(URL::asset('img/actividades.png')); ?>" width="20px" height="20px"></img> Actividades</h4> </strong></div>
<table id="example" class="table table-striped table-bordered" >
<thead>  <tr>
    <th scope="col">No.</th>
    <th scope="col">Accion</th>  
    <th scope="col">Datos</th>
    <th scope="col">Fecha</th> 
  </tr>
  </thead>
<tbody>
<?php $cont=1; ?>
<?php foreach($bitacora as $bit): ?>
  <tr>
    <td><?php echo $cont; $cont++ ?></td>
    <td><?php echo $bit->accion?></td>
    <td><?php echo $bit->datos?></td>  
    <td><?php echo $bit->fecha?></td>  
   

  </tr>
 <?php endforeach; ?>
  </tbody>
</table>
        <div class="panel-footer " style="background-color: #00a65a;">
           <center>
            
        <button type="button" onclick="location.href = '<?php  echo url('ues/seguridad/bitacora');?>'" style="width:20%" class="btn btn-danger " id="btnSalir" name="btnSalir">Cerrar</button>
             </center>
            </div>
</div>
</div>
   
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>

$(document).ready(function() {
    $('#example').DataTable({
      "order":[[2,"asc"]],
    "language":{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     " Mostrar _MENU_ registros ",
    "sZeroRecords":    " No se encontraron resultados ",
    "sEmptyTable":     " Ningún dato disponible en esta tabla ",
    "sInfo":           " Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros ",
    "sInfoEmpty":      " Mostrando registros del 0 al 0 de un total de 0 registros ",
    "sInfoFiltered":   " (filtrado de un total de _MAX_ registros) ",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar: ", 
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    " Primero ",
        "sLast":     " Último ",
        "sNext":     " Siguiente ",
        "sPrevious": " Anterior "
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
}
}



        );
} );

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>