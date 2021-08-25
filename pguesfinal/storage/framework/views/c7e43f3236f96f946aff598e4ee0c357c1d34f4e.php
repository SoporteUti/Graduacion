<div class="modal fade" id="modelId">
  <div class="modal-dialog">
    <div class="modal-content">
      <?php echo Form::open(['rol'=>'form','route' => ['usuario.set_access',Auth::user()->id], 'method' => 'POST','files'=>true, 'class' => 'form-horizontal']); ?>

      <div class="modal-header" style="background:#00a65a; color:white">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Cambiar Rol</h4>
      </div>
            <div class="modal-body">
                
<div class="box-body">




                      <div class="form-group<?php echo e($errors->has('select-carrera') ? ' has-error' : ''); ?> "> 
          <label>Carrera</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
              <select name="select-carrera" required="" onchange="fill_roles()" class="form-control select2able" id="select-carrera" ></select>
                <?php if($errors->has('select-carrera')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('select-carrera')); ?></strong>
                                </span>
                            <?php endif; ?>
            </div>      
      </div>

                    <div class="form-group<?php echo e($errors->has('select-rol') ? ' has-error' : ''); ?>">
                        <label>Rol</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                            <select name="select-rol"  class="form-control select2able" required="" id="select-rol"></select>
                              <?php if($errors->has('select-rol')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('select-rol')); ?></strong>
                                </span>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-home"></i> Ingresar </button>
            </div>
        </div>
    </div>
</div>