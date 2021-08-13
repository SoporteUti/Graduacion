<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-ver-<?php echo e($grup->idgrupo); ?>">
	<?php echo e(Form::Open(array('action'=>array('GrupoController@edit',$grup->idgrupo),'method'=>'PATCH', 'files' =>'true'))); ?>       
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
              <input disabled id="edit-id" type="text" class="form-control" name="id" value="<?php echo e($grup->idgrupo); ?>" placeholder="Ingresar nombre">
            </div>      
        </div>

        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
          <div class="form-group"> 
            <label>Código </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input id="carnet" disabled type="text"  value="<?php echo e($grup->codigoG); ?>"  class="form-control" name="carnet" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="7" placeholder="Ingresar Carné" autofocus value="<?php echo e($grup->codigoG); ?>">
                </div>          
          </div>
          </div>

          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">     
            <div class="form-group"> 
              <label>Fecha de Registro</label>   
                <div class="input-group">  
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input type="date" disabled value="<?php echo e($grup->fecharegistro); ?>" class="form-control">
                </div>         
            </div>
         </div>
         
         <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
          <label>Carrera </label>
            <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <select disabled="" name="carr" id="carr" class="form-inline form-control">               
                    <?php foreach($carreras as $car): ?>
                    <?php if($car->idcarrera==$grup->idcarrera): ?>
                    <option value="<?php echo e($grup->idcarrera); ?>"><?php echo e($car->nombre); ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
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
                    <?php foreach($tiproceso as $tip): ?>
                    <?php if($tip->idtipotema==$grup->idtipotema): ?>
                    <option value="<?php echo e($grup->idtipotema); ?>"><?php echo e($tip->tema); ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                    </select>
            </div>      
          </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
            <div class="form-group"> 
                <label>Tema </label>
                <div class="input-group">
                  <span class="input-group-addon" ><i class="fa fa-text-width" ></i></span>
                  <textarea name="tem" id="tem" disabled="" class="form-control rounded-0" rows=""><?php echo e($grup->tema); ?></textarea>
                </div>          
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Integrantes </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                <?php foreach($mostraintegrante as $mint): ?>
                <?php if($mint->idgrupo==$grup->idgrupo): ?>
                <?php foreach($estudiantes as $est): ?>
                <?php if($mint->idestudiante==$est->idestudiante): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>
                <input disabled=""  type="text" class="form-control"    value="<?php echo e($est->carnet." ".$per->nombres." ".$per->apellidos); ?>">
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
                </div>          
            </div>
        </div>  

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Asesor/es </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <?php foreach($asesores as $ase): ?>
                <?php if($ase->idgrupo==$grup->idgrupo): ?>
                         <?php foreach($docentes as $doc): ?>
                                 <?php if($ase->iddocente==$doc->iddocente): ?>
                     <?php foreach($personas as $per): ?>
                <?php if($per->idpersona==$doc->idpersona): ?>
                <?php foreach($tipoasesor as $tias): ?>
                <?php if($tias->idtipoasesor==$ase->idtipoasesor): ?>
                <input disabled type="text" class="form-control"   value="<?php echo e($doc->titulo." ".$per->nombres." ".$per->apellidos." - ".$tias->tipoasesor); ?>">
                <?php endif; ?>
                <?php endforeach; ?> 
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
                </div>          
            </div>
        </div> 

        <?php if($grup->propuesta!=""): ?> 
        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
        <div class="form-group" >
            <label>Propuesta de Tema</label>             
                <div class="input-group" >    
                <a href="<?php echo e(asset('storage/propuestas/'.$grup->propuesta)); ?>" target="_blank" >
                <i class="fa fa-file-pdf-o fa-4x fa-lg"></i></a>
                </div>       
            </div>
        </div>
        <?php endif; ?>

        </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>Cerrar</button>
      </div>
      </form>
    </div>
		</div>		
	</div>
	<?php echo e(Form::Close()); ?>

</div>