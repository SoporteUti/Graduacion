    <div class="modal fade modal-slide-in-right" aria-hidden="true" 
    role="dialog" tabindex="-1" id="registrard-7-<?php echo e($gs->idgrupsol); ?>">
    <?php echo e(Form::Open(array('action'=>array('solicitudController@registrar7director'),'route'=>['ues.solicitudes.registrar7director'], 'method'=>'post', 'files' =>'true'))); ?>

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background:#00a65a; color:white>
          <h4 class="modal-title">Registrar Documentación - Notificación Inasistencia </h4>
        </div>
        <div class="modal-body">

     <div  hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group"> 
                <label>idgrupsol</label>
                    <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                        <input readonly="" type="text" value="<?php echo e($gs->idgrupsol); ?>" name="idsolicitud" id="idsolicitud" class="form-control"  >
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
                <label>Registrar Documentos Recibidos - Coordinador General</label>
                    <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                        <input type="file" accept="application/pdf" id="dcenviados" name="dcenviados" placeholder="firmados" class="form-control">
                    </div>          
                </div>
                </div>
          
    <?php if($gs->pdf!=""): ?>
     <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >

                           <div class="form-group" >
                                        <label>Documentos Recibidos</label>             

         <div class="input-group" >    

    <a href="<?php echo e(asset('storage/documentosenviados/'.$gs->pdf)); ?>" target="_blank" >
                       <i  class="fa fa-file-pdf-o fa-4x fa-lg"></i></a>

    </div>         
                </div>
    </div>
    <?php endif; ?>
         
          

             

              
             

                   
              
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="rel();" data-dismiss="modal">Cerrar</button>
          <button type="submit" onclick="" class="btn btn-primary">Registrar</button>
        </div>
      </div>
    </div>
    <?php echo e(Form::Close()); ?>

    </div>
    