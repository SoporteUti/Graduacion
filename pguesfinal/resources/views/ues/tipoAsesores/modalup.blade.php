

<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-modalup-{{$tas->idtipoasesor}}">
	{{Form::Open(array('action'=>array('TipoasesorController@destroy',$tas->idtipoasesor),'method'=>'delete'))}}
          
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">
				
                <h4 class="modal-title">Dar de Alta el Tipo Asesor</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Dar de Alta el Tipo de Asesor: <strong>{{$tas->tipoasesor}}</strong> </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
		
	</div>
	{{Form::Close()}}



</div>