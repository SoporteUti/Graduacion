<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1"  id="motivo-{{$gs->idgrupsol}}">
{{Form::Open(array('action'=>array('solicitudController@cancelar'),'route'=>['ues.solicitudes.cancelar'], 'method'=>'post', 'files' =>'true'))}}
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud Cancelada</h4>
    </div>
    <div class="modal-body">
 <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de solicitud</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="{{$gs->idgrupsol}}" name="idsolicitud" id="idsolicitud" class="form-control"  >
                </div>          
            </div>
            </div> @foreach($solicitudc as $sc)
                    @if($sc->idgrupsol==$gs->idgrupsol)
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Motivo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                   
                    <textarea   name="motivo"  cols="35" id="motivo" class="form-control" >{{$sc->motivo}}</textarea>
                   
                </div>          
            </div>
            </div>
           @endif
                    @endforeach
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      
    </div>
  </div>
</div>
{{Form::Close()}}
</div>