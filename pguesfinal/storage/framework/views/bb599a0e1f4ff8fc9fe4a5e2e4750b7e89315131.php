<div class="modal fade" id="modal-create">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo Form::open(array('action'=>array('UsuarioController@addols'),'route'=>['ues.usuario.addrols'], 'method'=>'post', 'files' =>'true','id'=>'formCrear','class' => 'form-horizontal')); ?>

      <div class="modal-header" style="background:#00a65a; color:white">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
        <h4 class="modal-title">Agregar Roles</h4>
      </div>
      <div class="modal-body">
          <div class="row">
            <div class="form-group">
            <?php echo Form::label('nombre', 'Docente', ['class'=>'control-label col-sm-2']); ?>

            <div class="col-sm-8">
              <input type="hidden" name="iddocente" id="rol_iddocente" value="" class="form-control">
              <input type="text" name="fullname" value="" id="fullname" class="form-control" readonly="">
            </div>
          </div>
          </div>


          
          <div class="row">
            <div class="form-group">
              <?php echo Form::label('carreraselect', 'Carrera', ['class'=>"col-sm-2 control-label"]); ?>

              <div class="col-sm-8">
                  <select name="carreraselect" id="carreraselect" onchange="nuevafuncion()" class="form-control">
                    <option value="-99">[Seleccione una Carrera]</option>
                    <?php foreach($carreras as $carrera): ?>
                    <?php if($carrera->condicion==true): ?>
                      <option value="<?php echo e($carrera->idcarrera); ?>"><?php echo e($carrera->nombre); ?></option>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </select>
              </div>
          </div>
          </div>


          
          <div class="row">
            <div class="form-group">
              <?php echo Form::label('rolselect', 'Rol', ['class'=>"col-sm-2 control-label"]); ?>

              <div class="col-sm-8">
                  <select name="rolselect" id="rolselect" class="form-control">
                   
                  </select>
              </div>
              <div class="col-sm-1">
                
              <button type="button" class="btn btn-success addRow"><i class="fa fa-plus"></i></button>
              </div>
          </div>
          </div>

          <div class="responsive">
          <table name="tblRolcarrera" id="tblRolcarrera" class="table table-hover">
            <thead>
                <th>#</th>
                <th>Rol</th>
                <th>Carrera</th>
                <th></th>
            </thead>
            <tbody id="list-rolcarrera">
            </tbody>
          </table>
        </div>


      </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-danger pull-left" id="close_btn_modal" data-dismiss="modal">Cerrar</button>
         
      </div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>