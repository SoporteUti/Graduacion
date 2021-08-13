
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-ver-<?php echo e($per->idpersona); ?>">
  <?php echo e(Form::Open(array('action'=>array('EstudianteController@show',$est->curriculum),'method'=>'PATCH'))); ?>

  
          
  <div class="modal-dialog">
    <div class="modal-content">
       <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

        
          <h4 class="modal-title">Información del Estudiante</h4>

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
        <img src="<?php echo e(asset('storage/fotos/'.$per->foto_url)); ?>" class="img-circle"  alt="<?php echo e($per->foto_url); ?>"  width="100" height="100">
      </div>
        

             <div hidden="" class="form-group"> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input disabled id="edit-id" type="text" class="form-control" name="id" value="<?php echo e($est->idestudiante); ?>" placeholder="Ingresar nombre">
            </div>      
      </div>


          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
            <label>Carné </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <?php foreach($estudiante as $est): ?>
                    <?php if($est->idpersona==$per->idpersona): ?>         
            <input id="carnet" disabled type="text"  value="<?php echo e($est->carnet); ?>"  class="form-control" name="carnet" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="7" placeholder="Ingresar Carné" autofocus>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    
                </div>          
            </div>
            </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group"> 
        <label>Nombres </label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input type="text" disabled value="<?php echo e($per->nombres); ?>" onKeyPress="return soloLetras(event)" class="form-control" id="nombres" name="nombres" placeholder="Ingresar Nombres" autofocus>
            </div>      
      </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
                <label>Apellidos </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input  type="text" disabled value="<?php echo e($per->apellidos); ?>"onKeyPress="return soloLetras(event)" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresar Apellidos" autofocus>
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

              <?php if($per->sexo==0): ?>
                
              <option value="0">Femenino</option>}
<?php endif; ?>
<?php if($per->sexo==1): ?>
                    <option value="1">Masculino</option>
       <?php endif; ?>             
              </select>

            </div> 
                  </div>  
                </div>
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
           <div class="form-group"> 
              <label>Carrera </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                    <select disabled="" name="carrera" id="carrera" class="form-inline form-control">
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
                    </select>
                </div>          
            </div>
</div>

 <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group" > 
              <label>Correo electrónico</label> <span id="emailOK" style="color: #87c846;"></span>
                <div class="input-group" >     
                            
                <span class="input-group-addon"><i class="fa fa-at"></i></span><input disabled value="<?php echo e($per->correo); ?>" type="text"   class="form-control" id="correo" name="correo" autofocus>
                    
                </div> 
                 </div>  
                </div> 
                  <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
                  <div class="form-group"> 
                  <label>Fecha de Nacimiento </label>   
       <div class="input-group">  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input type="date" disabled value="<?php echo e($per->fechanac); ?>" class="form-control" id="fechanac" name="fechanac" autofocus>
                </div>         
            </div>
              </div>

                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

<div class="form-group" >   
                    <label>Dirección</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input type="text" disabled value="<?php echo e($per->direccion); ?>" class="form-control" id="direccion" name="direccion"  autofocus>
                </div>         
            </div>
            </div>
             <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group" >   
                    <label>DUI</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                    <input disabled value="<?php echo e($per->dui); ?>" type="text" data-inputmask="'mask':'99999999-9'"  data-mask class="form-control" id="dui" name="dui" autofocus>
                </div>         
            </div>
            </div>
        
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                    <div class="form-group" >
                         <label>Teléfono </label>
             <div class="input-group" >     
                        
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                   <input type="text" disabled value="<?php echo e($per->telefono); ?>"   class="form-control" id="telefono" name="telefono" data-inputmask="'mask':'9999-9999'" data-mask autofocus>
                </div>       
            </div>
</div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

 <div class="form-group" >  
                    <label>Año de Egreso</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <?php foreach($estudiante as $est): ?>
                    <?php if($est->idpersona==$per->idpersona): ?> 
                    <input disabled value="<?php echo e(\Carbon\Carbon::parse($est->anioegreso )->format('d-m-Y')); ?>" type="mouth" class="form-control" id="anioegreso" name="anioegreso" onKeyPress="return soloNumeros(event)" maxlength="4"  autofocus>
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
                    <select disabled name="pera" id="pera" class="form-inline form-control">
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
                    </select>

                </div>
                  </div>  
                 </div>


                   <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                       <div class="form-group" >
                                    <label>Servicio Social Estudiantil</label>             

             <div class="input-group" >    
                
                    <span class="input-group-addon"><i class="  fa fa-info"></i></span><select disabled name="horassociales" id="horassociales" class="form-inline form-control">
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
                    </select>

                </div>       
            </div>
</div>

<?php foreach($estudiante as $est): ?>
    <?php if($est->idpersona==$per->idpersona): ?>                 

<?php if($est->carta!=""): ?>
 <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                       <div class="form-group" >
                                    <label>Carta de Egreso</label>             

             <div class="input-group" >    

<a href="<?php echo e(asset('storage/cartas_egreso/'.$est->carta)); ?>" target="_blank" >
                      <i class="fa fa-file-pdf-o fa-4x fa-lg"></i></a>

</div>       
            </div>
</div>
<?php endif; ?>

<?php endif; ?>
<?php endforeach; ?>  
<?php foreach($estudiante as $est): ?>
                    <?php if($est->idpersona==$per->idpersona): ?> 
<?php if($est->curriculum!=""): ?>
 <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                       <div class="form-group" >
                                    <label>Curriculum Vitae</label>             

             <div class="input-group" >    

<a href="<?php echo e(asset('storage/curriculums/'.$est->curriculum)); ?>" target="_blank" >
                   <i  class="fa fa-file-pdf-o fa-4x fa-lg"></i></a>

</div>       
            </div>
</div>
<?php endif; ?>
    <?php endif; ?>
    <?php endforeach; ?>  
     
     <?php foreach($estudiante as $est): ?>
    <?php if($est->idpersona==$per->idpersona): ?>                 

<?php if($est->partida!=""): ?>
 <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                       <div class="form-group" >
                                    <label>Partida de Nacimiento</label>             

             <div class="input-group" >    

<a href="<?php echo e(asset('storage/partidas/'.$est->partida)); ?>" target="_blank" >
                      <i class="fa fa-file-pdf-o fa-4x fa-lg"></i></a>

</div>       
            </div>
</div>
<?php endif; ?>

<?php endif; ?>
<?php endforeach; ?>  
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
  <?php echo e(Form::Close()); ?>




</div>