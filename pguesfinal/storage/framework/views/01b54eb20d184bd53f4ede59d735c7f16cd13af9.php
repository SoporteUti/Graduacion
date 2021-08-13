    <div class="modal fade modal-slide-in-right" aria-hidden="true" 
    role="dialog" tabindex="-1" id="verpdfs-<?php echo e($gs->idgrupsol); ?>">
   
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background:#00a65a; color:white">
          <h4 class="modal-title">Ver Documentación </h4>
        </div>
        <div class="modal-body">

    
                

          
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
         
        <div> 
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
           
            

                             

              
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="rel();" data-dismiss="modal">Cerrar</button>
         
        </div>
      </div>
    </div>
   
    </div>