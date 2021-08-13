    <div class="modal fade modal-slide-in-right" aria-hidden="true" 
    role="dialog" tabindex="-1" id="registrard-9-{{$gs->idgrupsol}}">
    {{Form::Open(array('action'=>array('solicitudController@registrar9director'),'route'=>['ues.solicitudes.registrar9director'], 'method'=>'post', 'files' =>'true'))}}
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background:#00a65a; color:white">
          <h4 class="modal-title">Administrar Documentación</h4>
        </div>
        <div class="modal-body">

     <div  hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group"> 
                <label>idgrupsol</label>
                    <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                        <input readonly="" type="text" value="{{$gs->idgrupsol}}" name="idsolicitud" id="idsolicitud" class="form-control"  >
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
                <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group"> 
                <label>numero de etapas</label>
                    <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                        <input readonly="" type="text" value="{{$var}}" name="netapas" id="netapas" class="form-control"  >
                    </div>          
                </div>
                </div>
<div hidden=""  class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Estudiante </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
           @foreach($re as $re)
                
                @foreach($estudiantes as $est)
                @if($re->idestudiante==$est->idestudiante && $re->idgrupsol==$gs->idgrupsol)
                @foreach($personas as $per)
                @if($per->idpersona == $est->idpersona)
        
                <input readonly=""  name="estudianterenuncia"  id="estudianterenuncia" type="text" class="form-control"    value="{{$est->idestudiante}}">
                @endif
                @endforeach
                @endif
                @endforeach
               
            @endforeach  
                </div>          
            </div>
        </div> 


          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group"> 
                <label>Documento Adjunto</label>
                    <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                        <input type="file" accept="application/pdf" id="dcenviados" name="dcenviados" placeholder="firmados" class="form-control">
                    </div>          
                </div>
                </div>
          
   
          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group"> 
                <label>Solicitud Director</label>
                    <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                        <input type="file" accept="application/pdf" id="solicituddir" name="solicituddir" placeholder="firmados" class="form-control">
                    </div>          
                </div>
                </div>
         
         <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group"> 
                <label>Acuerdo Junta Directiva</label>
                    <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                        <input type="file" accept="application/pdf" id="dcrecibidos" name="dcrecibidos" placeholder="firmados" class="form-control">
                    </div>          
                </div>
                </div>    
 
           <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Documentos Disponibles</label>
                                 
                                  </div>
            </div>
            @if($gs->solicitudcoor!="")
           <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group"> 
                         <div class="input-group"> 
                     
                  <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i><a href="{{asset('storage/solicitudcoor/'.$gs->solicitudcoor)}}" target="_blank" >
                      <label>Solicitud Coordinador</label> </a></span>
                      
                    </div>  

              </div>
            </div> 
            @endif
                     @if($gs->solicituddir!="") 
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group"> 
                       <div class="input-group">  
                     
                  <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i><a href="{{asset('storage/solicituddir/'.$gs->solicituddir)}}" target="_blank" >
                      <label>Solicitud Director</label> </a></span>
                       
                         </div>
                                        </div>

                                                   </div>
                         @endif                          
                        @if($gs->pdf!="")  
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group">                        
                     <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i><a href="{{asset('storage/documentosenviados/'.$gs->pdf)}}" target="_blank" >
                      <label>Documento Adjunto</label> </a></span>
                     
                      </div>
                             </div>
                             </div>
                             @endif 
                             @if($gs->pdfrecibido!="") 
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
                <div class="form-group">  
                 
                    <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i><a href="{{asset('storage/documentosrecibidos/'.$gs->pdfrecibido)}}" target="_blank" ><label>Acuerdo Junta Directiva</label></a></span>
                                    
              </div>
                       </div>
                             </div>   @endif
           
             <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6" >
                <div class="form-group"> 
                <label>Registrar Numero de Acuerdo</label>
                    <div class="input-group">                   
                        <span class="input-group-addon"><i class="fa fa-info"></i></span>
                        <input type="tex"  id="nacuerdo" name="nacuerdo" value="{{$gs->nacuerdo}}" placeholder="Número de acuerdo" class="form-control">
                    </div>          
                </div>
                </div>  

                             

                   @if($gs->estado!=1 && $gs->estado!=7)   
            <div  class="col-lg-6 col-md-6 col-xs-6 col-sm-6" >
           <div class="form-group" > 
               <label>Estado (*)</label>          
             <div class="input-group">      
                         
                <span class="input-group-addon"><i class="fa fa-child"></i></span>
                    <select name="aprobado" id="aprobado" class="form-inline form-control">
                    <option value="-1">[Seleccione]</option>
                      <option value="0">Aprobado</option>
                    <option value="1">Denegado</option>
                    </select>
                </div> 
                  </div>  
                </div>
                @else
                <div  class="col-lg-6 col-md-6 col-xs-6 col-sm-6" >
           <div class="form-group" > 
               <label>Estado (*)</label>          
             <div class="input-group">      
                         
                <span class="input-group-addon"><i class="fa fa-child"></i></span>
                    <select name="aprobado" id="aprobado" class="form-inline form-control">
                   @if($gs->estado==1 ) 
                   <option value="0">Aprobado</option>
                   @else
                   @if($gs->estado==7 ) 
                    <option value="1">Denegado</option>
                    @endif
                    @endif
                    </select>
                </div> 
                  </div>  
                </div>
                @endif
              
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger pull-left" onclick="rel();" data-dismiss="modal">Cerrar</button>
          <button type="submit" onclick="" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
    {{Form::Close()}}
    </div>