

<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-modalup-<?php echo e($per->idpersona); ?>">
	<?php echo e(Form::Open(array('action'=>array('EstudianteController@destroy',$per->idpersona),'method'=>'delete'))); ?>

          
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">
				
                <h4 class="modal-title">Dar de Alta Estudiante</h4>
			</div>
			<div class="modal-body">
				<?php foreach($estudiante as $est): ?>
				<?php if($est->idpersona==$per->idpersona): ?>
				<p>Confirme si desea Dar de Alta el Estudiante: <strong><?php echo e($per->nombres." ".$per->apellidos." ".
					"Carné:"." ". $est->carnet); ?></strong> </p>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
		
	</div>
	<?php echo e(Form::Close()); ?>




</div>