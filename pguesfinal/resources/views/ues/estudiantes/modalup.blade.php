

<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-modalup-{{$per->idpersona}}">
	{{Form::Open(array('action'=>array('EstudianteController@destroy',$per->idpersona),'method'=>'delete'))}}
          
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">
				
                <h4 class="modal-title">Dar de Alta Estudiante</h4>
			</div>
			<div class="modal-body">
				@foreach($estudiante as $est)
				@if($est->idpersona==$per->idpersona)
				<p>Confirme si desea Dar de Alta el Estudiante: <strong>{{$per->nombres." ".$per->apellidos." ".
					"Carné:"." ". $est->carnet }}</strong> </p>
					@endif
				@endforeach
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
		
	</div>
	{{Form::Close()}}



</div>