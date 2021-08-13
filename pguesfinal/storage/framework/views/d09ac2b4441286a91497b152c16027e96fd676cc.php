
<div class="modal fade" id="modal-pass">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo Form::open(array('action'=>array('UsuarioController@user'),'route'=>['ues.usuarios.user'], 'method'=>'post', 'files' =>'true','id'=>'formPassword')); ?>

      <div class="modal-header" style="background:#00a65a; color:white">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Credenciales</h4>
      </div>
      <div class="modal-body">

        <div class="form-group">
          Usuario
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="usuario" id="usuario" value="">
                </div> 
        </div>

        <div class="form-group">
          Contraseña
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control" name="pass" id="pass" value="">
                </div> 
        </div>

      <input type="hidden" id="iddocente" name="iddocente" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>  Salir</button>
          <button class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button id="sendPorcent" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Cambios</button>
      </div>
      <?php echo Form::close(); ?>

    </div>
  </div>
</div>