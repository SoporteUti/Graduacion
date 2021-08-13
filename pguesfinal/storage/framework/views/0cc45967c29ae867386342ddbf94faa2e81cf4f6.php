<!-- solicitudes: Prorroga interna -->
<div class="modal fade" id="imprimirc-7-<?php echo e($gs->idgrupsol); ?>">
<?php echo e(Form::Open(array('action'=>array('solicitudController@imprimir7asesor'),'route'=>['ues.solicitudes.imprimir7asesor'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Notificación por Inasistencia</h4>
    </div>
<div class="modal-body">
   <div  hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idsolicitud</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($gs->idgrupsol); ?>" name="idsolicitud" id="idsolicitud" class="form-control">
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
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->codigoG); ?>" name="codigo" id="codigo" class="form-control"  >
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

 <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Estudiante </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
           <?php foreach($ni as $ni): ?>
                <?php if($ni->idgrupo==$grupos->idgrupo): ?>
                <?php foreach($estudiantes as $est): ?>
                <?php if($ni->idestudiante==$est->idestudiante && $ni->idgrupsol==$gs->idgrupsol): ?>
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

   <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Numero</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                       <?php foreach($ni1 as $ni1): ?>
                       <?php if($ni1->idgrupsol==$gs->idgrupsol): ?>
                    <input readonly=""  type="text" class="form-control"  id="numero" name="numero"  value="<?php echo e($ni1->numero); ?>">
                     <?php endif; ?>
                <?php endforeach; ?>  
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
