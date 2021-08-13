
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-ver-<?php echo e($fac->idfacultad); ?>">
	<?php echo e(Form::Open(array('action'=>array('FacultadController@edit',$fac->idfacultad),'method'=>'PATCH'))); ?>

	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->

          <h4 class="modal-title">Información de la Facultad</h4>

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
              <input disabled id="edit-id" type="text" class="form-control" name="id" value="<?php echo e($fac->idfacultad); ?>" placeholder="Ingresar nombre">
            </div>      
      </div>


      <?php /*   <div class="form-group"> 
          <label>Código</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-database"></i></span>
              <input disabled autocomplete="off"  type="text" class="form-control" name="codigo" value="<?php echo e($fac->codigo); ?>" placeholder="Ingresar codigo">
            </div>      
      </div> */ ?>


          <div class="form-group"> 
          <label>Nombre</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input disabled autocomplete="off" id="edit-nombre" type="text" class="form-control" name="nombre" value="<?php echo e($fac->nombre); ?>" placeholder="Ingresar nombre">
            </div>      
      </div>

      <div class="form-group"> 
      <label>Teléfono</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input disabled type="text" data-inputmask="'mask':'9999-9999'" data-mask id="edit-telefono" class="form-control" name="telefono" value="<?php echo e($fac->telefono); ?>" placeholder="Ingresar teléfono">
            </div>      
      </div>

      <div class="form-group"> 
      <label>Dirección</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <input disabled type="text" id="edit-direccion" class="form-control" name="direccion" value="<?php echo e($fac->direccion); ?>" placeholder="Ingresar dirección">
            </div>      
      </div>

       </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>

       

      </form>

    </div>
		</div>
		
	</div>
	<?php echo e(Form::Close()); ?>




</div>