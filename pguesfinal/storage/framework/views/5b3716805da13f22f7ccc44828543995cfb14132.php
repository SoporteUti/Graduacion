<?php $__env->startSection('contenido'); ?>

	<style type="text/css">
   .table-wrapper-scroll-y {
  display: block;
  max-height: 222px;
  overflow-y: auto;
  -ms-overflow-style: -ms-autohiding-scrollbar;
} 
  </style> 






 <?php echo e(Form::Open(array('action'=>array('EstudianteController@actDatosEstudiante'),'route'=>['ues.estudiantes.stepsEstUpdate',$persona->idpersona], 'method'=>'get', 'files' =>'true'))); ?>


  <form action="" method="post" class="form-group-sm" id="actualizar" name="actualizar" accept-charset="UTF-8" enctype="multipart/form-data" >
    
  <!-- One "tab" for each step in the form: -->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header" >
            
            <a class="navbar-brand" href="#">Actualizar Datos del Estudiante</a>
        </div>
    </div>
</nav>


<!-- Vista del correo electronico-->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group" > 
  <label>Correo electrónico</label> <span id="emailOK" style="color: #87c846;"></span>
    <div class="input-group" >     
    <span class="input-group-addon"><i class="fa fa-at"></i></span><input value="<?php echo e($persona->correo); ?>" type="text"   class="form-control" id="correo" name="correo" autofocus>
    </div> 
  </div>  
</div> 

<!-- Vista de la direccion-->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group" >   
  <label>Dirección</label>
    <div class="input-group" >  
      <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
      <input type="text"  value="<?php echo e($persona->direccion); ?>" class="form-control" id="direccion" name="direccion"  autofocus>
    </div>         
   </div>
</div>

<!-- Vista del Telefono-->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group" >
  <label>Teléfono </label>
    <div class="input-group" >     
    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
    <input type="text"  value="<?php echo e($persona->telefono); ?>"   class="form-control" id="telefono" name="telefono" data-inputmask="'mask':'9999-9999'" data-mask autofocus>
    </div>       
  </div>
</div>


<!-- vista del curruculum -->

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" align="center" >
          <button class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-primary" ><i class="fa fa-save"></i> Guardar Cambios</button>
        </div>

 </form>       

<?php echo e(Form::Close()); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>