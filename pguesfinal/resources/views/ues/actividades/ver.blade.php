
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-ver-{{$act->idactividad}}">
	{{Form::Open(array('action'=>array('ActividadController@edit',$act->idactividad),'method'=>'PATCH'))}}
	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Información de la Actividad</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <div hidden="" class="form-group"> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input disabled id="edit-id" type="text" class="form-control" name="id" value="{{$act->idactividad}}" placeholder="Ingresar nombre">
            </div>      
      </div>


          <div class="form-group"> 
          <label>Nombre</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input disabled autocomplete="off" id="edit-nombre" type="text" class="form-control" name="nombre" value="{{$act->nombre}}" placeholder="Ingresar nombre">
            </div>      
      </div>

     

    

       </div>

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
	{{Form::Close()}}



</div>