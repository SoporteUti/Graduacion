<?php $__env->startSection('contenido'); ?>
 <?php if(Auth::user()->idrol==4): ?>

  <style type="text/css">
   .table-wrapper-scroll-y {
  display: block;
  max-height: 222px;
  overflow-y: auto;
  -ms-overflow-style: -ms-autohiding-scrollbar;
} 

  </style>
    

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
            <a class="navbar-brand" href="#">Expediente de grupo</a>          
            
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse ">
            <ul class="nav navbar-nav">
             
    
        </div><!-- /.navbar-collapse -->
    </div>
</nav>


  <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3" >
            <div class="tab"> 
              <label>Código </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input id="codigoG" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"  value="<?php echo e($grupos->codigoG); ?>"  class="form-control" name="codigoG"  maxlength="11" autofocus>
                </div>          
            </div>
          </div>

          <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9" >
            <div class="tab"> 
              <label>Tipo de Proceso </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <?php foreach($tiproceso as $tip): ?>
                    <?php if($tip->idtipotema==$grupos->idtipotema): ?>
                    <input id="tiproceso" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"  value="<?php echo e($tip->tema); ?>"  class="form-control" name="tiproceso"  maxlength="11" autofocus>
                    <?php endif; ?>
    <?php endforeach; ?>
                </div>          
            </div>
          </div>

          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="tab"> 
              <label>Tema </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <textarea id="tema" readonly=""    value="<?php echo e($grupos->tema); ?>"  class="form-control" name="tema"  ><?php echo e($grupos->tema); ?></textarea> 
                </div>          
            </div>
          </div>
          
          
   



  
    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="home" role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">

              <?php $var=0; ?>
                 <?php foreach($tiproceso as $tip): ?>
    <?php if($tip->idtipotema==$grupos->idtipotema): ?>
    <?php foreach($etapas as $et): ?>
    <?php if($et->idtipotrabajo==$tip->idtipotema): ?> 
    <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#page-<?php echo e($et->idetapa); ?>"><strong><?php echo e($et->idnombreetapa); ?></strong></a>
                    <?php $var++; ?>
                </li>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?> 
            </ul>


    
  
        
 <div class="tab-content">
            
  <?php for($i = 1; $i <=$var; $i++): ?>

                 <div id="page-<?php echo e($i); ?>" class="tab-pane fade">
                  <div class="table-wrapper-scroll-y">
                   <table class="table table-bordered table-striped" id="<?php echo e($et->idetapa); ?>">
                 <thead>
                   <tr>
                  
                     <th>N°</th>
                     <th>
                     Actividades realizadas <?php echo e($i); ?></th> 
                     <th>
                     Fecha</th>
                     <th>
                     Estado</th>
                                          <th>Opciones</th><!--celda--> 
                   </tr>
                 </thead>
                 <tbody >
                 <?php $cont=0; ?>
                  <?php foreach($gsol as $gs): ?>
                  <?php if($gs->idgrupo==$grupos->idgrupo && $gs->etapa==$i): ?>
                   <?php foreach($Solicitudes as $sol): ?>
                   <?php if($sol->idsolicitud==$gs->idsolicitud): ?>
                  <tr>
                     
                   
                    <?php $cont++;  ?>
                    <td hidden="" ><?php echo e($gs->idgrupsol); ?> </td>
                   <td><?php echo e($cont); ?> </td>

                   <td ><?php echo e($sol->nombre); ?></td>
                   <td ><?php echo e(\Carbon\Carbon::parse($gs->fecha )->format('d-m-Y')); ?> </td> 

                  <?php if($gs->condicion==false): ?>
                <td >Cancelado </td> 
                                   <?php else: ?>
                    <?php if($gs->estado==0): ?>
                  <td >Enviado a: Junta Directiva  </td> 
                  <?php else: ?>
                   <?php if($gs->estado==1): ?>
                  <td >Aprobado </td>
                  <?php else: ?>
                  <?php if($gs->estado==7): ?>
                  <td >Denegado </td>
                  <?php else: ?>
                  <?php foreach($roles as $rl): ?>
                  <?php if($gs->estado==$rl->idrol): ?>          
                  <td >Enviado a: <?php echo e($rl->nombre); ?>  </td>
                   <?php endif; ?>
                  <?php endforeach; ?>
                   <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endif; ?>

                   <td >

                    <?php if($sol->idsolicitud!=2 && $sol->idsolicitud!=7): ?>
                    <a href=""  data-target="#imprimird-<?php echo e($sol->idsolicitud); ?>-<?php echo e($gs->idgrupsol); ?>" data-toggle="modal">
                    <button  class="btn btn-warning"><i class="fa fa-print"></i></button></a>


                     <?php if($gs->estado==0 && $gs->condicion==true || $gs->estado==1 || $gs->estado==7): ?>
                  <a href=""   data-target="#registrard-<?php echo e($sol->idsolicitud); ?>-<?php echo e($gs->idgrupsol); ?>" data-toggle="modal">
                    <button   class="btn btn-success"><i  class=" fa fa-folder-open"></i></button></a>
                    <?php endif; ?>
                    <?php else: ?>
                    <?php if($gs->estado==4||$gs->estado==1): ?>
                    <a href=""   data-target="#registrard-<?php echo e($sol->idsolicitud); ?>-<?php echo e($gs->idgrupsol); ?>" data-toggle="modal">
                    <button   class="btn btn-success"><i  class=" fa fa-folder-open"></i></button></a>
                    <?php endif; ?>
                    <?php endif; ?>
                  </td>
                  <?php echo $__env->make('ues.grupos.imprimir1director', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php echo $__env->make('ues.grupos.registrar1director', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                  <?php echo $__env->make('ues.grupos.imprimir3director', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php echo $__env->make('ues.grupos.registrar3director', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                  <?php echo $__env->make('ues.grupos.imprimir8director', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                  <?php echo $__env->make('ues.grupos.registrar8director', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('ues.grupos.registrarRSdirector', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       
        
       <?php echo $__env->make('ues.grupos.imprimirRSdirector', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>           
 
 
 <?php echo $__env->make('ues.grupos.imprimir6director', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo $__env->make('ues.grupos.imprimir4director', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

 

 
  
 <?php echo $__env->make('ues.grupos.registrarPIdirector', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 
 <?php echo $__env->make('ues.grupos.registrar4director', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo $__env->make('ues.grupos.registrar6director', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('ues.grupos.registrar7director', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


                    </tr><?php endif; ?>
                     <?php endforeach; ?>
                    <?php endif; ?>
                     <?php endforeach; ?>
    
                   </tbody>
                 </table>


 </div>

                </div>  

<?php endfor; ?>


       


    </div>
   
</div>
                 </div>

    
  

 

  



       
         
<!-- solicitudes: aprobacion de tema -->



<!-- solicitudes: Prorroga interna -->
<div class="modal fade" id="solicitud-2">
<?php echo e(Form::Open(array('action'=>array('solicitudController@spsistemas'),'route'=>['ues.solicitudes.spsistemas'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud de Prórroga Interna Etapa I</h4>
    </div>
    <div class="modal-body">
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" value="<?php echo e($grupos->codigoG); ?>" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
            <div class="form-group"> 
            <label>Fecha de inicio</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="date" name="fechai" id="fechai" class="form-control" value="" required="required" title="">
                </div>          
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
            <div class="form-group"> 
            <label>Fecha de finalización</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="date" name="fechaf" id="fechaf" class="form-control" value="" required="required" title="">
                </div>          
            </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Motivo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <textarea  name="motivo"  cols="35" id="motivo" class="form-control" ></textarea>
                </div>          
            </div>
            </div>
          
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Generar</button>
    </div>
  </div>
</div>
<?php echo e(Form::Close()); ?>

</div>

<!-- solicitudes: Ratificacion de resultados -->
<div class="modal fade" id="solicitud-5">
<?php echo e(Form::Open(array('action'=>array('solicitudController@ratiResul'),'route'=>['ues.solicitudes.ratiResul'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Ratificacion de Resultado</h4>
    </div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="5" >
            </div>          
        </div>
    </div> 

     <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idgrupo" type="text" class="form-control" name="idgrupo" value="<?php echo e($grupos->idgrupo); ?>" >
            </div>          
        </div>
    </div> 

    <div class="modal-body">
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" value="<?php echo e($grupos->codigoG); ?>" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
      
            
          
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
  </div>
</div>
<?php echo e(Form::Close()); ?>

</div>
<!-- solicitudes: Repobacion por abandono -->
<div class="modal fade" id="solicitud-8">
<?php echo e(Form::Open(array('action'=>array('solicitudController@repabandono'),'route'=>['ues.solicitudes.repabandono'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Repobación por Abandono</h4>
    </div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="8" >
            </div>          
        </div>
    </div> 

     <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idgrupo" type="text" class="form-control" name="idgrupo" value="<?php echo e($grupos->idgrupo); ?>" >
            </div>          
        </div>
    </div> 

    <div class="modal-body">
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" value="<?php echo e($grupos->codigoG); ?>" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
      
            
          
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
  </div>
</div>
<?php echo e(Form::Close()); ?>

</div>




<?php /* cambio tema y tribunal*/ ?>
<div class="modal fade" id="solicitud-6">
  <?php echo e(Form::Open(array('action'=>array('solicitudpicController@spiconta'),'route'=>['ues.solicitudesconta.spiconta'], 'method'=>'post', 'files' =>'true'))); ?>

 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud de Cambio de Tema</h4>
    </div>
    <div class="modal-body">


 <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="6" >
            </div>          
        </div>
    </div> 

     <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idgrupo" type="text" class="form-control" name="idgrupo" value="<?php echo e($grupos->idgrupo); ?>" >
            </div>          
        </div>
    </div> 


   
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                   <input id="codigo" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"  value="<?php echo e($grupos->codigoG); ?>"  class="form-control" name="codigo"  maxlength="11" autofocus>
                </div>          
            </div>
            </div>



           <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
        <div class="form-group"> 
            <label>Fecha de Emisión</label>   
            <div class="input-group">  
                <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                <input type="date" readonly="" class="form-control" id="fecha" name="fecha" step="1" value="<?php echo date("Y-m-d");?>" >
            </div>         
        </div>
    </div>
  
      
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Nuevo Tema</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <textarea  name="nuevotema"  cols="35" id="nuevotema" class="form-control" ></textarea>
                </div>          
            </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Motivo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <textarea  name="motivo"  cols="35" id="motivo" class="form-control" ></textarea>
                </div>          
            </div>
            </div>
          
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Generar</button>
    </div>
  </div>
</div>
<?php echo e(Form::Close()); ?>

</div>

<div class="modal fade" id="solicitud-4">
  <?php echo e(Form::Open(array('action'=>array('solicitudpicController@sRatificaciondeTribunal'),'route'=>['ues.solicitudesconta.sRatificaciondeTribunal'], 'method'=>'post', 'files' =>'true'))); ?> 
 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Ratificación de Tribunal Calificador</h4>
    </div>
    <div class="modal-body">

    <div hidden="" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                   
                    <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="4" >
                </div>          
            </div>
            </div>

             <div hidden="" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                   
                    <input id="idgrupo" type="text" class="form-control" name="idgrupo" value="<?php echo e($grupos->idgrupo); ?>" >
                </div>          
            </div>
            </div>


      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" > 
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                   <input id="codigo" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"  value="<?php echo e($grupos->codigoG); ?>"  class="form-control" name="codigo"  maxlength="11" autofocus>
                </div>          
            </div>
            </div>

      
           <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" > 
        <div class="form-group"> 
            <label>Asesores(*)</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
            <select data-placeholder="Seleccione docentes" multiple class="chosen-select form-control" name="docentes[]" id="docentes"  >
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
            </div>
            </div>

            
           
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Generar</button>
    </div>
  </div>
</div>
 <?php echo e(Form::Close()); ?> 
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
 

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(document).ready(function () {
         $(".chosen-select").chosen({no_results_text: "Oops,no se encontraron resultados!",width: "100%"});     
   
    });



    <?php /*  Sirve para limitar elemntos seleccionados
      $(".chosen-select").chosen("destroy")
        

        $('.chosen-select').chosen({ max_selected_options: 2,width: "100%"}); 
        $('.chosen-select').trigger("chosen:updated");   
   
  
      */ ?>
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
    </script>
<script>
  function rel(){

    location.reload();
  }
</script>
  <?php $__env->stopSection(); ?>



<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>