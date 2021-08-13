<?php $__env->startSection('contenido'); ?>


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
    <div class="collapse navbar-collapse navbar-ex1-collapse">
      <ul class="nav navbar-nav">
       <ul class="nav navbar-nav ">
  <li class="dropdown">
                   
                      
              
                      
                        <li><a href="#solicitud-5" data-toggle="modal" data-target="#solicitud-5"><strong>Resultados</strong></a></li>

                      
                   
                   
      
                </ul>

                <ul class="nav navbar-nav navbar-right">
                 
    
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
                   <table class="table table-bordered table-striped"  id="<?php echo e($et->idetapa); ?>">
                     <thead>
                       <tr>
                         <th>N°</th>
                         <th>
                         Actividades realizadas </th> 
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
                   <td ><?php echo e($gs->fecha); ?> </td>
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

                          

                   <a href=""   data-target="#verpdfs1-<?php echo e($gs->idgrupsol); ?>" data-toggle="modal">
                    <button   class="btn btn-success"><i  class=" fa fa-folder-open"></i></button></a>
                
                        </td>

                          
                         
                          <?php echo $__env->make('ues.grupos.imprimir3asesor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                          <?php echo $__env->make('ues.grupos.imprimir7asesor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                          <?php echo $__env->make('ues.grupos.imprimir6asesor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                          <?php echo $__env->make('ues.grupos.imprimir4asesor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                          <?php echo $__env->make('ues.grupos.imprimirPIasesor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                          <?php echo $__env->make('ues.grupos.verpdfs1', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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

<?php echo $__env->make('ues.grupos.asistencia', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <!-- tap pane para controlde asesorias-->



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
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
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




<!-- solicitudes: Prorroga interna  -->
<div class="modal fade" id="solicitud-2">
  <?php echo e(Form::Open(array('action'=>array('solicitudController@spsistemas'),'route'=>['ues.solicitudes.spsistemas'], 'method'=>'post', 'files' =>'true'))); ?>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud de Prórroga Interna</h4>
    </div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
     <div class="form-group"> 
      <div  class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-database"></i></span>
        <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="2" >
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

  <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
    <div class="form-group"> 
      <label>numero de etapas</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-info"></i></span>
        <input readonly="" type="text" value="<?php echo e($var); ?>" name="netapas" id="netapas" class="form-control"  >
      </div>          
    </div>
  </div>
  <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
    <div class="form-group"> 
      <label>Fecha de Emisión</label>   
      <div class="input-group">  
        <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
        <input readonly="" type="date" class="form-control" id="fechaEm" name="fechaEm" step="1" value="<?php echo date("Y-m-d");?>" >
      </div>         
    </div>
  </div>

  <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
    <div class="form-group"> 
      <label>Fecha de Inicio</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        <input type="date" name="fechai" id="fechai" class="form-control" step="31" value="<?php echo date("Y-m-d");?>"  required="required" >
      </div>          
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
    <div class="form-group"> 
      <label>Fecha de Finalización</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        <input type="date" name="fechaf" id="fechaf" class="form-control" step="1" value="<?php echo date("Y-m-d");?>"  required="required" >
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

<!-- solicitudes: Prorroga JD  -->

<div class="modal fade" id="solicitud-3">
  <?php echo e(Form::Open(array('action'=>array('solicitudController@prorrogajd'),'route'=>['ues.solicitudes.prorrogajd'], 'method'=>'post', 'files' =>'true'))); ?>

  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud de Prórroga a Junta Directiva</h4>
    </div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
     <div class="form-group"> 
      <div  class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-database"></i></span>
        <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="3" >
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

  <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
    <div class="form-group"> 
      <label>numero de etapas</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-info"></i></span>
        <input readonly="" type="text" value="<?php echo e($var); ?>" name="netapas" id="netapas" class="form-control"  >
      </div>          
    </div>
  </div>
  <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
    <div class="form-group"> 
      <label>Fecha de Emisión</label>   
      <div class="input-group">  
        <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
        <input readonly="" type="date" class="form-control" id="fechaEm" name="fechaEm" step="1" value="<?php echo date("Y-m-d");?>" >
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

<!-- solicitudes: Ratificacion de resultados -->

<div class="modal fade" id="solicitud-5">
<?php echo e(Form::Open(array('action'=>array('solicitudController@ratiResul'),'route'=>['ues.solicitudes.ratiResul'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Resultados</h4>
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
                <?php if($per->idpersona == $est->idpersona && Auth::user()->idpersona==$per->idpersona): ?>
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
      <div class="modal-header" style="background:#00a65a; color:white>
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
      <div class="modal-header" style="background:#00a65a; color:white>
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



  <div class="col-lg12 col-md-12 col-xs-12 col-sm-12" > 
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
      <div class="modal-header" style="background:#00a65a; color:white>
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


<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  $(document).ready(function () {
   $(".chosen-select").chosen({no_results_text: "Oops,no se encontraron resultados!",width: "100%"});     

   $('.loadAlumns').click(function(e) {
      console.log(e);
   });
   
    
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
           
      function loadAlumns(idgrupo) {
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              var list = $("#alumns-list");
              var url = "<?php echo e(route('grupo.integrantes',':bar')); ?>";
              url = url.replace(':bar', idgrupo);
              list.empty();
              $.ajax({
                type: 'GET',
                url: url,
                data: {id:idgrupo},
                dataType: 'json',
                success: function (data) {
                  console.log(data.alumnos);
                  for (var i =  0; i <data.alumnos.length; i++) {
                    var alumno = data.alumnos[i];
                    list.append(
                    '<tr>'+
                    '<td>'+
                    '<input type="hidden" name="estudiante['+i+'][idestudiante]" value="'+alumno["id"] +'">'
                    + alumno["nombre"]+
                    '</td><td><div class="btn-group">'+
                    '<input type="hidden" class="asistencia" name="estudiante['+i+'][asistencia]" value="0">'+
                    '<label>Asistio <input type="radio" name="radio'+i+'" onclick="asistencia(this)" value="1"></label>'+
                    '<label>No Asistio <input type="radio" name="radio'+i+'" checked="" onclick="asistencia(this)" value="0"></label>'+'</div></td></tr>'
                    );
                  }
                  

                },
                error: function (data) {
                  console.log('Error:', data.responseText);
                }
              });//fin
            }
            function asistencia(radio) {
              radio.parentNode.parentNode.getElementsByClassName("asistencia")[0].value =radio.value;
            }
          </script>

          


          <?php $__env->stopSection(); ?>







<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>