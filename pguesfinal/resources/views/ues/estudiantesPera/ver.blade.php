
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-ver-{{$per->idpersona}}">
	{{Form::Open(array('action'=>array('EstudiantePeraController@show',$est->curriculum),'method'=>'PATCH'))}}
	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          

          <h4 class="modal-title">Información del Estudiante en P.E.R.A.</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
        <img src="{{ asset('storage/fotos/'.$per->foto_url) }}" class="img-circle"  alt="{{ $per->foto_url }}"  width="100" height="100">
      </div>


             <div hidden="" class="form-group"> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input disabled id="edit-id" type="text" class="form-control" name="id" value="{{$est->idestudiante}}" placeholder="Ingresar nombre">
            </div>      
      </div>


          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
            <label>Carné </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input id="carnet" disabled type="text"  value="{{$est->carnet}}"  class="form-control" name="carnet" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="7" placeholder="Ingresar Carné" autofocus>
                </div>          
            </div>
            </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group"> 
        <label>Nombres </label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input type="text" disabled value="{{$per->nombres}}" onKeyPress="return soloLetras(event)" class="form-control" id="nombres" name="nombres" placeholder="Ingresar Nombres" autofocus>
            </div>      
      </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
                <label>Apellidos </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input  type="text" disabled value="{{$per->apellidos}}"onKeyPress="return soloLetras(event)" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresar Apellidos" autofocus>
                </div>          
            </div>
</div>
            <!-- ENTRADA PARA TELEFONO -->

            <!-- ENTRADA PARA LA DIRRECCION -->
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

           <div class="form-group" > 
        
        <label>Sexo </label>          
             <div class="input-group">    
                      
        <span class="input-group-addon"><i class="fa fa-child"></i></span>
              <select disabled name="sexo" id="sexo" class="form-inline form-control">

              @if($per->sexo==0)
                
              <option value="0">Femenino</option>}
@endif
@if($per->sexo==1)
                    <option value="1">Masculino</option>
       @endif             
              </select>

            </div> 
                  </div>  
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
           <div class="form-group"> 
              <label>Carrera </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
                    <select disabled="" name="carrera" id="carrera" class="form-inline form-control">
                
                    @foreach($carreras as $car)
                    @if($car->idcarrera==$est->idcarrera)
<option value="{{$car->idcarrera}}">{{$car->nombre}}
                        
                    </option>
@endif
 @endforeach
                    </select>
                </div>          
            </div>
</div>
   <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group" > 
              <label>Correo electrónico</label> <span id="emailOK" style="color: #87c846;"></span>
                <div class="input-group" >     
                            
                <span class="input-group-addon"><i class="fa fa-at"></i></span><input disabled value="{{$per->correo}}" type="text"   class="form-control" id="correo" name="correo" autofocus>
                    
                </div> 
                 </div>  
                </div> 
                  <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
                  <div class="form-group"> 
                  <label>Fecha de Nacimiento </label>   
       <div class="input-group">  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input type="date" disabled value="{{$per->fechanac}}" class="form-control" id="fechanac" name="fechanac" autofocus>
                </div>         
            </div>
              </div>


                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

<div class="form-group" >   
                    <label>Dirección</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input type="text" disabled value="{{$per->direccion}}" class="form-control" id="direccion" name="direccion"  autofocus>
                </div>         
            </div>
            </div>
             <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group" >   
                    <label>DUI</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                    <input disabled value="{{$per->dui}}" type="text" data-inputmask="'mask':'99999999-9'"  data-mask class="form-control" id="dui" name="dui" autofocus>
                </div>         
            </div>
            </div>
        
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                    <div class="form-group" >
                         <label>Teléfono </label>
             <div class="input-group" >     
                        
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                   <input type="text" disabled value="{{$per->telefono}}"   class="form-control" id="telefono" name="telefono" data-inputmask="'mask':'9999-9999'" data-mask autofocus>
                </div>       
            </div>
</div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

 <div class="form-group" >  
                    <label>Año de Egreso</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input disabled value="{{ \Carbon\Carbon::parse($est->anioegreso )->format('d-m-Y') }}" type="mouth" class="form-control" id="anioegreso" name="anioegreso" onKeyPress="return soloNumeros(event)" maxlength="4"  autofocus>
                </div>         
            </div>
            </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

          <div class="form-group" > 
                              <label>Programa de Refuerzo Académico</label>             

              <div class="input-group" >     
                <span class="input-group-addon"><i class="  fa fa-info"></i></span>
                    <select disabled name="pera" id="pera" class="form-inline form-control">
 @if($est->pera==0)
                
              <option value="0">No</option>}
@endif
@if($est->pera==1)
                    <option value="1">Si</option>
       @endif     
                   
                    </select>

                </div>
                  </div>  
                 </div>


                   <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                       <div class="form-group" >
                                    <label>Servicio Social Estudiantil</label>             

             <div class="input-group" >    
                
                    <span class="input-group-addon"><i class="  fa fa-info"></i></span><select disabled name="horassociales" id="horassociales" class="form-inline form-control">
 @if($est->horassoc==0)
                
              <option value="0">No</option>}
@endif
@if($est->horassoc==1)
                    <option value="1">Si</option>
       @endif     
                    </select>

                </div>       
            </div>
</div>
@if($est->curriculum!="")
 <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                       <div class="form-group" >
                                    <label>Curriculum Vitae</label>             

             <div class="input-group" >    

<a href="{{asset('storage/curriculums/'.$est->curriculum)}}" target="_blank" >
                   <i  class="fa fa-file-pdf-o fa-4x fa-lg"></i></a>

</div>       
            </div>
</div>
@endif

@if($est->partida!="")
 <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                       <div class="form-group" >
                                    <label>Partida de Nacimiento</label>             

             <div class="input-group" >    

<a href="{{asset('storage/partidas/'.$est->partida)}}" target="_blank" >
                      <i class="fa fa-file-pdf-o fa-4x fa-lg"></i></a>

</div>       
            </div>
</div>
@endif

       </div>

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