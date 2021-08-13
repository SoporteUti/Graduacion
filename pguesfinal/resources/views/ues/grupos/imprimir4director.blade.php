<div class="modal fade modal-slide-in-right" aria-hidden="true" 
 role="dialog" tabindex="-1"  id="imprimird-4-{{$gs->idgrupsol}}">
{{Form::Open(array('action'=>array('solicitudpicController@sRatificaciondeTribunalDirector'),'route'=>['ues.solicitudesconta.sRatificaciondeTribunalDirector'], 'method'=>'post', 'files' =>'true'))}}
 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Ratificación de Tribunal Calificador</h4>
    </div>
    <div class="modal-body">

    <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idsolicitud</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="{{$gs->idgrupsol}}" name="idsolicitud" id="idsolicitud" class="form-control"  >
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

            <div hidden=""  class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idgrupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="{{$gs->idgrupsol}}" name="idgrupo" id="idgrupo" class="form-control"  >
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
                   <input id="codigo" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"  value="{{$grupos->codigoG}}"  class="form-control" name="codigo"  maxlength="11" autofocus>
                </div>          
            </div>
            </div>

      
           <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" > 
        <div class="form-group"> 
            <label>Tribunal</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                    @foreach($personas as $per)
                    @foreach($docentes as $docente)
                    @foreach($tribunal as $tribu)
                    @if($per->idpersona == $docente->idpersona && $docente->iddocente==$tribu->iddocente && $tribu->idgrupsol==$gs->idgrupsol)
                    @if($per->condicion==true)
                    <input disabled type="text" class="form-control"   value="{{$docente->titulo." ".$per->nombres." ".$per->apellidos}}">
                    @endif
                    @endif
                    @endforeach
                    @endforeach
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