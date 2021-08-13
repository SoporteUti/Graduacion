<?php $__env->startSection('contenido'); ?>
<?php if(Auth::user()->idrol==3 || Auth::user()->idrol==1 ): ?>

	<style type="text/css">
   .table-wrapper-scroll-y {
  display: block;
  max-height: 222px;
  overflow-y: auto;
  -ms-overflow-style: -ms-autohiding-scrollbar;
} 
  </style> 

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
        <a class="navbar-brand" href="#">Expediente de grupo</a>          
    </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
        <ul class="nav navbar-nav ">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Solicitudes <b class="caret"></b></a>
            <ul class="dropdown-menu">
            <?php if($consulta1==0): ?>
              <li><a href="#solicitud-1" data-toggle="modal" data-target="#solicitud-1">Aprobación del Tema</a></li>
            <?php endif; ?>
            <?php foreach($etapaactiva as $ea): ?> 
            <?php if($ea->idgrupo==$grupos->idgrupo && $ea->idnuevaetapa==3 && $ea->estado==1): ?>
              <li><a href="" data-target="#solicitud-4" data-toggle="modal">Ratificación Tribunal Calificador</a></li>
            <?php endif; ?>
            <?php endforeach; ?>
              <li><a href="#solicitud-5" data-toggle="modal" data-target="#solicitud-5">Ratificación de resultados</a></li>
              <li><a href="#solicitud-10" data-toggle="modal" data-target="#solicitud-10">Impugnación  de resultados</a></li>
              <li><a href="#solicitud-9" data-toggle="modal" data-target="#solicitud-9">Renuncia al Proceso de Graduación</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acciones <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#cronograma" data-toggle="modal" data-target="#cronograma">Registro de Fechas</a></li>
          <li><a href="#" onclick="ventanaP('<?php echo e($grupos->idgrupo); ?>')" >Imprimir Expediente</a></li>
          <?php /* <li><a href="#" onclick="ventanaC('<?php echo e($grupos->idgrupo); ?>')" >Imprimir Cronograma</a></li> */ ?>
        </ul>                     
          </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrar Notas <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                       
                        <?php if($consulta2!=0): ?>
                        <li><a href="#notas" data-toggle="modal" data-target="#notas">Registro de Notas</a></li>
                       <?php endif; ?>
                        <li><a href="#pdfnotas" data-toggle="modal" data-target="#pdfnotas">Imprimir  Notas (Etapas)</a></li>

          <li><a href="#" onclick="ventanaN('<?php echo e($grupos->idgrupo); ?>')" >Imprimir  Notas </a></li>
                 
   
          <li><a href="#editarnotas" data-toggle="modal" onclick="" data-target="#editarnotas">Editar Notas</a></li>
              
           
  

                    </ul> 
            </li>

             </ul>
           
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
    <li class="nav-item" id="$et->idetapa" >

                    <a o class="nav-link" data-toggle="tab" href="#page-<?php echo e($et->idetapa); ?>"><strong><?php echo e($et->idnombreetapa); ?></strong></a>
                    <?php $var++; ?>
                </li>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?> 
    <li class="nav-item" id="cronograma-tbl">
      <a o class="nav-link" data-toggle="tab" href="#page-cronograma"><strong>Cronograma</strong></a>
      <br/>

    </li>
    </item>
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
                     Actividades realizadas</th> 
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
                    <?php $cont++; ?>
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
                  <td >Aprobado  </td>
                  <?php else: ?>
                  <?php foreach($roles as $rl): ?>
                  <?php if($gs->estado==$rl->idrol): ?>          
                  <td >Enviado a: <?php echo e($rl->nombre); ?>  </td>
                   <?php endif; ?>
                  <?php endforeach; ?>
                   <?php endif; ?>
                    <?php endif; ?>

                    <?php endif; ?>


                  <td ><a data-backdrop="static" data-keyboard="false" href=""  data-target="#imprimirc-<?php echo e($sol->idsolicitud); ?>-<?php echo e($gs->idgrupsol); ?>" data-toggle="modal">
                    <button  class="btn btn-warning"><i class="fa fa-print"></i></button></a>
