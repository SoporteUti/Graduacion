
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-edit-<?php echo e($ttem->idtipotema); ?>">
	<?php echo e(Form::Open(array('action'=>array('TipotemaController@edit'),'route'=>['ues.tipoTemas.update',$ttem->idtipotema],'method'=>'PATCH'))); ?>



	   <?php echo e(Form::token()); ?>

	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

         

          <h4 class="modal-title">Editar el Tipo de Procesos de Graduación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

           

          <div class="form-group"> 
             <label>Tipos de Procesos de Graduación</label> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input autocomplete="off" id="tema" type="text" class="form-control" name="tema" value="<?php echo e($ttem->tema); ?>" placeholder="Modificar el Tipo de Proceso de Graduación">
            </div>      
      </div>

  

     <div hidden="" class="form-group"> 
        <label>Carrera</label>
        <div class="input-group">         
            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
              <select name="idcarrera" id="idcarrera" class="form-inline form-control">
                <?php foreach($carrera as $car): ?>
                <?php if($car->idcarrera==$ttem->idcarrera): ?>

              <option value="<?php echo e($ttem->idcarrera); ?>"><?php echo e($car->nombre); ?>              
              </option>
            <?php endif; ?>
            <?php endforeach; ?>

              </select>
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
	<?php echo e(Form::Close()); ?>




</div>