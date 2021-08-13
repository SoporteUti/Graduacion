<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-delete-{{$grup->idgrupo}}">
	{{Form::Open(array('action'=>array('GrupoController@destroy',$grup->idgrupo),'method'=>'delete'))}}      
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">
				
                <h4 class="modal-title">Dar de Baja el Grupo</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Dar de Baja el Grupo: <strong>{{$grup->codigoG}}</strong> </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>		
	</div>
	{{Form::Close()}}
</div>