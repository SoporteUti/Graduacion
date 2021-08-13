
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" name="editmodal" id="modal-edit-{{$dep->iddepartamento}}">
	{{Form::Open(array('action'=>array('departamentosController@edit'),'route'=>['ues.departamentos.update',$dep->iddepartamento],'method'=>'PATCH'))}}

          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form id="editdepartamentos" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          

          <h4 class="modal-title">Editar Departamento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">



     {{--      <div class="form-group"> 
            <label>Código</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-database"></i></span>
              <input  id="codigo" type="text" class="form-control" name="codigo" value="{{$dep->codigo}}" placeholder="Modificar nombre">
            </div>      
      </div>
 --}}
          <div class="form-group"> 
            <label>Nombre</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input  id="nombre" type="text" class="form-control" name="nombre" value="{{$dep->nombre}}" placeholder="Modificar nombre">
            </div>      
      </div>



      <div class="form-group"> 
        <label>Facultad</label>
        <div class="input-group">         
            <span class="input-group-addon"><i class="fa fa-bank"></i></span>
              <select name="facultad" id="facultad" class="form-inline form-control">
                @foreach($facultades as $fac)
                @if($fac->idfacultad==$dep->idfacultad)

              <option value="{{$dep->idfacultad}}">{{$fac->nombre}}   

              <?php   $value=$dep->idfacultad;        ?>
              </option>
            @endif
            @endforeach


              @foreach($facultades as $fac)
              @if($fac->condicion==1 && $fac->idfacultad!=$value )
<option value="{{$fac->idfacultad}}">{{$fac->nombre}}
                
              </option>
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


