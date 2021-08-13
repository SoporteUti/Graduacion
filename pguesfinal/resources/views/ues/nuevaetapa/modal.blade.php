

<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-delete-{{$etanom->idetapanombre}}">
	{{Form::Open(array('action'=>array('etapasnombreController@destroy',$etanom->idetapanombre),'method'=>'delete'))}}
	
          
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">
				
                <h4 class="modal-title">Dar de Baja Etapa</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Dar de Baja la Etapa: <strong>{{$etanom->nombreetapa}}</strong> </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
		
	</div>
	{{Form::Close()}}



</div>