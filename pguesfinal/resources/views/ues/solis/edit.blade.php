
<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" name="editmodal" id="modal-edit-{{$enu->id}}">
	{{Form::Open(array('action'=>array('solisController@edit'),'route'=>['ues.solis.update',$enu->id],'method'=>'PATCH'))}}

          
	<div class="modal-dialog">
		<div class="modal-content">
			 <div class="modal-content">

      <form id="editarsolis" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#00a65a; color:white">

          

          <h4 class="modal-title">Editar Solicitud</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


  <div class="form-group" hidden=""> 
            <label>Texto editable</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
             <input type="text" name="id" id="id" class="form-control" value="{{$enu->id}}"  title="">
            </div>      
      </div>
             
               
          
 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
    <div class="form-group"  > 
            <label>Ciudad</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
            <input type="text" name="ciudad" id="ciudad" class="form-control" value="{{$enu->ciudad}}" required="required" >
            </div>      
      </div>
      </div>
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
      <div class="form-group"> 
            <label>Saludo</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
            <input type="text" name="saludo" id="saludo" class="form-control" value="{{$enu->saludo}}" required="required">
            </div>      
      </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="form-group"> 
            <label>Enunciado</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <textarea id="enunciado" cols="35" class="form-control" name="enunciado">{{$enu->enunciado}}</textarea> 
            </div>      
      </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="form-group"> 
            <label>Información del grupo</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
            <input type="text" name="infogrupo" id="infogrupo" class="form-control" value="{{$enu->infogrupo}}" required="required" >
            </div>      
      </div>
      </div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
  <div class="form-group"> 
            <label>Información adicional</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <textarea id="infoad" cols="35" class="form-control" name="infoad">{{$enu->infoad}}</textarea> 
            </div>      
      </div>
</div>
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      <div class="form-group"> 
            <label>Despedida</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
            <input type="text" name="despedida" id="despedida" class="form-control" value="{{$enu->despedida}}" required="required" >
            </div>      
      </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
 <div class="form-group"> 
            <label>Frase</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
            <input type="text" name="frase" id="frase" class="form-control" value="{{$enu->frase}}" required="required" >
            </div>      
      </div>
</div>
    

       </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
          <a href="" data-target="#ver-{{$enu->id}}" data-toggle="modal">
                        <button class="btn btn-success"><i class="fa fa-eye"></i>Ver Solicitud</button></a>
          <button class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Actualizar</button>

        </div>

       

      </form>

    </div>
		</div>
		
	</div>
	{{Form::Close()}}







</div>


