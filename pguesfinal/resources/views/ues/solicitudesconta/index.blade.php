@extends('plantillas.admin')
@section('contenido')

<div class="row" >
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
			<h3>Listado de Solicitudes Contaduría Pública  </h3>
			 		
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			 <div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover" id="solicitudes">
					<thead><!--fila-->
						<th hidden=""></th><!--celda-->
        <th></th>
            <th>Solicitud</th>			
		
						<th>Opciones</th><!--celda-->						
					</thead>
					
					<tr><!--fila simple-->
						<td></td>
           <td>Solicicitud de Prórroga Interna</td>
           <td><a href=""  data-target="#modal-id" data-toggle="modal">
                        <button  class="btn btn-warning"><i class="fa fa-print"></i></button></a></td>                      
					</tr>


					 <tr>
                        <td>Solicicitud de Cambio de Tema</td>
          				 <td><a href=""  data-target="#modal-id" data-toggle="modal">
                        <button  class="btn btn-warning"><i class="fa fa-print"></i></button></a></td>
           				</tr>
                   
              
				
				</table>
			</div><!--div tabla responsiva-->
			
	
 
   
	</div>

 
	</div>



<div class="modal fade" id="modal-id">
	{{Form::Open(array('action'=>array('solicitudpicController@spiconta'),'route'=>['ues.solicitudesconta.spiconta'], 'method'=>'post', 'files' =>'true'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Solicitud de Prórroga Interna</h4>
			</div>
			<div class="modal-body">
				  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código del Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
			
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Motivo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <textarea  name="motivo"  cols="35" id="motivo" class="form-control" ></textarea>
                </div>          
            </div>
            </div>
          
</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>



  

@endsection