<?php if($gs->estado==3 && $gs->condicion==true ): ?>
<a href=""  data-target="#cancelar-<?php echo e($gs->idgrupsol); ?>" data-toggle="modal"> <button  class="btn btn-danger"><i class="fa fa-ban"></i></button></a>
<?php echo $__env->make('ues.grupos.cancelarsolicitud', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>



                 
                
                  <?php endif; ?>

 <?php if($gs->condicion==false ): ?>
<a href=""  data-target="#motivo-<?php echo e($gs->idgrupsol); ?>" data-toggle="modal"> <button  class="btn btn-danger"><i class="fa fa-question-circle 
"></i></button></a>

                  
                
                  <?php endif; ?>   
<a href=""   data-target="#verpdfs-<?php echo e($gs->idgrupsol); ?>" data-toggle="modal">
                    <button   class="btn btn-success"><i  class=" fa fa-folder-open"></i></button></a>
                  </td>

                   
                             
       <?php echo $__env->make('ues.grupos.motivo', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>           
<?php echo $__env->make('ues.grupos.imprimir1cordinador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('ues.grupos.imprimirRScordinador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('ues.grupos.imprimirPIcordinador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('ues.grupos.imprimir3coordinador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('ues.grupos.imprimir6coordinador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('ues.grupos.imprimir4coordinador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('ues.grupos.imprimir7coordinador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('ues.grupos.imprimir8coordinador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('ues.grupos.imprimir9coordinador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('ues.grupos.imprimir10coordinador', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->make('ues.grupos.verpdfs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </tr><?php endif; ?>
                     <?php endforeach; ?>
                    <?php endif; ?>
                     <?php endforeach; ?>
    
                   </tbody>
                 </table>


 </div>

                </div>  

<?php endfor; ?>


<?php /* CRONOGRAMA */ ?>
<div id="page-cronograma" class="tab-pane fade">
                  <div class="table-wrapper-scroll">
                 <?php echo $gantt; ?>    


 </div>

                </div>  
<?php /* CRONOGRAMA */ ?>

       


    </div>
   
</div>
                 </div> </div>  

    <?php echo $__env->make('ues.grupos.cronograma', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    


<div class="modal fade" id="solicitud-5">
<?php echo e(Form::Open(array('action'=>array('solicitudController@ratiResul'),'route'=>['ues.solicitudes.ratiResul'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Ratificación de Resultados</h4>
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
    <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>numero de etapas</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($var); ?>" name="netapas" id="netapas" class="form-control"  >
                </div>          
            </div>
            </div>

    <div class="modal-body">
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->codigoG); ?>" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
 <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
     <table class="table table-hover">
       <thead>
         <tr>
          <?php $cet=0; ?>
           <th>Integrantes</th>
           <?php foreach($tiproceso as $tip): ?>
    <?php if($tip->idtipotema==$grupos->idtipotema): ?>
    <?php foreach($etapas as $et): ?>
    <?php if($et->idtipotrabajo==$tip->idtipotema): ?> 
     <?php foreach($porc as $pr): ?>
     <?php if($pr->idetapa==$et->idnuevaetapa): ?>
   <th>Etapa <?php echo e($et->idetapa); ?> (<?php echo e($pr->porcentaje); ?>%)</th>
    <?php $cet++; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?> 
<th>Promedio</th>


         </tr>
       </thead>
       <tbody>  <?php foreach($mostraintegrante as $mint): ?>
                <?php if($mint->idgrupo==$grupos->idgrupo): ?>
                <?php foreach($estudiantes as $est): ?>
                <?php if($mint->idestudiante==$est->idestudiante): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>
         <tr>
           
               <td><?php echo e($est->carnet." ".$per->nombres." ".$per->apellidos); ?></td>
<?php for($j = 1; $j <=$cet; $j++): ?>
<td>
<?php foreach($notas as $not): ?>
<?php if($not->idestudiante==$est->idestudiante && $not->idetapa==$j ): ?>

 <?php echo e($not->nota); ?>

 
<?php endif; ?>
<?php endforeach; ?>
</td>
<?php endfor; ?>



<?php $prom=0; ?>
       <?php foreach($tiproceso as $tip): ?>
    <?php if($tip->idtipotema==$grupos->idtipotema): ?>
    <?php foreach($etapas as $et): ?>
    <?php if($et->idtipotrabajo==$tip->idtipotema): ?> 
     <?php foreach($porc as $pr): ?>
     <?php if($pr->idetapa==$et->idnuevaetapa): ?>
   
<?php foreach($notas as $not): ?>
<?php if($not->idestudiante==$est->idestudiante &&  $not->idetapa==$et->idetapa ): ?>


<?php $prom=$prom+$not->nota*($pr->porcentaje/100); ?>

<?php endif; ?>
<?php endforeach; ?>



    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?> 

<td ><strong><?php echo round($prom,1);?></strong></td>



               
         </tr> <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
           
       </tbody>
     </table>

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
  

<!-- solicitudes: impugnacion de resultadis  -->

  <div class="modal fade" id="solicitud-10">
<?php echo e(Form::Open(array('action'=>array('solicitudController@impugnacionResultados'),'route'=>['ues.solicitudes.impugnacionResultados'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Impugnación de Resultados</h4>
    </div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="10" >
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
    <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>numero de etapas</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($var); ?>" name="netapas" id="netapas" class="form-control"  >
                </div>          
            </div>
            </div>

    <div class="modal-body">
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->codigoG); ?>" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
 <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
     <table class="table table-hover">
       <thead>
         <tr>
          <?php $cet=0; ?>
           <th>Integrantes</th>
           <?php foreach($tiproceso as $tip): ?>
    <?php if($tip->idtipotema==$grupos->idtipotema): ?>
    <?php foreach($etapas as $et): ?>
    <?php if($et->idtipotrabajo==$tip->idtipotema): ?> 
     <?php foreach($porc as $pr): ?>
     <?php if($pr->idetapa==$et->idnuevaetapa): ?>
   <th>Etapa <?php echo e($et->idetapa); ?> (<?php echo e($pr->porcentaje); ?>%)</th>
    <?php $cet++; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?> 
<th>Promedio</th>


         </tr>
       </thead>
       <tbody>  <?php foreach($mostraintegrante as $mint): ?>
                <?php if($mint->idgrupo==$grupos->idgrupo): ?>
                <?php foreach($estudiantes as $est): ?>
                <?php if($mint->idestudiante==$est->idestudiante): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>
         <tr>
           
               <td><?php echo e($est->carnet." ".$per->nombres." ".$per->apellidos); ?></td>
<?php for($j = 1; $j <=$cet; $j++): ?>
<td>
<?php foreach($notas as $not): ?>
<?php if($not->idestudiante==$est->idestudiante && $not->idetapa==$j ): ?>

 <?php echo e($not->nota); ?>

 
<?php endif; ?>
<?php endforeach; ?>
</td>
<?php endfor; ?>



<?php $prom=0; ?>
       <?php foreach($tiproceso as $tip): ?>
    <?php if($tip->idtipotema==$grupos->idtipotema): ?>
    <?php foreach($etapas as $et): ?>
    <?php if($et->idtipotrabajo==$tip->idtipotema): ?> 
     <?php foreach($porc as $pr): ?>
     <?php if($pr->idetapa==$et->idnuevaetapa): ?>
   
<?php foreach($notas as $not): ?>
<?php if($not->idestudiante==$est->idestudiante &&  $not->idetapa==$et->idetapa ): ?>


<?php $prom=$prom+$not->nota*($pr->porcentaje/100); ?>

<?php endif; ?>
<?php endforeach; ?>



    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?> 

<td ><strong><?php echo round($prom,1);?></strong></td>



               
         </tr> <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
           
       </tbody>
     </table>

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
         
<!-- solicitudes: aprobacion de tema -->
<div class="modal fade" id="solicitud-1">
<?php echo e(Form::Open(array('action'=>array('solicitudController@aprovaciont'),'route'=>['ues.solicitudes.aprovaciont'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud de aprobación de tema</h4>
    </div>
    <div class="modal-body">

 <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idsolicitud</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="1" name="idsolicitud" id="idsolicitud" class="form-control"  >
                </div>          
            </div>
            </div>
            <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idgrupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->idgrupo); ?>" name="idgrupo" id="idgrupo" class="form-control"  >
                </div>          
            </div>
            </div>
            <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>numero de etapas</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($var); ?>" name="netapas" id="netapas" class="form-control"  >
                </div>          
            </div>
            </div>

      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->codigoG); ?>" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Tema</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <textarea id="tema" readonly=""    value="<?php echo e($grupos->tema); ?>"  class="form-control" name="tema"  ><?php echo e($grupos->tema); ?></textarea>
                </div>          
            </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Integrantes </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                <?php foreach($mostraintegrante as $mint): ?>
                <?php if($mint->idgrupo==$grupos->idgrupo): ?>
                <?php foreach($estudiantes as $est): ?>
                <?php if($mint->idestudiante==$est->idestudiante): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>
                <input disabled=""  type="text" class="form-control"    value="<?php echo e($est->carnet." ".$per->nombres." ".$per->apellidos); ?>">
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
                </div>          
            </div>
        </div>  

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Asesor/es </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <?php foreach($asesores as $ase): ?>
                <?php if($ase->idgrupo==$grupos->idgrupo): ?>
                         <?php foreach($docentes as $doc): ?>
                                 <?php if($ase->iddocente==$doc->iddocente): ?>
                     <?php foreach($personas as $per): ?>
                <?php if($per->idpersona==$doc->idpersona): ?>
                <?php foreach($tipoasesor as $tias): ?>
                <?php if($tias->idtipoasesor==$ase->idtipoasesor): ?>
                <input disabled type="text" class="form-control"   value="<?php echo e($doc->titulo." ".$per->nombres." ".$per->apellidos." - ".$tias->tipoasesor); ?>">
                <?php endif; ?>
                <?php endforeach; ?> 
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
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
<!-- solicitudes: imprimir aprovacion tema -->



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


            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Integrantes </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                <select name="estudianteselec" id="estudianteselec" class="form-inline form-control">
                <option value="">[Seleccione]</option>
                <?php foreach($mostraintegrante as $mint): ?>
                <?php if($mint->idgrupo==$grupos->idgrupo): ?>
                <?php foreach($estudiantes as $est): ?>
                <?php if($mint->idestudiante==$est->idestudiante): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>
                 <option  value="<?php echo e($est->idestudiante); ?>"><?php echo e($est->carnet." ".$per->nombres." ".$per->apellidos); ?></option>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
                </select>
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
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
  </div>
</div>
<?php echo e(Form::Close()); ?>

</div>



<?php /* cambio tema y tribunal*/ ?>
<div class="modal fade" id="solicitud-6">
  <?php echo e(Form::Open(array('action'=>array('solicitudpicController@spicontaCoordinador'),'route'=>['ues.solicitudesconta.spicontaCoordinador'], 'method'=>'post', 'files' =>'true'))); ?>

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


   
      <div class="col-lg-12 col-md12 col-xs-12 col-sm-12" > 
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




<!-- modal notas -->
<div class="modal fade" id="notas">
<?php echo e(Form::Open(array('action'=>array('grupoController@gnotas'),'route'=>['ues.grupos.gnotas'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Registrar Notas</h4>
    </div>
    <div class="modal-body">

            <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idgrupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->idgrupo); ?>" name="idgrupo" id="idgrupo" class="form-control"  >
                </div>          
            </div>
            </div>
          

      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->codigoG); ?>" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Tema</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <textarea id="tema" readonly=""    value="<?php echo e($grupos->tema); ?>"  class="form-control" name="tema"  ><?php echo e($grupos->tema); ?></textarea>
                </div>          
            </div>
            </div>


<!-- guardar etapa activa 1 al crear el grupo no al generar la solicitud de ap. tema -->

            <?php foreach($etapaactiva as $ea): ?> 
                     <?php if($ea->idgrupo==$grupos->idgrupo && $ea->estado==1): ?>
              <div  class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Etapa</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                       <?php foreach($etapas as $et): ?>
    <?php if($et->idtipotrabajo==$grupos->idtipotema): ?>
    <?php if($et->idetapa==$ea->idnuevaetapa): ?>
                    <input readonly="" type="text" value="<?php echo e($et->idnombreetapa); ?>" name="etapa" id="etapa" class="form-control"  >   
                    <input  type="hidden" value="<?php echo e($et->idetapa); ?>" name="idetapa" id="idetapa" class="form-control"  > 
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>          
            </div>
            </div>
            <?php endif; ?>
                    <?php endforeach; ?>

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Integrantes </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                <?php foreach($mostraintegrante as $mint): ?>
                <?php if($mint->idgrupo==$grupos->idgrupo): ?>
                <?php foreach($estudiantes as $est): ?>
                <?php if($mint->idestudiante==$est->idestudiante): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>
                <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9"> 
                <input disabled=""  type="text" class="form-control"    value="<?php echo e($est->carnet." ".$per->nombres." ".$per->apellidos); ?>">
                </div>
                <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                <input   type="number"  min="0"  max="10" step = ".01" id="<?php echo e($est->idestudiante); ?>" name="<?php echo e($est->idestudiante); ?>" class="form-control"    value="" placeholder="Nota">
                </div> 
                <br>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
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


<?php /*pdf notas*/ ?>
  <div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1"  id="pdfnotas">
<?php echo e(Form::Open(array('action'=>array('GrupoController@pdfNotas'),'route'=>['ues.grupos.impNotas'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Generar Notas</h4>
    </div>
    <div class="modal-body">

 <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idgrupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->idgrupo); ?>" name="idgrupo" id="idgrupo" class="form-control"  >
                </div>          
            </div>
            </div>
      
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
           <div class="form-group"> 
              <label>Seleccion Etapa </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                    <select  name="etapas" id="etapas"  class="form-inline form-control">
                      
<option value="" >[Seleccione una Etapa]</option>
 <?php if($idetapa1): ?><?php $idetapa1=$idetapa1->idetapa; ?> <?php else: ?> <?php $idetapa1=0;?><?php endif; ?>
                      <?php $c=0?> 
                      <?php foreach($tiproceso as $tip): ?>
    <?php if($tip->idtipotema==$grupos->idtipotema): ?>
    <?php foreach($etapas as $et): ?>

    <?php if($et->idtipotrabajo==$tip->idtipotema): ?> 


 <?php if($idetapa1>0 && $et->idetapa<=$idetapa1 ): ?>
 
<option value="<?php echo e($et->idnuevaetapa); ?>"><?php echo e($et->idnombreetapa); ?>

  <?php  $c++; ?>                      
                    </option> <?php endif; ?>
                   
 <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?> 

                    </select>
                </div>          
            </div>
</div>


  

<div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>contador</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo $c;?>" name="contador" id="contador" class="form-control"  >
                </div>          
            </div>
            </div>
   

       </div>
          
  
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Imprimir</button>
    </div>
  </div>
</div>
<?php echo e(Form::Close()); ?>

</div>



<!-- modal notas -->
<div class="modal fade" id="editarnotas">
<?php echo e(Form::Open(array('action'=>array('grupoController@editarnotas'),'route'=>['ues.grupos.editarnotas'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Editar Notas</h4>
    </div>
    <div class="modal-body">

            <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idgrupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->idgrupo); ?>" name="idgrupo" id="idgrupo" class="form-control"  >
                </div>          
            </div>
            </div>
          

      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->codigoG); ?>" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
  


<!-- guardar etapa activa 1 al crear el grupo no al generar la solicitud de ap. tema -->

            
              <div  class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Etapa</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                   
               <select name="etapaselect" id="etapaselect" onchange="nuevafuncion()" class="form-control" required="" >
                    <option value="" >[Seleccione una Etapa]</option>
                  
 <?php if($idetapa): ?><?php $idetapa=$idetapa->idetapa; ?> <?php else: ?> <?php $idetapa=0;?><?php endif; ?>
         
<?php foreach($tiproceso as $tip): ?>
    <?php if($tip->idtipotema==$grupos->idtipotema): ?>
    <?php foreach($etapas as $et): ?>
    <?php if($et->idtipotrabajo==$tip->idtipotema): ?> 
  <?php if($idetapa>0 && $et->idetapa<=$idetapa ): ?>
                  <option value="<?php echo e($et->idetapa); ?>"><?php echo e($et->idnombreetapa); ?></option>
                          <?php endif; ?>
          <?php endif; ?>
    <?php endforeach; ?>
    
    <?php endif; ?>
    <?php endforeach; ?> 

                </select>
                </div>          
            </div>
            </div>
          

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Integrantes </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                <?php foreach($mostraintegrante as $mint): ?>
                <?php if($mint->idgrupo==$grupos->idgrupo): ?>
                <?php foreach($estudiantes as $est): ?>
                <?php if($mint->idestudiante==$est->idestudiante): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>
                <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9"> 
                <input disabled=""  type="text" class="form-control"    value="<?php echo e($est->carnet." ".$per->nombres." ".$per->apellidos); ?>">
                </div>
                <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
<?php $idupdate="u".$est->idestudiante;?>


                <input   type="number"  min="0"  max="10" step = ".01" id="<?php echo $idupdate;?>" name="<?php echo $idupdate;?>"  required=""  class="form-control"   >
                </div> 
               
                <br>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
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

<!-- solicitud 9 -->
<div class="modal fade" id="solicitud-9">
<?php echo e(Form::Open(array('action'=>array('solicitudController@renuncia'),'route'=>['ues.solicitudes.renuncia'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Renuncia al Proceso de Graduación</h4>
    </div>
    <div class="modal-body">

            <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idgrupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->idgrupo); ?>" name="idgrupo" id="idgrupo" class="form-control"  >
                </div>          
            </div>
            </div>
             <?php foreach($etapaactiva as $ea): ?> 
                     <?php if($ea->idgrupo==$grupos->idgrupo && $ea->estado==1): ?>
              <div hidden=""  class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Etapa</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                       <?php foreach($etapas as $et): ?>
    <?php if($et->idtipotrabajo==$grupos->idtipotema): ?>
    <?php if($et->idetapa==$ea->idnuevaetapa): ?>
                      
                    <input  type="hidden" value="<?php echo e($et->idetapa); ?>" name="idetapa" id="idetapa" class="form-control"  > 
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>          
            </div>
            </div>
            <?php endif; ?>
                    <?php endforeach; ?>
          

      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->codigoG); ?>" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
  




            
              <div  class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Estudiante</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                   
               <select name="estudianterenuncia" id="estudianterenuncia"  class="form-control" required="" >
                    <option value="" >[Seleccione un Estudiante]</option>
                  
<?php foreach($mostraintegrante as $mint): ?>
                <?php if($mint->idgrupo==$grupos->idgrupo): ?>
                <?php foreach($estudiantes as $est): ?>
                <?php if($mint->idestudiante==$est->idestudiante): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>
                  <option value="<?php echo e($est->idestudiante); ?>"><?php echo e($per->nombres); ?> <?php echo e($per->apellidos); ?></option>
                             <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 

                </select>
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






 <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>
<script type="text/javascript">
function ventanaP(id)
{
ventana1=window.open("<?php echo e(url('ues/grupos/steps/perfilGrup')); ?>"+"/"+ id,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>

<script type="text/javascript">
function ventanaN(id)
{
ventana1=window.open("<?php echo e(url('ues/grupos/notasG')); ?>"+"/"+ id,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>

<script type="text/javascript">
function ventanaC(id)
{
ventana1=window.open("<?php echo e(url('ues/grupos/cronogramapdf')); ?>"+"/"+ id,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>


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

function nuevafuncion(){
      var idetapa = $('#etapaselect option:selected').val();
       var idgrupo =document.getElementById('idgrupo').value;
      if (idetapa >-1) {
        var url = "<?php echo e(route('ues.getnotas')); ?>";
     
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
          idgrupo:idgrupo, idetapa:idetapa
        }
      });
      $.ajax({
        type:'POST',
        url:url,
        dataType:'json',
        success:function(data) {
        

        for (var i =  0; i < data['not'].length; i++) {
var not=data['not'][i];
var str1 = "u";
var str2 = not.idestudiante;
var res = str1.concat(str2);
console.log(not);
         
         document.getElementById(res).value=not.nota;
        
         
}
         
        },
        error:function(data) {
          console.log("error: "+ data.responseText);
        }
      });
      }
    }

  </script>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>