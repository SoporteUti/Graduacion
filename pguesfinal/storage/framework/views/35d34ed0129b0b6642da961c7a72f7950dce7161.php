<div class="modal fade modal-slide-in-right" aria-hidden="true" 
 role="dialog" tabindex="-1"  id="imprimirc-4-<?php echo e($gs->idgrupsol); ?>">
<?php echo e(Form::Open(array('action'=>array('solicitudpicController@sRatificaciondeTribunalCoordinador'),'route'=>['ues.solicitudesconta.sRatificaciondeTribunalCoordinador'], 'method'=>'post', 'files' =>'true'))); ?>

 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Ratificación de Tribunal Calificador</h4>
    </div>
    <div class="modal-body">

    <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idsolicitud</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($gs->idgrupsol); ?>" name="idsolicitud" id="idsolicitud" class="form-control"  >
                </div>          
            </div>
            </div>

            <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idgruposol</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->idgrupo); ?>" name="idgrupo" id="idgrupo" class="form-control"  >
                </div>          
            </div>
            </div>

            <div hidden=""  class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idgrupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($gs->idgrupsol); ?>" name="idgrupo" id="idgrupo" class="form-control"  >
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
                   <input id="codigo" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"  value="<?php echo e($grupos->codigoG); ?>"  class="form-control" name="codigo"  maxlength="11" autofocus>
                </div>          
            </div>
            </div>

      
           <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" > 
        <div class="form-group"> 
            <label>Tribunal</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                    <?php foreach($personas as $per): ?>
                    <?php foreach($docentes as $docente): ?>
                    <?php foreach($tribunal as $tribu): ?>
                    <?php if($per->idpersona == $docente->idpersona && $docente->iddocente==$tribu->iddocente&& $tribu->idgrupsol==$gs->idgrupsol): ?>
                    <?php if($per->condicion==true): ?>
                    <input disabled type="text" class="form-control"   value="<?php echo e($docente->titulo." ".$per->nombres." ".$per->apellidos); ?>">
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php endforeach; ?>
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