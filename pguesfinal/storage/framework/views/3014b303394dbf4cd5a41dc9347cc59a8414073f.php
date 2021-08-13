

<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-modalup-<?php echo e($cat->idcategoria); ?>">
	<?php echo e(Form::Open(array('action'=>array('categoriasController@destroy',$cat->idcategoria),'method'=>'delete'))); ?>

          
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">
				
                <h4 class="modal-title">Dar de Alta la Categoría</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Dar de Alta la Categoría: <strong><?php echo e($cat->nombrecat); ?></strong> </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
		
	</div>
	<?php echo e(Form::Close()); ?>




</div>