
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="modal-estadisticos">
        <?php echo Form::open(['route'=>['ues.grupos.pdfestadistico'],'method'=>'POST']); ?>

    <div class="modal-dialog">
        <div class="modal-content">
          <form role="form" method="post" enctype="multipart/form-data">
            <div class="modal-header" style="background:#00a65a; color:white">
               <!--  <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                <h4 class="modal-title">Datos Estadiscticos</h4>
            </div>
            <div class="modal-body">
               <div class="box-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <div class="form-group"> 
                <label>Carrera (*)</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                    <select name="carrera" id="carrera" class="form-inline form-control">

                    <option value="">[Seleccione]
                        
                    </option>
                
                    <?php foreach($carreras as $car): ?>
                    <?php if($car->condicion==true): ?>
                  <option value="<?php echo e($car->idcarrera); ?>"><?php echo e($car->nombre); ?>

                        
                    </option>
<?php endif; ?>
 <?php endforeach; ?>
                    </select>
                </div>          
          
                       </div> 
                    </div>
                    
                   
                    
                    
              </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>  Salir</button>
               <button class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
               <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Generar</button>
           </div>
           </form>
       </div>
   </div>
   <?php echo Form::close(); ?>

</div>