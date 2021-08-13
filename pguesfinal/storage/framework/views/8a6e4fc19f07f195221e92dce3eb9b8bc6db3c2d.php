<?php $__env->startSection('contenido'); ?>

	<style type="text/css">
   .table-wrapper-scroll-y {
  display: block;
  max-height: 222px;
  overflow-y: auto;
  -ms-overflow-style: -ms-autohiding-scrollbar;
} 
  </style> 
 <?php echo e(Form::Open(array('action'=>array('EstudianteController@llenarEstudiantes',$persona->idpersona,),'method'=>'PATCH'))); ?>

  
    
  <!-- One "tab" for each step in the form: -->
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Datos del Estudiante</a>
        </div>
    </div>
</nav>

<!-- Vista del Carnet -->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group"> 
    <label>Carné </label>
    <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-database"></i></span>
            <?php foreach($estudiantes as $est): ?>
              <?php if($est->idpersona==$persona->idpersona): ?>         
              <input id="carnet" disabled type="text"  value="<?php echo e($est->carnet); ?>"  class="form-control" name="carnet" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="7" placeholder="Ingresar Carné" autofocus>
              <?php endif; ?>
            <?php endforeach; ?>
    </div>          
  </div>
</div>
<!-- Vista de los nombres y apellidos -->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group"> 
    <label>Nombre Completo </label>
    <div class="input-group">
        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
          <input type="text" disabled value="<?php echo e($persona->nombres); ?><?php echo e(" "); ?><?php echo e($persona->apellidos); ?>" onKeyPress="return soloLetras(event)" class="form-control" id="nombres" name="nombres">
    </div>      
  </div>
</div>
<!-- Vista de los apellidos -->
<!-- <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group"> 
    <label>Apellidos </label>
    <div class="input-group">
      <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
        <input  type="text" disabled value="<?php echo e($persona->apellidos); ?>"onKeyPress="return soloLetras(event)" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresar Apellidos" autofocus>
    </div>          
  </div>
</div> -->

<!-- sexo -->

<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group" > 
    <label>Sexo </label>          
      <div class="input-group">    
        <span class="input-group-addon"><i class="fa fa-child"></i></span>
        <select disabled name="sexo" id="sexo" class="form-inline form-control">
          <?php if($persona->sexo==0): ?>
          <option value="0">Femenino</option>}
          <?php endif; ?>
          <?php if($persona->sexo==1): ?>
          <option value="1">Masculino</option>
          <?php endif; ?>             
          </select>
      </div> 
  </div>  
</div>
<!-- Vista de la carrera -->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group"> 
    <label>Carrera </label>
    <div class="input-group">                   
      <span class="input-group-addon"><i class="fa fa-bank"></i></span>
      <select disabled="" name="carrera" id="carrera" class="form-inline form-control">
        <?php foreach($estudiantes as $est): ?>
        <?php if($est->idpersona==$persona->idpersona): ?>
        <?php foreach($carreras as $car): ?>
        <?php if($car->idcarrera==$est->idcarrera): ?>
        <option value="<?php echo e($car->idcarrera); ?>"><?php echo e($car->nombre); ?>            
        </option>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php endforeach; ?>
    </select>
  </div>          
  </div>
</div>
<!-- Vista del correo electronico-->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group" > 
  <label>Correo electrónico</label> <span id="emailOK" style="color: #87c846;"></span>
    <div class="input-group" >     
    <span class="input-group-addon"><i class="fa fa-at"></i></span><input disabled value="<?php echo e($persona->correo); ?>" type="text"   class="form-control" id="correo" name="correo" autofocus>
    </div> 
  </div>  
</div> 
<!-- Vista de la fecha de nacimientos-->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group"> 
  <label>Fecha de Nacimiento </label>   
    <div class="input-group">  
      <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
      <input type="date" disabled value="<?php echo e($persona->fechanac); ?>" class="form-control" id="fechanac" name="fechanac" autofocus>
    </div>         
  </div>
</div>
<!-- Vista de la direccion-->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group" >   
  <label>Dirección</label>
    <div class="input-group" >  
      <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
      <input type="text" disabled value="<?php echo e($persona->direccion); ?>" class="form-control" id="direccion" name="direccion"  autofocus>
    </div>         
   </div>
</div>
<!-- Vista del Dui-->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group" >   
  <label>DUI</label>
    <div class="input-group" >  
    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
    <input disabled value="<?php echo e($persona->dui); ?>" type="text" data-inputmask="'mask':'99999999-9'"  data-mask class="form-control" id="dui" name="dui" autofocus>
    </div>         
  </div>
</div>
<!-- Vista del Telefono-->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group" >
  <label>Teléfono </label>
    <div class="input-group" >     
    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
    <input type="text" disabled value="<?php echo e($persona->telefono); ?>"   class="form-control" id="telefono" name="telefono" data-inputmask="'mask':'9999-9999'" data-mask autofocus>
    </div>       
  </div>
</div>
<!-- vista de la fecha de egreso -->
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group" >  
  <label>Fecha de Egreso</label>
    <div class="input-group" >  
    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
      <?php foreach($estudiantes as $est): ?>
      <?php if($est->idpersona==$persona->idpersona): ?> 
        <input disabled value="<?php echo e($est->anioegreso); ?>" type="mouth" class="form-control" id="anioegreso" name="anioegreso" onKeyPress="return soloNumeros(event)" maxlength="4"  autofocus>
      <?php endif; ?>
      <?php endforeach; ?>
    </div>         
  </div>
</div>
<!-- vista del curruculum -->
<?php foreach($estudiantes as $est): ?> 
<?php if($est->idpersona==$persona->idpersona): ?> 
<?php if($est->curriculum!=""): ?>
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
  <div class="form-group" >
  <label>Curriculum Vitae</label>             
    <div class="input-group" >    
      <a href="<?php echo e(asset('storage/curriculums/'.$est->curriculum)); ?>" target="_blank" >
      <i  class="fa fa-file-pdf-o fa-4x fa-lg"></i></a>
    </div>       
    </div>
</div>
<?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>

<?php echo e(Form::Close()); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>