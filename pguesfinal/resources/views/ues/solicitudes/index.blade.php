@extends('plantillas.admin')
@section('contenido')
<div class="row" >
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
		<h3>Listado de Solicitudes </h3>		
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
					<th>Generar Solicitud</th><!--celda-->						
				</thead>
				<tr><!--fila simple-->
					<td></td>
          			<td>Solicicitud de Prórroga Interna Etapa I</td>
           			<td><a href=""  data-target="#modal-id" data-toggle="modal">
                    <button  class="btn btn-warning"><i class="fa fa-print"></i></button></a></td>
                </tr>
			</table>
		</div>
	</div>
 </div>

<div class="modal fade" id="modal-id">
{{Form::Open(array('action'=>array('solicitudController@spsistemas'),'route'=>['ues.solicitudes.spsistemas'], 'method'=>'post', 'files' =>'true'))}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header" style="background:#00a65a; color:white">
			<h4 class="modal-title">Solicitud de Prórroga Interna Etapa I</h4>
		</div>
		<div class="modal-body">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
			<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
            <div class="form-group"> 
            <label>Fecha de inicio</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="date" name="fechai" id="fechai" class="form-control" value="" required="required" title="">
                </div>          
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
            <div class="form-group"> 
            <label>Fecha de finalización</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="date" name="fechaf" id="fechaf" class="form-control" value="" required="required" title="">
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
			<button type="submit" class="btn btn-primary">Generar</button>
		</div>
	</div>
</div>
{{Form::Close()}}
</div>
@endsection