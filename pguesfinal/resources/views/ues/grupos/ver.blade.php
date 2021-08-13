<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-ver-{{$grup->idgrupo}}">
	{{Form::Open(array('action'=>array('GrupoController@edit',$grup->idgrupo),'method'=>'PATCH', 'files' =>'true'))}}       
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00a65a; color:white">
          <h4 class="modal-title">Información del Grupo</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
        <div class="box-body">
        <div hidden="" class="form-group"> 
            <div class="input-group">         
        <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input disabled id="edit-id" type="text" class="form-control" name="id" value="{{$grup->idgrupo}}" placeholder="Ingresar nombre">
            </div>      
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
          <div class="form-group"> 
            <label>Código </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input id="carnet" disabled type="text"  value="{{$grup->codigoG}}"  class="form-control" name="carnet" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="7" placeholder="Ingresar Carné" autofocus value="{{$grup->codigoG}}">
                </div>          
          </div>
          </div>

          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">     
            <div class="form-group"> 
              <label>Fecha de Registro</label>   
                <div class="input-group">  
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input type="date" disabled value="{{$grup->fecharegistro}}" class="form-control">
                </div>         
            </div>
         </div>
         
         <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
          <label>Carrera </label>
            <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <select disabled="" name="carr" id="carr" class="form-inline form-control">               
                    @foreach($carreras as $car)
                    @if($car->idcarrera==$grup->idcarrera)
                    <option value="{{$grup->idcarrera}}">{{$car->nombre}}</option>
                    @endif
                    @endforeach
                    </select>
            </div>      
          </div>
        </div>
                      
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
          <label>Tipo de Proceso </label>
            <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
              <select disabled="" name="idtipoT" id="idtipoT" class="form-inline form-control">               
                    @foreach($tiproceso as $tip)
                    @if($tip->idtipotema==$grup->idtipotema)
                    <option value="{{$grup->idtipotema}}">{{$tip->tema}}</option>
                    @endif
                    @endforeach
                    </select>
            </div>      
          </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
            <div class="form-group"> 
                <label>Tema </label>
                <div class="input-group">
                  <span class="input-group-addon" ><i class="fa fa-text-width" ></i></span>
                  <textarea name="tem" id="tem" disabled="" class="form-control rounded-0" rows="">{{$grup->tema}}</textarea>
                </div>          
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Integrantes </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                @foreach($mostraintegrante as $mint)
                @if($mint->idgrupo==$grup->idgrupo)
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
                @if($ase->idgrupo==$grup->idgrupo)
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

         @foreach($nAcuerdos as $na) 
                        @if($na->idgrupo==$grup->idgrupo && $na->idsolicitud==1 )
                        @if($na->nacuerdo!="")
         <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" > 
          <div class="form-group"> 
            <label>N° Acuerdo de Aprobación/Denegado </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    
                            <input id="" disabled type="text"  value="{{$na->nacuerdo}}"  class="form-control" name="">
                       
                    
                </div>          
          </div>
          </div>
          @endif
            @endif
            @endforeach 
        

        @if($grup->propuesta!="") 
        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
        <div class="form-group" >
            <label>Propuesta de Tema</label>             
                <div class="input-group" >    
                <a href="{{asset('storage/propuestas/'.$grup->propuesta)}}" target="_blank" >
                <i class="fa fa-file-pdf-o fa-4x fa-lg"></i></a>
                </div>       
            </div>
        </div>
        @endif

        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>
      </form>
    </div>
		</div>		
	</div>
	{{Form::Close()}}
</div>