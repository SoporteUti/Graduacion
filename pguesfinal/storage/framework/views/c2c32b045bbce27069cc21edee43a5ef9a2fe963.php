<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <?php echo e(Form::Open(array('action'=>array('nuevaetapaController@edit'),'route'=>['ues.nuevaetapa.update',':bar'],'method'=>'PATCH','name'=>'FormEtapaEdit','id'=>'FormEtapaEdit'))); ?>

    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
          
          <h4 class="modal-title">Editar Etapa</h4>
        </div>
      <div class="modal-body">
        <div class="form-group"> 
          <label>Nombre</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
            <input type="text" class="form-control" id="nombreetapa" name="nombreetapa" placeholder="Ingresar etapa" autofocus value="">
          </div>      
        </div><!-- fin form-group-->
        <input type="hidden" name="id_tipotrabajo" id="id_tipotrabajo">
        <input type="hidden" name="id_etapa" id="id_etapa">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>  Salir</button>
          <button class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>
      </div>
    </div>
    <?php echo e(Form::Close()); ?>

  </div>
</div>