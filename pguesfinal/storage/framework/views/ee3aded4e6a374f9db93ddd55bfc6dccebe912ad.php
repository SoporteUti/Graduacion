<div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
        
        <h4 class="modal-title">Agregar Ponderación Trabajo Graduación</h4>
      </div>
      <?php echo e(Form::Open(array('action'=>array('PonderacionController@store'),'route'=>'ues.ponderacion.store','method'=>'POST','id'=>'formPoderaciones'))); ?>

      <?php echo e(Form::token()); ?>

      <div class="modal-body">
        <div class="header">
         <?php /*  <h2><?php echo e($ttem->tema); ?></h2> */ ?>
        </div>
        <input type="hidden" name="idtipotrabajo" value="<?php echo e($ttem->idtipotema); ?>">
        <div class="responsive">
          <table id="tblPonderacion" class="table table-hover">
            <thead>
              <tr>
                <th>#</th>
                <th>Etapa</th>
                <th>Ponderación</th>
              </tr>
            </thead>
            <tbody id="listEtapas">
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>  Salir</button>
          <button class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button id="sendPorcent" type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>

        <?php echo e(Form::Close()); ?>

      </div>
    </div>
  </div>
</div>