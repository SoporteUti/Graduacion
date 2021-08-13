
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-ver-<?php echo e($tas->idtipoasesor); ?>">
	<?php echo e(Form::Open(array('action'=>array('TipoasesorController@edit',$tas->idtipoasesor),'method'=>'PATCH'))); ?>

	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

         

          <h4 class="modal-title">Información del Tipo de Asesor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <div hidden="" class="form-group"> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input disabled id="edit-id" type="text" class="form-control" value="<?php echo e($tas->idtipoasesor); ?>" >
            </div>      
      </div>


      <div class="form-group"> 
      <label>Tipo de Asesor</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input disabled type="text" class="form-control" value="<?php echo e($tas->tipoasesor); ?>" >
            </div>      
      </div>


          <!-- <div class="form-group"> 
          <label>Carrera </label>
            <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <select disabled="" name="carr" id="carr" class="form-inline form-control">               
                    <?php foreach($carreras as $car): ?>
                    <?php if($car->idcarrera==$tas->idcarrera): ?>
                    <option value="<?php echo e($tas->idcarrera); ?>"><?php echo e($car->nombre); ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    </select>
            </div>      
          </div>
        -->

    

       </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"></i>Cerrar</button>
      </div>

       

      </form>

    </div>
		</div>
		
	</div>
	<?php echo e(Form::Close()); ?>




</div>