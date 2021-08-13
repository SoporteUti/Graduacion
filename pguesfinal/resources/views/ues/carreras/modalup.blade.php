

<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-modalup-{{$carr->idcarrera}}">
	{{Form::Open(array('action'=>array('CarreraController@destroy',$carr->idcarrera),'method'=>'delete'))}}
          
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">

                <h4 class="modal-title">Dar de Alta Carrera</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Dar de Alta la Carrera: <strong>{{$carr->nombre}}</strong> </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
		
	</div>
	{{Form::Close()}}



</div>