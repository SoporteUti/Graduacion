<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-modalup-<?php echo e($grup->idgrupo); ?>">
	<?php echo e(Form::Open(array('action'=>array('GrupoController@destroy',$grup->idgrupo),'method'=>'delete'))); ?>          
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">
				
                <h4 class="modal-title">Dar de Alta el Grupo</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Dar de Alta el Grupo: <strong><?php echo e($grup->codigoG); ?></strong></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
	</div>
	<?php echo e(Form::Close()); ?>

</div>