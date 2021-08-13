
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-ver-{{$ttem->idtipotema}}">
	{{Form::Open(array('action'=>array('TipotemaController@edit',$ttem->idtipotema),'method'=>'PATCH'))}}
	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

         

          <h4 class="modal-title">Información del Tipo de Proceso de Graduación</h4>

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
              <input disabled id="edit-id" type="text" class="form-control" value="{{$ttem->idtipotema}}" >
            </div>      
      </div>


      <div class="form-group"> 
      <label>Tipo de Proceso de Graduación</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-cogs"></i></span>
              <input disabled type="text" class="form-control" value="{{$ttem->tema}}" >
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