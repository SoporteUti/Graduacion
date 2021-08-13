
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-ver-<?php echo e($dep->iddepartamento); ?>">
	<?php echo e(Form::Open(array('action'=>array('departamentosController@edit',$dep->iddepartamento),'method'=>'PATCH'))); ?>

	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          

          <h4 class="modal-title">Información del Departamento</h4>

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
              <input disabled id="edit-id" type="text" class="form-control" name="id" value="<?php echo e($dep->iddepartamento); ?>" placeholder="Ingresar nombre">
            </div>      
      </div>


          <div class="form-group"> 
          <label>Nombre</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input disabled autocomplete="off" id="edit-nombre" type="text" class="form-control" name="nombre" value="<?php echo e($dep->nombre); ?>" placeholder="Ingresar nombre">
            </div>      
      </div>

   <?php /*    <div class="form-group"> 
      <label>Código</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-database"></i></span>
              <input disabled type="text"  id="codigo" class="form-control" name="telefono" value="<?php echo e($dep->codigo); ?>" placeholder="Ingresar teléfono">
            </div>      
      </div> */ ?>

      <div class="form-group"> 
      <label>Facultad</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-bank"></i></span>
          <?php foreach($facultades as $fac): ?>
                <?php if($fac->idfacultad==$dep->idfacultad): ?>

            <input disabled type="text" id="edit-direccion" class="form-control" name="direccion" value="<?php echo e($fac->nombre); ?>" placeholder="Ingresar dirección">
            <?php endif; ?>
            <?php endforeach; ?>
              
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