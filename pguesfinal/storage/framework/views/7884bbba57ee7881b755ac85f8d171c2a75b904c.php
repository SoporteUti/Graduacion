 
 <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
        
        <script type="text/javascript" language="javascript" src="<?php echo e(asset('js/jquery.dataTables.min.js')); ?>" > </script>
       
        <script type="text/javascript" language="javascript" src="<?php echo e(asset('js/dataTables.bootstrap.min.js')); ?>" > </script>
        
        <script type="text/javascript" language="javascript" src="<?php echo e(asset('js/dataTables.bootstrap.min.js')); ?>" > </script>
        
        <script type="text/javascript" language="javascript" src="<?php echo e(asset('js/dataTables.responsive.min.js')); ?>" > </script>

<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-edit-<?php echo e($per->idpersona); ?>">
	<?php echo e(Form::Open(array('action'=>array('EstudianteController@edit'),'route'=>['ues.estudiantes.update',$per->idpersona], 'method'=>'PATCH', 'files' =>'true'))); ?>



	 
	
          
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
                              
                            <img src="<?php echo e(asset('storage/fotos/'.$per->foto_url)); ?>" class="img-circle"  alt="<?php echo e($per->foto_url); ?>"  width="100" height="100">
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
              <input id="edit-id" type="text" class="form-control" name="id" value="<?php echo e($per->idpersona); ?>" placeholder="Ingresar nombre">
            
            </div>    

            
      </div>
 <div hidden="" class="form-group"> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                     <?php foreach($estudiante as $est): ?>
              <?php if($est->idpersona==$per->idpersona): ?>
               <input id="idestudiante" type="text" class="form-control" name="idestudiante" value="<?php echo e($est->idestudiante); ?>" placeholder="Ingresar nombre">
               <?php endif; ?>
               <?php endforeach; ?>  
      </div>
            </div>  

            
             <div hidden="" class="form-group"> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                     <?php foreach($user as $us): ?>
              <?php if($us->idpersona==$per->idpersona): ?>
               <input id="idusuario" type="text" class="form-control" name="idusuario" value="<?php echo e($us->id); ?>" placeholder="Ingresar nombre">
               <?php endif; ?>
               <?php endforeach; ?>  
      </div>
            </div>   

          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
            <label>Carné (*)</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                      <?php foreach($estudiante as $est): ?>
                <?php if($est->idpersona==$per->idpersona): ?>
                    <input id="carnet" readonly="readonly" type="text"  value="<?php echo e($est->carnet); ?>"  class="form-control" name="carnet" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="7" placeholder="Ingresar Carné" autofocus>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>          
            </div>
            </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group"> 
        <label>Nombres (*)</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input type="text"  value="<?php echo e($per->nombres); ?>" onKeyPress="return soloLetras(event)" class="form-control" id="nombres" name="nombres" placeholder="Ingresar Nombres" autofocus>
            </div>      
      </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
                <label>Apellidos (*) </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input  type="text"  value="<?php echo e($per->apellidos); ?>"onKeyPress="return soloLetras(event)" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresar Apellidos" autofocus>
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

              <?php if($per->sexo==0): ?>
                
              <option value="0">Femenino</option>}
<?php endif; ?>
<?php if($per->sexo==1): ?>
                    <option value="1">Masculino</option>
       <?php endif; ?>   
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
                    <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                    <select  name="carrera" id="carrera" class="form-inline form-control">
                      <?php foreach($estudiante as $est): ?>
                <?php if($est->idpersona==$per->idpersona): ?>
                    <?php foreach($carreras as $car): ?>
                    <?php if($car->idcarrera==$est->idcarrera): ?>
<option value="<?php echo e($car->idcarrera); ?>"><?php echo e($car->nombre); ?>

                        
                    </option>
                    <?php endif; ?>
 <?php endforeach; ?>
<?php endif; ?>
 <?php endforeach; ?>

 <?php foreach($carreras as $car): ?>
                    <?php if($car->condicion==true): ?>
<option value="<?php echo e($car->idcarrera); ?>"><?php echo e($car->nombre); ?>

                        
                    </option>
<?php endif; ?>
 <?php endforeach; ?>
                    </select>
                </div>          
            </div>
</div>
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group" > 
              <label>Correo electrónico (*)</label> <span id="emailOK" style="color: #87c846;"></span>
                <div class="input-group" >     
                            
                <span class="input-group-addon"><i class="fa fa-at"></i></span><input  value="<?php echo e($per->correo); ?>" type="text"   class="form-control" id="correo" name="correo" autofocus>
                    
                </div> 
                 </div>  
                </div> 
                  <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
                  <div class="form-group"> 
                  <label>Fecha de Nacimiento </label>   
       <div class="input-group">  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input type="date"  value="<?php echo e($per->fechanac); ?>" class="form-control" id="fechanac" name="fechanac" autofocus>
                </div>         
            </div>
              </div>

                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

<div class="form-group" >   
                    <label>Dirección</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input type="text"  value="<?php echo e($per->direccion); ?>" class="form-control" id="direccion" name="direccion"  autofocus>
                </div>         
            </div>
            </div>
             <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group" >   
                    <label>DUI</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                    <input  value="<?php echo e($per->dui); ?>" type="text" data-inputmask="'mask':'99999999-9'"  data-mask class="form-control" id="dui" name="dui" autofocus>
                </div>         
            </div>
            </div>
         
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                    <div class="form-group" >
                         <label>Teléfono </label>
             <div class="input-group" >     
                        
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                   <input type="text"  value="<?php echo e($per->telefono); ?>"   class="form-control" id="telefono" name="telefono" data-inputmask="'mask':'9999-9999'" data-mask autofocus>
                </div>       
            </div>
</div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

 <div class="form-group" >  
                    <label>Fecha de Egreso</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                         <?php foreach($estudiante as $est): ?>
                <?php if($est->idpersona==$per->idpersona): ?>
                    <input  value="<?php echo e($est->anioegreso); ?>" type="date" class="form-control" id="anioegreso" name="anioegreso"  autofocus>
                    <?php endif; ?>
 <?php endforeach; ?>  
                </div>         
            </div>
            </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

          <div class="form-group" > 
                              <label>Programa de Refuerzo Académico</label>             

              <div class="input-group" >  

                <span class="input-group-addon"><i class="  fa fa-info"></i></span>
                    <select  name="pera" id="pera" class="form-inline form-control">
                       <?php foreach($estudiante as $est): ?>
                <?php if($est->idpersona==$per->idpersona): ?>
 <?php if($est->pera==0): ?>
                
              <option value="0">No</option>}
<?php endif; ?>
<?php if($est->pera==1): ?>
                    <option value="1">Si</option>
       <?php endif; ?>    
         <?php endif; ?>
 <?php endforeach; ?> 
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
                          <?php foreach($estudiante as $est): ?>
                <?php if($est->idpersona==$per->idpersona): ?>
 <?php if($est->horassoc==0): ?>
                
              <option value="0">No</option>}
<?php endif; ?>
<?php if($est->horassoc==1): ?>
                    <option value="1">Si</option>
       <?php endif; ?>  
       <?php endif; ?>
       <?php endforeach; ?> 
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
	<?php echo e(Form::Close()); ?>




</div>
