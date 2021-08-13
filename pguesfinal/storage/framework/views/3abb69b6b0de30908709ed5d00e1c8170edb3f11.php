

<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-modalup">
	<?php echo e(Form::Open(['rol'=>'form','route' => ['ues.nuevaetapa.destroy',':bar'], 'method' => 'DELETE', 'class' => 'form-horizontal','id'=>'Formstatus','name'=>'Formstatus'])); ?>

          
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">
				
                <h4 class="modal-title" id="modal-title"></h4>
			</div>
			<div class="modal-body">
				<p id="modal-body"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
		
	</div>
	<?php echo e(Form::Close()); ?>




</div>