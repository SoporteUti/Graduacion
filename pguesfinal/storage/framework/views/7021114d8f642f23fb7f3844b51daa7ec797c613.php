    <div class="modal fade modal-slide-in-right" aria-hidden="true" 
    role="dialog" tabindex="-1" id="registrard-9-<?php echo e($gs->idgrupsol); ?>">
    <?php echo e(Form::Open(array('action'=>array('solicitudController@registrar9director'),'route'=>['ues.solicitudes.registrar9director'], 'method'=>'post', 'files' =>'true'))); ?>

    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background:#00a65a; color:white>
          <h4 class="modal-title">Registrar Documentación - Renuncia al Proceso de Graduación</h4>
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
<div hidden=""  class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Estudiante </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
           <?php foreach($re as $re): ?>
                
                <?php foreach($estudiantes as $est): ?>
                <?php if($re->idestudiante==$est->idestudiante && $re->idgrupsol==$gs->idgrupsol): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>
        
                <input readonly=""  name="estudianterenuncia"  id="estudianterenuncia" type="text" class="form-control"    value="<?php echo e($est->idestudiante); ?>">
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
               
            <?php endforeach; ?>  
                </div>          
            </div>
        </div> 


          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group"> 
                <label>Registrar Documentos Enviados a J.D</label>
                    <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                        <input type="file" accept="application/pdf" id="dcenviados" name="dcenviados" placeholder="firmados" class="form-control">
                    </div>          
                </div>
                </div>
          
    <?php if($gs->pdf!=""): ?>
     <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >

                           <div class="form-group" >
                                        <label>Documentos Enviados</label>             

         <div class="input-group" >    

    <a href="<?php echo e(asset('storage/documentosenviados/'.$gs->pdf)); ?>" target="_blank" >
                       <i  class="fa fa-file-pdf-o fa-4x fa-lg"></i></a>

    </div>         
                </div>
    </div>
    <?php endif; ?>
         
         <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group"> 
                <label>Registrar Documentos Recibidos de J.D</label>
                    <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                        <input type="file" accept="application/pdf" id="dcrecibidos" name="dcrecibidos" placeholder="firmados" class="form-control">
                    </div>          
                </div>
                </div>    
          
    <?php if($gs->pdfrecibido!=""): ?>
     <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >

                           <div class="form-group" >
                                        <label>Documentos Recibidos</label>             

         <div class="input-group" >    

    <a href="<?php echo e(asset('storage/documentosrecibidos/'.$gs->pdfrecibido)); ?>" target="_blank" >
                       <i  class="fa fa-file-pdf-o fa-4x fa-lg"></i></a>

    </div>        
                </div>
    </div>
           <?php endif; ?>
           
             <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6" >
                <div class="form-group"> 
                <label>Registrar Numero de Acuerdo</label>
                    <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                        <input type="tex"  id="nacuerdo" name="nacuerdo" value="<?php echo e($gs->nacuerdo); ?>" placeholder="Número de acuerdo" class="form-control">
                    </div>          
                </div>
                </div>  

                             

                   <?php if($gs->estado!=1 && $gs->estado!=7): ?>   
            <div  class="col-lg-6 col-md-6 col-xs-6 col-sm-6" >
           <div class="form-group" > 
               <label>Estado (*)</label>          
             <div class="input-group">      
                         
                <span class="input-group-addon"><i class="fa fa-child"></i></span>
                    <select name="aprobado" id="aprobado" class="form-inline form-control">
                    <option value="-1">[Seleccione]</option>
                      <option value="0">Aprobado</option>
                    <option value="1">Denegado</option>
                    </select>
                </div> 
                  </div>  
                </div>
                <?php else: ?>
                <div  class="col-lg-6 col-md-6 col-xs-6 col-sm-6" >
           <div class="form-group" > 
               <label>Estado (*)</label>          
             <div class="input-group">      
                         
                <span class="input-group-addon"><i class="fa fa-child"></i></span>
                    <select name="aprobado" id="aprobado" class="form-inline form-control">
                   <?php if($gs->estado==1 ): ?> 
                   <option value="0">Aprobado</option>
                   <?php else: ?>
                   <?php if($gs->estado==7 ): ?> 
                    <option value="1">Denegado</option>
                    <?php endif; ?>
                    <?php endif; ?>
                    </select>
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