
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-ver-{{$carr->idcarrera}}">
	{{Form::Open(array('action'=>array('CarreraController@edit',$carr->idcarrera),'method'=>'PATCH'))}}
	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          

          <h4 class="modal-title">Información de la Carrera</h4>

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
              <input disabled id="edit-id" type="text" class="form-control" value="{{$carr->idcarrera}}" >
            </div>      
      </div>


          <div class="form-group"> 
          <label>Código</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-database"></i></span>
              <input disabled autocomplete="off"  type="text" class="form-control"  value="{{$carr->codigo}}">
            </div>      
      </div>

      <div class="form-group"> 
      <label>Nombre</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input disabled type="text" class="form-control" value="{{$carr->nombre}}" >
            </div>      
      </div>

      <div class="form-group"> 
      <label>Departamento</label>
        <div class="input-group"  >         
          <span class="input-group-addon" ><i class="fa fa-sitemap"></i></span>
          @foreach($departamento as $depto)
                            @if($depto->iddepartamento==$carr->iddepartamento )
              <input disabled type="text" class="form-control"  value="{{ $depto->nombre }}"> 
                            @endif
                            @endforeach
              
            </div>      
      </div>

       </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">
        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      </div>

       

      </form>

    </div>
		</div>
		
	</div>
	{{Form::Close()}}



</div>