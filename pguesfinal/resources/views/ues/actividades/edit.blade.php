
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" name="editmodal" id="modal-edit-{{$act->idactividad}}">
	{{Form::Open(array('action'=>array('ActividadController@edit'),'route'=>['ues.actividades.update',$act->idactividad],'method'=>'PATCH'))}}

          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form id="editactividades" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Actividades</h4>

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
            <label>Nombre</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input  id="nombre" type="text" class="form-control" name="nombre" value="{{$act->nombre}}" placeholder="Modificar nombre">
            </div>      
      </div>



      

    

       </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>  Salir</button>
          <button class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar Cambios</button>

        </div>

       

      </form>

    </div>
		</div>
		
	</div>
	{{Form::Close()}}







</div>


