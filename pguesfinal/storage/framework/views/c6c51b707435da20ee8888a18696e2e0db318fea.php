
<div class="modal fade" id="modal-edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
        <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
        <h4 class="modal-title">Editar Roles</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Nombre</label>
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control" name="nombreEdit" id="nombreEdit" value="" disabled>
          </div> 
        </div>

         <div class="responsive">
          <table name="tblRoledit" id="tblRoledit" class="table table-hover">
            <thead>
                <th>Rol</th>
                <th></th>
            </thead>
            <tbody id="rol-list-edit">
            </tbody>
          </table>
        </div>
      <input type="hidden" id="iddocente" name="iddocente" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>  Salir</button>
          
      </div>
    </div>
  </div>
</div>

