<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-edit-<?php echo e($grup->idgrupo); ?>">
	<?php echo e(Form::Open(array('action'=>array('GrupoController@edit'),'route'=>['ues.grupos.update',$grup->idgrupo], 'method'=>'PATCH','files' =>'true'))); ?>


  
<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL EDITAR
        ======================================-->
        <div class="modal-header" style="background:#00a65a; color:white">
        <h4 class="modal-title">Editar Grupo</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
      <div class="modal-body">
        <div class="box-body">
          
          <div class="col-lg-6 col-md-6col-xs-12 col-sm-6" > 
            <div class="form-group"> 
              <label>Código </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input id="codigoG"  onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"  value="<?php echo e($grup->codigoG); ?>"  class="form-control" name="codigoG"  maxlength="11" autofocus>
                </div>          
            </div>
          </div>

          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-16" > 
              <div class="form-group"> 
                  <label>Fecha de Registro</label>   
                  <div class="input-group">  
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input  id="fecharegistro" name="fecharegistro" type="date" value="<?php echo e($grup->fecharegistro); ?>" class="form-control"   step="1" value="<?php echo date("Y-m-d");?>">
                </div>         
              </div>
          </div>

          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Tipo de Proceso</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
                  <select name="idtipoT" id="idtipoT" class="form-inline form-control">
                            <?php foreach($tiproceso as $tipo): ?>
                            <?php if($tipo->idtipotema==$grup->idtipotema): ?>
                            <option value="<?php echo e($tipo->idtipotema); ?>" ><?php echo e($tipo->tema); ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                            <?php foreach($tiproceso as $tipo): ?>
                            <?php if($tipo->condicion==1 && $tipo->idcarrera==Auth::user()->idcarrera): ?>
                            <option value="<?php echo e($tipo->idtipotema); ?>" ><?php echo e($tipo->tema); ?></option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                    </select>
            </div>      
            </div>
          </div>
           
          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >  
             <div class="form-group"> 
                <label>Tema </label>
                <div class="input-group">
                    <span class="input-group-addon" ><i class="fa fa-text-width" ></i></span>
                     <textarea name="tema" id="tema"  class="form-control rounded-0" rows=""><?php echo e($grup->tema); ?></textarea>
                </div>          
            </div>
          </div>
          <!--para modificar institucion-->
          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >  
            <div class="form-group"> 
               <label>Institución</label>
               <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-black-tie"></i></span>
                <input id="institucion" type="text" value="<?php echo e($grup->institucion); ?>" class="form-control" name="institucion"
               placeholder="Ingresar Institución">
               </div>          
           </div>
         </div>
          <!--fin de para modificar institucion-->
        <!--=====================================
        Editar Integrantes
        ======================================-->
       
        <!--=====================================
        Editar Asesores && Tipos de Asesore
        ======================================-->

       
       
          <!--=====================================
        Editar Propuesta de Tema
        ======================================-->

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
        <div class="form-group" >   
            <label>Propuesta de Tema</label>
             <div class="input-group" >  
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                    <input type="file" accept="application/pdf" id="propuesta" value="<?php echo e($grup->propuesta); ?>"  name="propuesta" class="form-control"> 
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
	<?php echo e(Form::Close()); ?>

</div>
