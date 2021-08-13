 
 <script src="{{asset('js/jquery.min.js')}}"></script>
        
        <script type="text/javascript" language="javascript" src="{{asset('js/jquery.dataTables.min.js')}}" > </script>
       
        <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}" > </script>
        
        <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}" > </script>
        
        <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.responsive.min.js')}}" > </script>

<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-edit-{{$per->idpersona}}">
	{{Form::Open(array('action'=>array('EstudianteController@edit'),'route'=>['ues.estudiantes.update',$per->idpersona], 'method'=>'PATCH', 'files' =>'true'))}}


	 
	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          

          <h4 class="modal-title">Editar Estudiante</h4>

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
                     @foreach($estudiante as $est)
              @if($est->idpersona==$per->idpersona)
               <input id="idestudiante" type="text" class="form-control" name="idestudiante" value="{{$est->idestudiante}}" placeholder="Ingresar nombre">
               @endif
               @endforeach  
      </div>
            </div>  

            
             <div hidden="" class="form-group"> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                     @foreach($user as $us)
              @if($us->idpersona==$per->idpersona)
               <input id="idusuario" type="text" class="form-control" name="idusuario" value="{{$us->id}}" placeholder="Ingresar nombre">
               @endif
               @endforeach  
      </div>
            </div>   

          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
            <label>Carné (*)</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                      @foreach($estudiante as $est)
                @if($est->idpersona==$per->idpersona)
                    <input id="carnet" readonly="readonly" type="text"  value="{{$est->carnet}}"  class="form-control" name="carnet" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="7" placeholder="Ingresar Carné" autofocus>
                    @endif
                    @endforeach
                </div>          
            </div>
            </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group"> 
        <label>Nombres (*)</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input type="text"  value="{{$per->nombres}}" onKeyPress="return soloLetras(event)" class="form-control" id="nombres" name="nombres" placeholder="Ingresar Nombres" autofocus>
            </div>      
      </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
                <label>Apellidos (*) </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input  type="text"  value="{{$per->apellidos}}"onKeyPress="return soloLetras(event)" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresar Apellidos" autofocus>
                </div>          
            </div>
</div>
            <!-- ENTRADA PARA TELEFONO -->

            <!-- ENTRADA PARA LA DIRRECCION -->
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

           <div class="form-group" > 
        
        <label>Sexo (*) </label>          
             <div class="input-group">    
                      
        <span class="input-group-addon"><i class="fa fa-child"></i></span>
              <select  name="sexo" id="sexo" class="form-inline form-control">

              @if($per->sexo==0)
                
              <option value="0">Femenino</option>}
@endif
@if($per->sexo==1)
                    <option value="1">Masculino</option>
       @endif   
          <option value="0">Femenino</option> 
             <option value="1">Masculino</option>         
              </select>

            </div> 
                  </div>  
                </div>




                
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
           <div class="form-group"> 
              <label>Carrera (*) </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
                    <select   name="carrera" id="carrera" class="form-inline form-control">
                      @foreach($estudiante as $est)
                @if($est->idpersona==$per->idpersona)
                    @foreach($carreras as $car)
                    @if($car->idcarrera==$est->idcarrera )
<option value="{{$car->idcarrera}}">{{$car->nombre}}
                        
                    </option>
                    @endif
 @endforeach
@endif
 @endforeach

                    </select>
                </div>          
            </div>
</div>


 <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
                <label>Ciclo (*)</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                      <select name="ciclo" id="ciclo" class="form-inline form-control">

                       @foreach($estudiante as $est)
                    @if($est->idpersona==$per->idpersona)
                   <?php
//$rest = substr("abcdef", -1);    // devuelve "f"
//$rest = substr("abcdef", -2);    // devuelve "ef"
$rest = substr($est->ciclo, 0, 1); // devuelve "d"
$rest1 = substr($est->ciclo, 1, 1); 

if($rest1!='-') $ciclo=$rest.$rest1;
if($rest1=='-') $ciclo=$rest;
?>
                 

                        
                 
             
@endif
 @endforeach
               
                
                   
<option value="{{$ciclo}}">{{$ciclo}}
                        
                    </option>
                                      
<option value="I">I
                        
                    </option>
                    <option value="II">II
                        
                    </option>
                        
                   


                    </select>
                </div>          
            </div>
</div>


   <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
                <label>Año (*)</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
<div class="form-group">
     <?php
$conti = date('Y');
?>

<select name="anio" id="anio" class="form-inline form-control">
        @foreach($estudiante as $est)
                    @if($est->idpersona==$per->idpersona)
                   <?php
