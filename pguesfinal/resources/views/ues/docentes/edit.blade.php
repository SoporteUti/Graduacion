
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-edit-{{$per->idpersona}}">
	{{Form::Open(array('action'=>array('docentesController@edit'),'route'=>['ues.docentes.update',$per->idpersona],'method'=>'PATCH','files' =>'true'))}}


	 
	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          

          <h4 class="modal-title">Editar Docente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


                          <center>
                          <div class="form-group">

                            <label class=" control-label">Imagen Actual</label>
                            <div class="">
                              
                            <img src="{{ asset('storage/fotos/'.$per->foto_url) }}" class="img-circle"  alt="{{ $per->foto_url }}"  width="100" height="100">
                            </div>
                          </div>
                          </center>

                  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
             <div class="form-group"> 
            <label>Foto</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                     <input type="file" name="foto" accept="image/x-png,image/gif,image/jpeg" placeholder="Foto">
                </div>          
            </div>
            </div>





 <div hidden="" class="form-group"> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input id="edit-id" type="text" class="form-control" name="id" value="{{$per->idpersona}}" placeholder="Ingresar nombre">
            
            </div>                
      </div>


       <div hidden="" class="form-group"> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                     {{-- @foreach($docentes as $doc)
              @if($doc->idpersona==$per->idpersona) --}}
               <input id="iddocente" type="text" class="form-control" name="iddocente" value="{{$doc->iddocente}}" placeholder="Ingresar nombre">
              {{--  @endif
               @endforeach --}}
               '
      </div>
            </div>  




             <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
                <label>Nombres</label>
                <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
        
              <input autocomplete="off" id="nombres" type="text" class="form-control" name="nombres" value="{{$per->nombres}}" placeholder="Modificar nombres">
            
            </div>      
      </div>
      </div>

      <div hidden="" class="form-group">
            
    <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input id="-id" type="text" class="form-control" name="id" value="{{$doc->iddocente}}" placeholder="iddocente">
            </div>      
      </div>


         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
          <div class="form-group"> 
             <label>Apellidos</label> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input autocomplete="off" id="apellidos" type="text" class="form-control" name="apellidos" value="{{$per->apellidos}}" placeholder="Modificar apellidos">
            </div>      
      </div>
    </div>

     <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

           <div class="form-group" > 
        
        <label>Sexo (*) </label>          
             <div class="input-group">    
                      
        <span class="input-group-addon"><i class="fa fa-child"></i></span>
              <select  name="sexo" id="sexo" class="form-inline form-control">
                @foreach($docentes as $doc)
                @if($doc->idpersona==$per->idpersona)
              @if($per->sexo==0)
                
              <option value="0">Femenino</option>}
@endif
@if($per->sexo==1)
                    <option value="1">Masculino</option>
       @endif   
          <option value="0">Femenino</option> 
             <option value="1">Masculino</option>         
              </select>
              @endif
              @endforeach
            </div> 
                  </div>  
                </div>


  {{--     <div class="form-group"> 
      <label>Categoría</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
            @foreach($docentes as $doc)
              @if($doc->idpersona==$per->idpersona)
          @foreach($categorias as $cat)
                @if($cat->idcategoria==$doc->idcategoria)

            <input type="text" id="categoria" class="form-control" name="categoria" value="{{$cat->nombrecat}}" placeholder="">
            @endif
            @endforeach
            @endif
            @endforeach
             
              
            </div>      
      </div> --}}

<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
           <div class="form-group"> 
              <label>Categoría</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                    <select  name="categoria" id="categoria" class="form-inline form-control">
                      @foreach($docentes as $doc)
                @if($doc->idpersona==$per->idpersona)
                    @foreach($categorias as $cat)
                    @if($cat->idcategoria==$doc->idcategoria)
<option value="{{$cat->idcategoria}}">{{$cat->nombrecat}}
                        
                    </option>
                    @endif
 @endforeach
@endif
 @endforeach

 @foreach($categorias as $cat)
                    @if($cat->condicion==true)
<option value="{{$cat->idcategoria}}">{{$cat->nombrecat}}
                        
                    </option>
@endif
 @endforeach
                    </select>
                </div>          
            </div>

</div>






      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group" >   
                    <label>DUI</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                    <input value="{{$per->dui}}" type="text" data-inputmask="'mask':'99999999-9'"  data-mask placeholder=" " class="form-control" id="dui" name="dui" autofocus>
                </div>         
            </div>
            </div>


<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
      <div class="form-group"> 
        <label>Teléfono</label> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" data-inputmask="'mask':'9999-9999'" data-mask id="telefono" class="form-control" name="telefono" value="{{$per->telefono}}" placeholder="Editar teléfono">
            </div>      
      </div>
    </div>

      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
                  <div class="form-group"> 
                  <label>Fecha de Nacimiento </label>   
       <div class="input-group">  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input value="{{$per->fechanac}}" type="date" class="form-control" id="fechanac" name="fechanac" autofocus>
                </div>         
            </div>
              </div>

<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
          <div class="form-group"> 
        <label>Título</label> 
          <div class="input-group">         
            <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
              @foreach($docentes as $doc)
              @if($doc->idpersona==$per->idpersona)
              <input type="text" id="titulo" class="form-control" name="titulo" value="{{$doc->titulo}}" placeholder="Editar titulo">
              @endif
              @endforeach
          </div>      
      </div>
    </div>


<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
      <div class="form-group"> 
        <label>Correo</label> 
          <div class="input-group">         
            <span class="input-group-addon"><i class="fa fa-at"></i></span>
              <input type="text" id="correo" class="form-control" name="correo" value="{{$per->correo}}" placeholder="Editar correo">
          </div>      
      </div>
</div>
      
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
       <div class="form-group" >   
                    <label>Dirección</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input type="text" autocomplete="off" class="form-control" id="direccion" name="direccion" placeholder=" " value="{{$per->direccion}}" autofocus>
                </div>         
            </div>
          </div>

<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
      <div class="form-group"> 
        <label>Lugar de trabajo</label> 
          <div class="input-group">         
            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
            @foreach($docentes as $doc)
              @if($doc->idpersona==$per->idpersona)
              <input type="text" id="lugar" class="form-control" name="lugar" value="{{$doc->lugar}}" placeholder="Editar lugar de trabajo">

              @endif
              @endforeach
          </div>      
      </div>
    </div>


       </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>

        </div>

       

      </form>

    </div>
		</div>
		
	</div>
	{{Form::Close()}}



</div>