<div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
        
        <h4 class="modal-title">Agregar Ponderación Trabajo Graduación</h4>
      </div>
      {{Form::Open(array('action'=>array('PonderacionController@store'),'route'=>'ues.ponderacion.store','method'=>'POST','id'=>'formPoderaciones'))}}
      {{Form::token()}}
      <div class="modal-body">
        <div class="header">
         {{--  <h2>{{ $ttem->tema }}</h2> --}}
        </div>
        @if($ttem->idtipotema)<input type="hidden" name="idtipotrabajo" value="{{$ttem->idtipotema}}">
      
      @endif        <div class="responsive">
          <table id="tblPonderacion" class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Etapa</th>
                <th>Ponderación</th>
              </tr>
            </thead>
            <tbody id="listEtapas">
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button id="sendPorcent" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>

        {{Form::Close()}}
      </div>
    </div>
  </div>
</div>