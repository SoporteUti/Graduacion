
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-edit-{{$carr->idcarrera}}">
	{{Form::Open(array('action'=>array('CarreraController@edit'),'route'=>['ues.carreras.update',$carr->idcarrera],'method'=>'PATCH'))}}


	   {{Form::token()}}
	
          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

         
          <h4 class="modal-title">Editar Carrera</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

             <div  class="form-group">
              <label>Código</label> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-database"></i></span>
              <input  id="ecodigo" type="text" class="form-control" name="codigo" value="{{$carr->codigo}}" placeholder="Modificar código">
            </div>      
      </div>


          <div class="form-group"> 
             <label>Nombre</label> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input autocomplete="off" id="nombre" type="text" class="form-control" name="nombre" value="{{$carr->nombre}}" placeholder="Modificar nombre">
            </div>      
      </div>

      <div class="form-group"> 
        <label>Departamento</label> 
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                         <select name="departamento" id="departamento" class="form-inline form-control">
                         @foreach($departamento as $depto)
                @if($depto->iddepartamento==$carr->iddepartamento)

              <option value="{{$carr->iddepartamento}}">{{$depto->nombre}}              
              </option>
            @endif
            @endforeach
                            @foreach($departamento as $depto)
                            @if($depto->condicion==1)
                            <option value="{{$depto->iddepartamento}}" >{{$depto->nombre}}</option>
                           @endif
                           @endforeach
                            </select>
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
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>

        </div>

       

      </form>

    </div>
		</div>
		
	</div>
	{{Form::Close()}}



</div>