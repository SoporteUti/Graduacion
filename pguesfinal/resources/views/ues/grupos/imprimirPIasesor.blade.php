<!-- solicitudes: Prorroga interna -->
<div class="modal fade" id="imprimirc-2-{{$gs->idgrupsol}}">
{{Form::Open(array('action'=>array('solicitudController@impspsistemasA'),'route'=>['ues.solicitudes.impspsistemasA'], 'method'=>'post', 'files' =>'true'))}}
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud de Prórroga Interna</h4>
    </div>
<div class="modal-body">
   <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idsolicitud</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="{{$gs->idgrupsol}}" name="idsolicitud" id="idsolicitud" class="form-control">
                </div>          
            </div>
            </div>

            
   <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idgruposol</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="{{$grupos->idgrupo}}" name="idgrupo" id="idgrupo" class="form-control"  >
                </div>          
            </div>
            </div>

           

            <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>numero de etapas</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="{{$var}}" name="netapas" id="netapas" class="form-control"  >
                </div>          
            </div>
            </div>

      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="{{$grupos->codigoG}}" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>

   

            <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>numero de etapas</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="{{$var}}" name="netapas" id="netapas" class="form-control"  >
                </div>          
            </div>
            </div>




      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
            <div class="form-group"> 
            <label>Fecha de Inicio</label>
                <div class="input-group">     
                            
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    @foreach($progai as $pi)         
                        @if( $gs->idgrupsol == $pi->idgrupsol) 
                    <input readonly=""   class="form-control"  value="{{\Carbon\Carbon::parse($pi->fechaInicio)->format('d-m-Y') }}"  >
                        @endif
                    @endforeach

                </div>          
            </div>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
            <div class="form-group"> 
            <label>Fecha de Finalización</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                     @foreach($progai as $pi)         
                        @if( $gs->idgrupsol == $pi->idgrupsol) 
                    <input readonly=""   class="form-control"  value="{{\Carbon\Carbon::parse($pi->fechaFinal)->format('d-m-Y') }}"   >
                     @endif
                    @endforeach 

                </div>          
            </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Motivo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                     @foreach($progai as $pi)         
                        @if( $gs->idgrupsol == $pi->idgrupsol) 
                    <textarea   name="motivo"  cols="35" id="motivo" class="form-control" >{{$pi->motivo}}</textarea>
                     @endif
                    @endforeach
                </div>          
            </div>
           
          
    </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button>
    </div>
  </div>
</div>
{{Form::Close()}}
</div>
