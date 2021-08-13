<?php $__env->startSection('contenido'); ?>

    <h3>Administrar Respaldo</h3>
    <div class="row">
        <div class="col-xs-12 clearfix">
            <a id="create-new-backup-button" href="<?php echo e(url('backup/create')); ?>" class="btn btn-success pull-left"
               style="margin-bottom:2em;"><i class="fa fa-plus"></i> Crear Nuevo Respaldo  </a>  
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-backup">   Restaurar Base de Datos</button>
        </div>
         
           
        
        <div class="col-xs-12">
            <?php if(count($backups)): ?>

                <table class="table table-striped table-bordered table-condensed table-hover" id="backups">
                    <thead>
                    <tr>
                         <th>N&#176;</th>
                        <th>Nombre del Archivo</th>
                        <th>Tama&#241;o</th>
                        <th>Fecha de creaci&oacute;n</th>
                      
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                         <?php 
            $index =0;
           ?>
                    <?php foreach($backups as $backup): ?>
                        <tr>
                            <td><?php echo e($index=$index+1); ?></td>
                            <td><?php echo e($backup['file_name']); ?></td>
                            <td><?php echo e($backup['file_size']); ?></td>
                            <td>
                                <?php echo e(date('d/M/Y, g:ia', strtotime($backup['last_modified']))); ?>

                            </td>
                           
                            <td class="text-center">
                                <a class="btn btn-xs btn-default"
                                   href="<?php echo e(url('backup/download/'.$backup['file_name'])); ?>"><i
                                        class="fa fa-cloud-download"></i> Descargar</a>
                                <a class="btn btn-xs btn-danger" data-button-type="delete"
                                   href="<?php echo e(url('backup/delete/'.$backup['file_name'])); ?>"><i class="fa fa-trash-o"></i>
                                    Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="well">
                    <h4>No Existen Backups en este momento</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>


<div class="modal fade" id="modal-backup">
        <?php echo e(Form::Open(array('action'=>array('BackupController@deleteDB'),'route'=>['ues.backups.deleteDB'], 'method'=>'post', 'files' =>'true'))); ?>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Restaurar Base de Datos</h4>
            </div>
            <div class="modal-body">
                
<div class="form-group" >   
                    <label>Archivo de Respaldo (.sql)</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                    <input type="file" accept="application/sql" name="backup" class="form-control">
                </div>         
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-cloud-upload "></i> Restaurar</button>
            </div>
        </div>
    </div>
</div>

<?php echo e(Form::Close()); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script>
      $(document).ready(function() {
    $('#backups').DataTable({
    
    "language":{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
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