//$rest = substr("abcdef", -1);    // devuelve "f"
//$rest = substr("abcdef", -2);    // devuelve "ef"
$rest = substr($est->ciclo, -4); // devuelve "d"


 $anio=$rest;
?>
                 <option value="{{$anio}}">{{$anio}}
                        
                    </option>

                      
                 
             
@endif
 @endforeach
 <?php while ($conti >= 1984) { ?>
  <option value="<?php echo($conti); ?>"><?php echo($conti); ?></option>
<?php $conti = ($conti-1); } ?>

  </select>
</div>
                </div>          
            </div>
</div>


<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group" > 
              <label>Correo electrónico (*)</label> <span id="emailOK" style="color: #87c846;"></span>
                <div class="input-group" >     
                            
                <span class="input-group-addon"><i class="fa fa-at"></i></span><input  value="{{$per->correo}}" type="text"   class="form-control" id="correo" name="correo" autofocus>
                    
                </div> 
                 </div>  
                </div> 
                  <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
                  <div class="form-group"> 
                  <label>Fecha de Nacimiento </label>   
       <div class="input-group">  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input type="date"  value="{{$per->fechanac}}" class="form-control" id="fechanac" name="fechanac" autofocus>
                </div>         
            </div>
              </div>

                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

<div class="form-group" >   
                    <label>Dirección</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input type="text"  value="{{$per->direccion}}" class="form-control" id="direccion" name="direccion"  autofocus>
                </div>         
            </div>
            </div>
             <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group" >   
                    <label>DUI</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                    <input  value="{{$per->dui}}" type="text" data-inputmask="'mask':'99999999-9'"  data-mask class="form-control" id="dui" name="dui" autofocus>
                </div>         
            </div>
            </div>
         
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                    <div class="form-group" >
                         <label>Teléfono </label>
             <div class="input-group" >     
                        
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                   <input type="text"  value="{{$per->telefono}}"   class="form-control" id="telefono" name="telefono" data-inputmask="'mask':'9999-9999'" data-mask autofocus>
                </div>       
            </div>
</div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

 <div class="form-group" >  
                    <label>Fecha de Egreso</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                         @foreach($estudiante as $est)
                @if($est->idpersona==$per->idpersona)
                    <input  value="{{$est->anioegreso}}" type="date" class="form-control" id="anioegreso" name="anioegreso"  autofocus>
                    @endif
 @endforeach  
                </div>         
            </div>
            </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

          <div class="form-group" > 
                              <label>Programa de Refuerzo Académico</label>             

              <div class="input-group" >  

                <span class="input-group-addon"><i class="  fa fa-info"></i></span>
                    <select  name="pera" id="pera" class="form-inline form-control">
                       @foreach($estudiante as $est)
                @if($est->idpersona==$per->idpersona)
 @if($est->pera==0)
                
              <option value="0">No</option>}
@endif
@if($est->pera==1)
                    <option value="1">Si</option>
       @endif    
         @endif
 @endforeach 
                <option value="0">No</option>
                <option value="1">Si</option>  

                    </select>

                </div>
                  </div>  
                 </div>


                   <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                       <div class="form-group" >
                                    <label>Servicio Social Estudiantil</label>             

             <div class="input-group" >    
                
                    <span class="input-group-addon"><i class="  fa fa-info"></i></span><select  name="horassociales" id="horassociales" class="form-inline form-control">
                          @foreach($estudiante as $est)
                @if($est->idpersona==$per->idpersona)
 @if($est->horassoc==0)
                
              <option value="0">No</option>}
@endif
@if($est->horassoc==1)
                    <option value="1">Si</option>
       @endif  
       @endif
       @endforeach 
       <option value="0">No</option>
       <option value="1">Si</option>  
                    </select>

                </div>       
            </div>
</div>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
<div class="form-group" >   
                    <label>Carta de Egreso</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                    <input type="file" accept="application/pdf" name="carta" class="form-control">
                </div>         
            </div>
            </div>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
<div class="form-group" >   
                    <label>Curriculum Vitae</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                    <input type="file" accept="application/pdf" name="curriculum" class="form-control">
                </div>         
            </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group" >   
                    <label>Partida de Nacimiento</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                    <input type="file" accept="application/pdf" name="partida" class="form-control">
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
  <script>
    function soloNumeros(e){
    var key = window.Event ? e.which : e.keyCode
    return (key >= 48 && key <= 57)
}
</script>
<script>
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = "8-37-39-46";

        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }
</script>

<script>
document.getElementById('correo').addEventListener('input', function() {
    campo = event.target;
    valido = document.getElementById('emailOK');
        
    emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo.value)) {
      valido.innerText = "válido";
    } else {
      valido.innerText = "incorrecto";
    }
});
</script>
	{{Form::Close()}}



</div>
