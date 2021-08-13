<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1"  id="imprimirc-1-{{$gs->idgrupsol}}">
{{Form::Open(array('action'=>array('solicitudController@imprimiraprovaciont'),'route'=>['ues.solicitudes.imprimiraprovaciont'], 'method'=>'post', 'files' =>'true'))}}
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Imprimir  Aprobación de Tema</h4>
    </div>
    <div class="modal-body">

 <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idsolicitud</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="1" name="idsolicitud" id="idsolicitud" class="form-control"  >
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
                    <input readonly="" type="text" value="{{$grupos->codigoG}}" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
            
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Tema</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <textarea id="tema" readonly=""    value="{{$grupos->tema}}"  class="form-control" name="tema"  >{{$grupos->tema}}</textarea>
                </div>          
            </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Integrantes </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                @foreach($mostraintegrante as $mint)
                @if($mint->idgrupo==$grupos->idgrupo)
                @foreach($estudiantes as $est)
                @if($mint->idestudiante==$est->idestudiante)
                @foreach($personas as $per)
                @if($per->idpersona == $est->idpersona)
                <input disabled=""  type="text" class="form-control"    value="{{$est->carnet." ".$per->nombres." ".$per->apellidos}}">
                @endif
                @endforeach
                @endif
                @endforeach
                @endif
                @endforeach 
                </div>          
            </div>
        </div>  

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Asesor/es </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                @foreach($asesores as $ase)
                @if($ase->idgrupo==$grupos->idgrupo)
                         @foreach($docentes as $doc)
                                 @if($ase->iddocente==$doc->iddocente)
                     @foreach($personas as $per)
                @if($per->idpersona==$doc->idpersona)
                @foreach($tipoasesor as $tias)
                @if($tias->idtipoasesor==$ase->idtipoasesor)
                <input disabled type="text" class="form-control"   value="{{$doc->titulo." ".$per->nombres." ".$per->apellidos." - ".$tias->tipoasesor}}">
                @endif
                @endforeach 
                @endif
                @endforeach
                @endif
                @endforeach
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