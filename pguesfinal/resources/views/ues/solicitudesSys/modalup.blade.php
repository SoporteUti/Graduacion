<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-modalup-{{$sol->idsolicitud}}">
	{{Form::Open(array('action'=>array('SolicitudSysController@destroy',$sol->idsolicitud),'method'=>'delete'))}}
          
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Dar de Alta la Solicitud</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Dar de Alta la a Solicitud: <strong>{{$sol->nomSolicitud}}</strong> </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>	
	</div>
	{{Form::Close()}}
</div>