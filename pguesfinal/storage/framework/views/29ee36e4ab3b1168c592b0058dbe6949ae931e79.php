

<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-delete-<?php echo e($carr->idcarrera); ?>">
	<?php echo e(Form::Open(array('action'=>array('CarreraController@destroy',$carr->idcarrera),'method'=>'delete'))); ?>

	
          
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">
               
                <h4 class="modal-title">Dar de Baja Carrera</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Dar de Baja la Carrera: <strong><?php echo e($carr->nombre); ?></strong> </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
		
	</div>
	<?php echo e(Form::Close()); ?>




</div>