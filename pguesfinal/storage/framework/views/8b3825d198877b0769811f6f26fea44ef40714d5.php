
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-ver-<?php echo e($carr->idcarrera); ?>">
	<?php echo e(Form::Open(array('action'=>array('CarreraController@edit',$carr->idcarrera),'method'=>'PATCH'))); ?>

	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          

          <h4 class="modal-title">Información de la Carrera</h4>

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
              <input disabled id="edit-id" type="text" class="form-control" value="<?php echo e($carr->idcarrera); ?>" >
            </div>      
      </div>


          <div class="form-group"> 
          <label>Código</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-database"></i></span>
              <input disabled autocomplete="off"  type="text" class="form-control"  value="<?php echo e($carr->codigo); ?>">
            </div>      
      </div>

      <div class="form-group"> 
      <label>Nombre</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input disabled type="text" class="form-control" value="<?php echo e($carr->nombre); ?>" >
            </div>      
      </div>

      <div class="form-group"> 
      <label>Departamento</label>
        <div class="input-group"  >         
          <span class="input-group-addon" ><i class="fa fa-sitemap"></i></span>
          <?php foreach($departamento as $depto): ?>
                            <?php if($depto->iddepartamento==$carr->iddepartamento ): ?>
              <input disabled type="text" class="form-control"  value="<?php echo e($depto->nombre); ?>"> 
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