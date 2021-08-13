<?php $__env->startSection('contenido'); ?>
    <h3>Administrar Backups</h3>
    <div class="row">
        <div class="col-xs-12 clearfix">
            <a id="create-new-backup-button" href="<?php echo e(url('backup/create')); ?>" class="btn btn-success pull-left"
               style="margin-bottom:2em;"><i
                    class="fa fa-plus"></i> Crear Nuevo Backup
            </a>
           <button class="btn btn-primary" data-toggle="modal" data-target="#modal-backup">Restaurar Base de Datos</button>
        </div>
         
           
        
        <div class="col-xs-12">
            <?php if(count($backups)): ?>

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Nombre del Archivo</th>
                        <th>Tamaño</th>
                        <th>Fecha de creación</th>
                      
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($backups as $backup): ?>
                        <tr>
                            <td><?php echo e($backup['file_name']); ?></td>
                            <td><?php echo e($backup['file_size']); ?></td>
                            <td>
                                <?php echo e(date('d/M/Y, g:ia', strtotime($backup['last_modified']))); ?>

                            </td>
                           
                            <td class="text-center">
                                <a class="btn btn-xs btn-default"
                                   href="<?php echo e(url('backup/download/'.$backup['file_name'])); ?>"><i
                                        class="fa fa-cloud-download"></i> Download</a>
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
                    <label>Archivo Backup (.sql)</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                    <input type="file" accept="application/sql" name="backup" class="form-control">
                </div>         
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Restaurar</button>
            </div>
        </div>
    </div>
</div>

<?php echo e(Form::Close()); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>