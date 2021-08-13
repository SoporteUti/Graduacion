<?php $__env->startSection('contenido'); ?>

<div class="row" >
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
        <h3>Listado de Grupos  
        <?php if(Auth::user()->idrol!=5 && Auth::user()->idrol!=6 && Auth::user()->idrol!=4 && Auth::user()->idrol!=2 ): ?>
         <button class="btn btn-success" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalagregargrupo"><i class="fa fa-file-o"></i> Nuevo</button>  
         <?php endif; ?>
         

	 <?php if(Auth::user()->idrol!=6 && Auth::user()->idrol!=5 && Auth::user()->idrol!=4): ?>
         <a><button onclick="ventana()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> Activos </button></a>  <a><button onclick="ventanaI()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> Inactivos </button></a> 

 <?php endif; ?>
      <?php if(Auth::user()->idrol==4 ||  Auth::user()->idrol==1 ): ?>
         <a href="#Informaci�n" data-toggle="modal" data-target="#modal-estadisticos"><button class="btn btn-info"><i class="fa fa-file-pdf-o" ></i> Informaci&oacute;n </button></a>
        <?php echo $__env->make('ues.grupos.estadisticos', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
 <?php endif; ?>

         </h3>
    </div>
</div>
<?php echo Form::open (array('route' => 'ues.grupos.store','method'=>'POST','autocomplete'=>'off', 'files' =>'true')); ?>

        <?php echo e(Form::token()); ?>

        <?php if(count($errors)>0): ?>
    <div class="alert alert-danger">
        <ul>
        <?php foreach($errors->all() as $error): ?>
            <li><?php echo e($error); ?></li> 
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
<div id="modalagregargrupo" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
  <form id="gruppo" role="form" method="post"  enctype="multipart/form-data">
    <!--=====================================
    CABEZA DEL MODAL
    ======================================-->
    <div class="modal-header" style="background:#00a65a; color:white">

    <?php /* #17a2b8; */ ?>
    <h4 class="modal-title">Agregar Grupo</h4>
    </div>
    <!--=====================================
    CUERPO DEL MODAL
    ======================================-->
    <div class="modal-body">
      <div class="box-body">
        <!-- ENTRADA PARA EL NOMBRE -->
    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <label>Código (*)</label>
            <div class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="codigoG" type="text" class="form-control" name="codigoG" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="11" placeholder="Ingresar Código" autofocus >
            </div>          
        </div>
    </div> 

    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
        <div class="form-group"> 
            <label>Fecha de Registro (*)</label>   
            <div class="input-group">  
                <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                <input type="date" class="form-control" id="fecharegistro" name="fecharegistro" step="1" value="<?php echo date("d-m-y");?>" >
            </div>         
        </div>
    </div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idcarrera" type="text" class="form-control" name="idcarrera" value="<?php echo e(Auth::user()->idcarrera); ?>" >
            </div>          
        </div>
    </div> 


    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" > 
        <div class="form-group"> 
            <label>Tipo de Proceso (*)</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                <select name="idtipoT" id="idtipoT" class="form-inline form-control">
                    <option value="">[Seleccione]</option>
                <?php foreach($tiproceso as $tip): ?>
               
                <?php if($tip->condicion==true && $tip->idcarrera==Auth::user()->idcarrera): ?>
                <option value="<?php echo e($tip->idtipotema); ?>"><?php echo e($tip->tema); ?></option>
                <?php endif; ?>
               
                <?php endforeach; ?>
                </select>
            </div>          
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >           
        <div class="form-group"> 
            <label>Tema(*)</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                <textarea name="tema" id="tema" class="form-control rounded-0" rows=""  placeholder="Ingresar el tema"></textarea>
            </div>          
        </div>
    </div>    

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" > 
        <div class="form-group"> 
            <label>Integrantes(*)</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                <select  data-placeholder="Seleccione Estudiantes" multiple class="form-control chosen-select" name="estudiantes[]" >
                <option value="">[Seleccione]</option>
                    <?php foreach($personas as $per): ?>
                    <?php foreach($integrantes as $int): ?>
                    <?php if($per->idpersona == $int->idpersona && $int->idcarrera==Auth::user()->idcarrera): ?>
                    <?php if($per->condicion==true ): ?>
                    <option value="<?php echo e($int->idestudiante); ?>"><?php echo e($int->carnet." ".$per->nombres." ".$per->apellidos); ?></option>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
                </select>
            </div>          
        </div>
    </div>
        
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" > 
        <div class="form-group"> 
            <label>Asesores(*)</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                <select data-placeholder="Seleccione Docentes" class="chosen-select form-control" name="docase" id="docase" >
                    <option value="-99">[Seleccione Docentes]</option>
                    <?php foreach($personas as $per): ?>
                    <?php foreach($docentes as $docente): ?>
                    <?php if($per->idpersona == $docente->idpersona): ?>
                    <?php if($per->condicion==true): ?>
                    <option value="<?php echo e($docente->iddocente); ?>"><?php echo e($docente->titulo." ".$per->nombres." ".$per->apellidos); ?></option>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
                </select>
            </div> 
            <label>Tipo de Asesor(*)</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-dedent"></i></span>
                <select name="tiposc" id="tiposc" class="chosen-select form-control">
                    <option value="-99">[Seleccione Tipo]</option>
                    <?php foreach($tipoasesor as $asesor): ?>
                    <option value="<?php echo e($asesor->idtipoasesor); ?>"><?php echo e($asesor->tipoasesor); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>  
            <span class="input-group-btn"><button  type="button" class="btn btn-success btn-block btn-block btn-add-phone"><i class="glyphicon glyphicon-plus"></i>Agregar</button></span>
            <div class="asesorlst"></div>  
        </div>
    </div>  

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
        <div class="form-group" >   
            <label>Propuesta de Tema(*)</label>
             <div class="input-group" >  
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                    <input type="file" accept="application/pdf" id="propuesta" name="propuesta" class="form-control">
            </div>         
        </div>
    </div> 
    
      </div>
    </div>

    <!--=====================================
    PIE DEL MODAL
    ======================================-->

    <div class="modal-footer">
      <button id="cancel1" type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>  Salir</button>
      <button id="cancel" class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
    </div>
  </form>
</div>
</div>
</div>

<?php echo Form::close(); ?>


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="table-responsive">
            <table class="table table-striped table-bordered table-condensed table-hover" id="grupo">
              
                <?php $cont=1; ?>

                <?php if(Auth::user()->idrol==4): ?>
  <thead><!--fila-->
                    <th hidden=""></th><!--celda-->
                    <th>N°</th>
                    <th>Código</th><!--celda-->
                    <th width="25%">Tema</th><!--celda-->
                 
                    <th>Tipo de Proceso</th><!--celda-->
                   
                    <th  >Carrera</th>
                 
                     <th hidden=""  >Departamento</th>
                    <th width="10%">Fecha de Registro</th><!--celda-->
                    <th>Estado</th><!--celda-->
                    <th>Opciones</th><!--celda-->           
                </thead>
                <?php foreach($grupos as $grup): ?>
                <?php /* <?php if($grup->idcarrera==Auth::user()->idcarrera): ?>  filtra por carrera*/ ?> 
                <tr>
                <td><?php echo $cont; $cont++ ?></td>
                <td hidden=""><?php echo e($grup->idgrupo); ?></td>                  
                    <td><?php echo e($grup->codigoG); ?></td>
                    <td><?php echo e($grup->tema); ?></td>
                  
                    <td>
                        <?php foreach($tiproceso as $tip): ?>
                        <?php if($tip->idtipotema ==$grup->idtipotema ): ?> 
                        <?php echo e($tip->tema); ?>

                        <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                    <td  > <?php foreach($carreras as $carr): ?>
                        <?php if($carr->idcarrera ==$grup->idcarrera ): ?> 
                        <?php echo e($carr->nombre); ?>

                        <?php $coddep=$carr->iddepartamento; ?>
                        <?php endif; ?>
                        <?php endforeach; ?></td>    

                        <td hidden="" > <?php foreach($departamentos as $dep): ?>
                        <?php if($dep->iddepartamento == $coddep ): ?> 
                        <?php echo e($dep->nombre); ?>

                        
                        <?php endif; ?>
                        <?php endforeach; ?></td>                       
                    <td><?php echo e(\Carbon\Carbon::parse($grup->fecharegistro )->format('d-m-Y')); ?></td>
                    <td> <?php if($grup->condicion==true): ?> Activo
                     <?php else: ?>
                    Inactivo
                    <?php endif; ?> </td>
                <td>
                        
<?php if($grup->condicion==true): ?>

                 
                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success " onclick="btncod"><i class="fa fa-eye"></i></button></a>
            
                 <a href="<?php echo e(route('ues.grupos.vista_director',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>

                 
<?php else: ?>
               
                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
             
                <a href="<?php echo e(route('ues.grupos.vista_director',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>

                

<?php endif; ?>              
            <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
               <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
                </tr>
               <?php echo $__env->make('ues.grupos.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

              <!-- <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
               <?php /*<?php endif; ?>    filtra por carrera*/ ?>
               <?php endforeach; ?>

                <?php endif; ?>



                <?php if(Auth::user()->idrol==1): ?>
  <thead><!--fila-->
                    <th hidden=""></th><!--celda-->
                    <th>N°</th>
                    <th>Código</th><!--celda-->
                    <th width="25%">Tema</th><!--celda-->
                 
                    <th>Tipo de Proceso</th><!--celda-->
                   
                 
                    <th width="10%">Fecha de Registro</th><!--celda-->
                    <th>Estado</th><!--celda-->
                    <th>Opciones</th><!--celda-->           
                </thead>
                <?php foreach($grupos as $grup): ?>
                 <?php /*<?php if($grup->idcarrera==Auth::user()->idcarrera): ?>  filtra por carrera*/ ?> 
                <tr>
                <td><?php echo $cont; $cont++ ?></td>
                <td hidden=""><?php echo e($grup->idgrupo); ?></td>                  
                    <td><?php echo e($grup->codigoG); ?></td>
                    <td><?php echo e($grup->tema); ?></td>
                    <td>
                        <?php foreach($tiproceso as $tip): ?>
                        <?php if($tip->idtipotema ==$grup->idtipotema ): ?> 
                        <?php echo e($tip->tema); ?>

                        <?php endif; ?>
                        <?php endforeach; ?>
                    </td>                      
                    <td><?php echo e(\Carbon\Carbon::parse($grup->fecharegistro )->format('d-m-Y')); ?></td>
                    <td> <?php if($grup->condicion==true): ?> Activo
                     <?php else: ?>
                    Inactivo
                    <?php endif; ?> </td>
                <td>
                        
<?php if($grup->condicion==true): ?>

                      <a href="" data-target="#modal-edit-<?php echo e($grup->idgrupo); ?>" data-toggle="modal">
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success " onclick="btncod"><i class="fa fa-eye"></i></button></a>
                <a href="" data-target="#modal-delete-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>
                 <a href="<?php echo e(route('ues.grupos.steps',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>

                
<?php else: ?>
                <a href=""  data-target="" data-toggle="modal">
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                <a href="" data-target="#modal-modalup-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>
                <a href="<?php echo e(route('ues.grupos.steps',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>

               

<?php endif; ?>              
            <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
               <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
                </tr>
               <?php echo $__env->make('ues.grupos.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

              <!-- <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
               <?php /*@endiffiltra  por carrera*/ ?>
               <?php endforeach; ?>

                <?php endif; ?>



<?php /*este es solo para jefes*/ ?>               


                <?php if(Auth::user()->idrol==2): ?>
  <thead><!--fila-->
                    <th hidden=""></th><!--celda-->
                    <th>N°</th>
                    <th>Código</th><!--celda-->
                    <th width="25%">Tema</th><!--celda-->
                 
                    <th>Tipo de Proceso</th><!--celda-->
                 
                     
                    <th width="10%">Fecha de Registro</th><!--celda-->
                    <th>Estado</th><!--celda-->
                    <th>Opciones</th><!--celda-->           
                </thead>
                <?php foreach($grupos as $grup): ?>
                 <?php if($grup->idcarrera==Auth::user()->idcarrera): ?>  <?php /*filtra por carrera*/ ?> 
                <tr>
                <td><?php echo $cont; $cont++ ?></td>
                <td hidden=""><?php echo e($grup->idgrupo); ?></td>                  
                    <td><?php echo e($grup->codigoG); ?></td>
                    <td><?php echo e($grup->tema); ?></td>
                    <td>
                        <?php foreach($tiproceso as $tip): ?>
                        <?php if($tip->idtipotema ==$grup->idtipotema ): ?> 
                        <?php echo e($tip->tema); ?>

                        <?php endif; ?>
                        <?php endforeach; ?>
                    </td>                      
                    <td><?php echo e(\Carbon\Carbon::parse($grup->fecharegistro )->format('d-m-Y')); ?></td>
                    <td> <?php if($grup->condicion==true): ?> Activo
                     <?php else: ?>
                    Inactivo
                    <?php endif; ?> </td>
                <td>
                        
<?php if($grup->condicion==true): ?>

                 
                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success " onclick="btncod"><i class="fa fa-eye"></i></button></a>
                
                 <a href="<?php echo e(route('ues.grupos.steps',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>
                 
<?php else: ?>
               
                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
               
                <a href="<?php echo e(route('ues.grupos.steps',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>
               

<?php endif; ?>              
            <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
               <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
                </tr>
               <?php echo $__env->make('ues.grupos.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

              <!-- <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
               <?php endif; ?><?php /*filtra por carrera*/ ?>
               <?php endforeach; ?>

                <?php endif; ?>




<?php /*este es solo para jefes*/ ?> 


<?php /*este es solo para coordinadores*/ ?>               


                <?php if(Auth::user()->idrol==3): ?>
                  <thead><!--fila-->
                    <th hidden=""></th><!--celda-->
                    <th>N°</th>
                    <th>Código</th><!--celda-->
                    <th width="25%">Tema</th><!--celda-->
                 
                    <th>Tipo de Proceso</th><!--celda-->
                  
                     
                    <th width="10%">Fecha de Registro</th><!--celda-->
                    <th>Estado</th><!--celda-->
                    <th>Opciones</th><!--celda-->           
                </thead>
                <?php foreach($grupos as $grup): ?>
                 <?php if($grup->idcarrera==Auth::user()->idcarrera): ?>  <?php /*filtra por carrera*/ ?> 
                <tr>
                <td><?php echo $cont; $cont++ ?></td>
                <td hidden=""><?php echo e($grup->idgrupo); ?></td>                  
                    <td><?php echo e($grup->codigoG); ?></td>
                    <td><?php echo e($grup->tema); ?></td>
                    <td>
                        <?php foreach($tiproceso as $tip): ?>
                        <?php if($tip->idtipotema ==$grup->idtipotema ): ?> 
                        <?php echo e($tip->tema); ?>

                        <?php endif; ?>
                        <?php endforeach; ?>
                    </td>                      
                    <td><?php echo e(\Carbon\Carbon::parse($grup->fecharegistro )->format('d-m-Y')); ?></td>
                    <td> <?php if($grup->condicion==true): ?> Activo
                     <?php else: ?>
                    Inactivo
                    <?php endif; ?> </td>
                <td>
                        
<?php if($grup->condicion==true): ?>

                      <a href="" data-target="#modal-edit-<?php echo e($grup->idgrupo); ?>" data-toggle="modal">
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success " onclick="btncod"><i class="fa fa-eye"></i></button></a>
                <a href="" data-target="#modal-delete-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>
                 <a href="<?php echo e(route('ues.grupos.steps',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>
                 

<?php else: ?>
                <a href=""  data-target="" data-toggle="modal">
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                <a href="" data-target="#modal-modalup-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>
                <a href="<?php echo e(route('ues.grupos.steps',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>
               

<?php endif; ?>              
            <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
               <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
                </tr>
               <?php echo $__env->make('ues.grupos.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

              <!-- <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
               <?php endif; ?><?php /*filtra por carrera*/ ?>
               <?php endforeach; ?>

                <?php endif; ?>




<?php /*este es solo para coordinadores*/ ?> 

              


<!--Aqui inicia solo para asesores  &&$rlc->idrol==$docente->iddocente -->
                
                    <?php if(Auth::user()->idrol==5): ?>


                      <thead><!--fila-->
                    <th hidden=""></th><!--celda-->
                    <th>N°</th>
                    <th>Código</th><!--celda-->
                    <th width="25%">Tema</th><!--celda-->
                 
                    <th>Tipo de Proceso</th><!--celda-->
                 
                    <th width="10%">Fecha de Registro</th><!--celda-->
                    <th>Estado</th><!--celda-->
                    <th>Opciones</th><!--celda-->           
                </thead>
                <?php foreach($personas as $persona): ?> <!--personas-->
                <?php foreach($docentes as $docente): ?> <!--personas-->
                <?php foreach($asesores as $asesor): ?> <!--asesores-->
                <?php foreach($grupos as $grup): ?>
                <?php if($grup->idcarrera==Auth::user()->idcarrera): ?>  <?php /*filtra por carrera*/ ?> 
               <?php /*  <?php foreach($rol_carrera as $rlc): ?> */ ?>
                    <?php if(Auth::user()->idpersona==$persona->idpersona && $persona->idpersona==$docente->idpersona && $docente->iddocente==$asesor->iddocente && $asesor->idgrupo==$grup->idgrupo): ?>
                        <tr>
                        <td><?php echo $cont; $cont++ ?></td>
                        <td hidden=""><?php echo e($grup->idgrupo); ?></td>
                        <td><?php echo e($grup->codigoG); ?></td>
                        <td><?php echo e($grup->tema); ?></td>
                        <td>
                        <?php foreach($tiproceso as $tip): ?>
                            <?php if($tip->idtipotema ==$grup->idtipotema ): ?> 
                                <?php echo e($tip->tema); ?>

                            <?php endif; ?>
                        <?php endforeach; ?>
                        </td>                      
                        <td><?php echo e(\Carbon\Carbon::parse($grup->fecharegistro )->format('d-m-Y')); ?></td>
                        <td> 
                            <?php if($grup->condicion==true): ?> Activo
                                <?php else: ?>
                                Inactivo
                            <?php endif; ?> </td>
                        <td>
                        
                        <?php if($grup->condicion==true): ?>

                   


                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success " onclick="btncod"><i class="fa fa-eye"></i></button></a>

                

                 <a href="<?php echo e(route('ues.grupos.vista_asesor',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>

                 
                 
<?php else: ?>
                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                
                <a href="<?php echo e(route('ues.grupos.vista_asesor',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>
                

<?php endif; ?>              
            <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
               <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
                </tr>
               <?php echo $__env->make('ues.grupos.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

              <!-- <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
                <?php endif; ?>
               <?php endif; ?>
               <?php endforeach; ?>

              <?php /*  <?php endforeach; ?>  */ ?><!--rolcarrera-->
               <?php endforeach; ?><!--asesores-->
               <?php endforeach; ?><!--docente-->
               <?php endforeach; ?><!--personas-->


               <?php endif; ?>

               <!-- Aqui termina para asesores -->






<!--Aqui inicia solo para ALUMNOS  &&$rlc->idrol==$docente->iddocente -->
                
                 
 
                    <?php if(Auth::user()->idrol==6): ?>
                      <thead><!--fila-->
                    <th hidden=""></th><!--celda-->
                    <th>N°</th>
                    <th>Código</th><!--celda-->
                    <th width="25%">Tema</th><!--celda-->
                 
                    <th>Tipo de Proceso</th><!--celda-->
                  
                    <th width="10%">Fecha de Registro</th><!--celda-->
                    <th>Estado</th><!--celda-->
                    <th>Opciones</th><!--celda-->           
                </thead>
                <?php foreach($personas as $persona): ?> <!--personas-->
                <?php foreach($estudiantes as $est): ?> <!--personas-->
                <?php foreach($mostraintegrante as $integrante): ?> <!--integrantes-->
                <?php foreach($grupos as $grup): ?>
                <?php if($grup->idcarrera==Auth::user()->idcarrera): ?>  <?php /*filtra por carrera*/ ?> 
               <?php /*  <?php foreach($rol_carrera as $rlc): ?> */ ?>
                    <?php if(Auth::user()->idpersona==$persona->idpersona && $persona->idpersona==$est->idpersona && $est->idestudiante==$integrante->idestudiante && $integrante->idgrupo==$grup->idgrupo): ?>
                        <tr>
                        <td><?php echo $cont; $cont++ ?></td>
                        <td hidden=""><?php echo e($grup->idgrupo); ?></td>
                        <td><?php echo e($grup->codigoG); ?></td>
                        <td><?php echo e($grup->tema); ?></td>
                        <td>
                        <?php foreach($tiproceso as $tip): ?>
                            <?php if($tip->idtipotema ==$grup->idtipotema ): ?> 
                                <?php echo e($tip->tema); ?>

                            <?php endif; ?>
                        <?php endforeach; ?>
                        </td>                      
                        <td><?php echo e(\Carbon\Carbon::parse($grup->fecharegistro )->format('d-m-Y')); ?></td>
                        <td> 
                            <?php if($grup->condicion==true): ?> Activo
                                <?php else: ?>
                                Inactivo
                            <?php endif; ?> </td>
                        <td>
                        
                        <?php if($grup->condicion==true): ?>

                   


                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success " onclick="btncod"><i class="fa fa-eye"></i></button></a>

                

                 <a href="<?php echo e(route('ues.grupos.vista_estudiante',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>

                 
                 
<?php else: ?>
                <a href="" data-target="#modal-ver-<?php echo e($grup->idgrupo); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                
                <a href="<?php echo e(route('ues.grupos.vista_estudiante',$grup->idgrupo)); ?>"  ><button class="btn btn-info"><i class="fa fa-folder-open"></i></button></a>
                

<?php endif; ?>              
            <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                </td>
               <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
                </tr>
               <?php echo $__env->make('ues.grupos.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

              <!-- <?php echo $__env->make('ues.grupos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
               <?php echo $__env->make('ues.grupos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> -->
                <?php endif; ?>
               <?php endif; ?>
               <?php endforeach; ?>

              <?php /*  <?php endforeach; ?>  */ ?><!--rolcarrera-->
               <?php endforeach; ?><!--asesores-->
               <?php endforeach; ?><!--docente-->
               <?php endforeach; ?><!--personas-->


               <?php endif; ?>


<!-- Aqui termina para ALUMNOS -->


            </table>
           
        </div>
        </div>
</div>          








<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

<script type="text/javascript">
function ventana(id)
{
ventana1=window.open("<?php echo e(url('/listaGrup/')); ?>"  ,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>
<script type="text/javascript">
function ventanaI(id)
{
ventana1=window.open("<?php echo e(url('/listaGrupI/')); ?>"  ,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>

<script type="text/javascript">
function ventanaP(id)
{
ventana1=window.open("<?php echo e(url('ues/grupos/steps/perfilGrup')); ?>"+"/"+ id,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>

<script type="text/javascript">
        $(document).ready(function () {
        $("#cancel").on("click", function () {
            $('.form-group').removeClass('has-success has-error');
           $('.glyphicon ').remove(); 
        });
    });
</script>

<script type="text/javascript">
        $(document).ready(function () {
        $("#cancel1").on("click", function () {
            $('.form-group').removeClass('has-success has-error');
           $('.glyphicon ').remove();
        });
    });
</script>

  <script>
$(document).ready(function() {
$('#modalagregargrupo').on('show.bs.modal', function () {
             // $('#addNodeForm').bootstrapValidator('resetForm', true);
            $(this).removeData('bs.modal');
            $('#modalagregargrupo').bootstrapValidator('resetForm', true);
              $.ajax(
                     {
                         url: "ues/grupos",
                         type: "GET",
                         success:function(text) 
                         {
                             /*alert(text);
                            nodelist = text;*/
                         },
                         error: function(jqXHR, textStatus, errorThrown) 
                         {
                             //if fails      
                         }
                     });
            });
    $('#modalagregargrupo').bootstrapValidator({
        feedbackIcons: {
            /*valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
        },
        fields: {
                codigoG: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el codigo del Grupo '
                    },
                    stringLength: {
                        min:11,
                        max:11,
                        message: 'Debe ingresar 11 caracteres'
                        },  
                    remote: {
                        message: 'codigo no disponible',
                        url: "<?php echo e(url('/codigoGrupoValid/')); ?>",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "<?php echo e(csrf_token()); ?>";
                          }
                        }
                        
                    }
                    
                }
            }, 
            idtipoT: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione Tipo de Proceso '
                    },
                
                }
            },
             tema: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el tema del Grupo '
                    },
                    stringLength: {
                        min:11,
//                        max:11,
                       // message: 'Debe ingresar 11 caracteres'
                        },  
                    remote: {
                        message: 'codigo no disponible',
                        url: "<?php echo e(url('/temaValid/')); ?>",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "<?php echo e(csrf_token()); ?>";
                          }
                        }
                        
                    }
                    
                }
            }, 
  
           }
  }).on('success.form.bv', function(e) {
         
         e.preventDefault();
         bootbox.dialog({
              message: "¿Esta seguro de guardar?",
              title: "CONFIRMAR",
              buttons: {
                success: {
                  label: "SI",
                  className: "btn-success",
                  callback: function() {
                    var formulario = document.getElementById('departamentos');
                    formulario.submit();
                  }
                },
                danger: {
                  label: "NO",
                  className: "btn-danger",
                  callback: function() {

                    /*var formulario = document.getElementById('departamentos');
                    formulario.bootstrapValidator.destroy();
                    $('#departamentos').data('bootstrapValidator',null);*/
                                     
                  }
                }
              }
            });
        });
});
</script>



<script>
    $(window).load(function(){
        $('#grupo').removeAttr('style');
    })
</script>


<script>
$(document).ready(function() {
$('#grupo').DataTable({
    "order":[[2,"asc"]],
"language":{
"sProcessing":     "Procesando...",
"sLengthMenu":     "Mostrar _MENU_ registros",
"sZeroRecords":    "No se encontraron resultados",
"sEmptyTable":     "Ningún dato disponible en grupa tabla",
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

<script type="text/javascript">
    $(document).ready(function () {
         $(".chosen-select").chosen({no_results_text: "Oops, nothing found!",width: "100%"});         
    });
</script>

<script>
<?php if(Session::has('message')): ?>
    var type = "<?php echo e(Session::get('alert-type', 'info')); ?>";
    switch(type){
        case 'info':
           // toastr.info("<?php echo e(Session::get('message')); ?>");
           toastr.info('<?php echo e(Session::get('message')); ?>', '',{progressBar:true});
            break;
        
        case 'warning':
            toastr.warning('<?php echo e(Session::get('message')); ?>', '',{progressBar:true});
            break;
        case 'success':
            toastr.success('<?php echo e(Session::get('message')); ?>', '',{progressBar:true});
             break;
        case 'error':
            toastr.error('<?php echo e(Session::get('message')); ?>', '',{progressBar:true});
            break;
    }
<?php endif; ?>

$(function(){
    $(document.body).on('click', '.btn-remove-phone' ,function(){
        $(this).closest('.phone-input').remove();
    });

    $('.btn-add-phone').click(function(){
        var index = $('.phone-input').length + 1;
        var idasesor= $('#docase option:selected').val();
        var nombreasesor =  $('#docase option:selected').text();
        var idtipoasesor= $('#tiposc option:selected').val();
        var tipoasesor= $('#tiposc option:selected').text();

        $('.asesorlst').append('<br>'+
            '<div class="input-group phone-input ">'+
            '<input type="hidden" name="asesor['+index+'][idasesor]" value="'+ idasesor+'">'+
            '<input type="hidden" name="asesor['+index+'][idtipoasesor]" value="'+ idtipoasesor+'">'+
            '<span class="input-group-addon"><i class="fa fa-list"></i></span>'+
            '<input name="asesor['+index+'][number]" class="form-control" placeholder="9999 9999" id="phone" value="'+ nombreasesor +' - '+ tipoasesor +'">'+
            '<span class="input-group-btn">'+'<button type="button" class="btn btn-danger btn-remove-phone"><i class="glyphicon glyphicon-remove"></i> Eliminar</button>'+'</span>'+'</div>'
        );
    }); 
});
</script>


<script type="text/javascript">
    $(document).ready(function () {  
// FILTROS REPORTE ESTADISTICO
         document.getElementById('dept').addEventListener("change", function(e){
             id_depto = e.target.options[e.target.selectedIndex].value;
             if(id_depto != -1){
                all_filled();
                 let url = "<?php echo e(route('get_carreras_departamentos',':id')); ?>";
                 axios.get(url.replace(':id',id_depto))
                 .then(function (response) {
                        // handle success
                    console.log(response);
                    addOptions(response['data']['carreras'],'carrera');
                })
                .catch(function (error) {
                        // handle error
                    console.log(error);
                });
             }
         });

         
         document.getElementById('carrera').addEventListener("change", function(e){
             id_depto = e.target.options[e.target.selectedIndex].value;
             if(id_depto != -1){
                all_filled();
                 let url = "<?php echo e(route('get_years_trabajos',':id')); ?>";
                 axios.get(url.replace(':id',id_depto))
                 .then(function (response) {
                        // handle success
                    let data = response['data']['years'];
                    console.log(response);
                    let sel = document.getElementById('anioselec');
                    sel.options.length = 0;
                    sel.options[sel.options.length] = new Option("[Seleccione]", "-1", false, false);
                    for (let i = 0; i <= data.length - 1; i++) {
                        let opt = data[i];
                        sel.options[sel.options.length] = new Option(opt, opt, false, false);
                    }
                })
                .catch(function (error) {
                        // handle error
                    console.log(error);
                });
             }
         });

         document.getElementById('anioselec').addEventListener("change", function(e){
            all_filled();
         });

         document.getElementById('estado').addEventListener("change", function(e){
            all_filled();             
         });

         function addOptions(data,select_id) {
            var sel = document.getElementById(select_id);
            sel.options.length = 0;
            sel.options[sel.options.length] = new Option("[Seleccione]", "-1", false, false);
            for (var i = 0; i <= data.length - 1; i++) {
                var opt = data[i];
                sel.options[sel.options.length] = new Option(opt.nombre, opt.idcarrera, false, false);
            }
        }
// FILTROS REPORTE ESTADISTICO
        function all_filled() {
            let sum =0;
            a = (document.getElementById('dept').selectedIndex > 0)? 1:0;
            b = (document.getElementById('carrera').selectedIndex > 0)? 1:0;
            c = (document.getElementById('anioselec').selectedIndex > 0)? 1:0;
            d = (document.getElementById('estado').selectedIndex > 0)? 1:0;
            sum =  a + b + c + d;
            console.log(sum);
            //document.getElementById('sendBTN').disabled= (sum == 4)? false:true;
            
           
        }
    });

    //function disable() {
      //  document.getElementById('sendBTN').disabled=true;
   // }

</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>