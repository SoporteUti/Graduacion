<!-- solicitudes: Prorroga interna -->
<div class="modal fade" id="imprimirc-9-{{$gs->idgrupsol}}">
{{Form::Open(array('action'=>array('solicitudController@imprimir9coordinador'),'route'=>['ues.solicitudes.imprimir9coordinador'], 'method'=>'post', 'files' =>'true'))}}
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Renuncia al Proceso de Graduación </h4>
    </div>
<div class="modal-body">
   <div  hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
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
            <label>idgrupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="{{$grupos->idgrupo}}" name="idgrupo" id="idgrupo" class="form-control"  >
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

 <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Estudiante </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
           @foreach($re as $re)
               
                @foreach($estudiantes as $est)
                @if($re->idestudiante==$est->idestudiante && $re->idgrupsol==$gs->idgrupsol)
                @foreach($personas as $per)
                @if($per->idpersona == $est->idpersona)
        
                <input readonly=""  type="text" class="form-control" id="estudianteR" name="estudianteR"  value="{{$est->carnet." ".$per->nombres." ".$per->apellidos}}">
                @endif
                @endforeach
                @endif
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
