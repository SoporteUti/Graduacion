<!-- solicitudes: Prorroga interna -->
<div class="modal fade" id="imprimird-3-<?php echo e($gs->idgrupsol); ?>">
<?php echo e(Form::Open(array('action'=>array('solicitudController@imprimir3director'),'route'=>['ues.solicitudes.imprimir3director'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud de Prórroga Junta directiva</h4>
    </div>
<div class="modal-body">

   <div  class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
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


            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Motivo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                     <?php foreach($progajd as $pjd): ?>         
                        <?php if( $gs->idgrupsol == $pjd->idgrupsol): ?> 
                    <textarea   name="motivo"  cols="35" id="motivo" class="form-control" ><?php echo e($pjd->motivo); ?></textarea>
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
