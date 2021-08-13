
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-edit-{{$fac->idfacultad}}">
	{{Form::Open(array('action'=>array('FacultadController@edit'),'route'=>['ues.facultades.update',$fac->idfacultad],'method'=>'PATCH'))}}


	 
	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

         <!--  <button type="button" class="close" data-dismiss="modal">&times;</button> -->

          <h4 class="modal-title">Editar Facultad</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
{{-- 
             <div class="form-group"> 
            <label>Código</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-database"></i></span>
              <input autocomplete="off" id="edit-nombre" type="text" class="form-control" name="codigo" value="{{$fac->codigo}}" placeholder="Ingresar código">
            </div>      
      </div> --}}

             <div hidden="" class="form-group">
            
    <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input  id="edit-id" type="text" class="form-control" name="id" value="{{$fac->idfacultad}}" placeholder="Ingresar nombre">
            </div>      
      </div>


         
          <div class="form-group"> 
             <label>Nombre</label> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input autocomplete="off" id="edit-nombre" type="text" class="form-control" name="nombre" value="{{$fac->nombre}}" placeholder="Ingresar nombre">
            </div>      
      </div>

      <div class="form-group"> 
        <label>Teléfono</label> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input type="text" data-inputmask="'mask':'9999-9999'" data-mask id="edit-telefono" class="form-control" name="telefono" value="{{$fac->telefono}}" placeholder="Ingresar teléfono">
            </div>      
      </div>

      <div class="form-group"> 
        <label>Dirección</label> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
              <input type="text" id="edit-direccion" class="form-control" name="direccion" value="{{$fac->direccion}}" placeholder="Ingresar dirección">
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
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar </button>

        </div>

       

      </form>

    </div>
		</div>
		
	</div>
	{{Form::Close()}}



</div>