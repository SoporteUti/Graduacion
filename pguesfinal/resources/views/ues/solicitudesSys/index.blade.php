@extends('plantillas.admin')
@section('contenido')

<div class="row" >
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
		<h3>Listado de Solicitudes <button class="btn btn-success" data-toggle="modal" data-target="#modalsolicitud">Nueva</button></h3>
	</div>
</div>
{!!Form::open (array('url'=>'ues/solicitudesSys','method'=>'POST','autocomplete'=>'off'))!!}
{{Form::token()}}

  @if(count($errors)>0)
  <div class="alert alert-danger">
  <ul>
  @foreach($errors->all() as $error)
  <li>{{$error}}</li>
  @endforeach
  </ul>
  </div>
  @endif
    
<div id="modalsolicitud" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="actividades" role="form" method="post" enctype="multipart/form-data">
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#00a65a; color:white">
        <h4 class="modal-title">Agregar Solicitud</h4>
        </div>
        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
    <div class="modal-body">
      <div class="box-body">
        <div class="form-group"> 
				<label>Nombre(*)</label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-text-width"></i></span>
        			<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar nombre de Solicitud" autofocus>
        </div>			
			  </div>
      </div>
    </div>
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>  Salir</button>
      <button class="btn btn-warning" id="cancel" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Guardar </button>
    </div>
      </form>
    </div>
  </div>
</div>
{!!Form::close()!!}

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="solicitudes">
				<thead><!--fila-->
					<th hidden=""></th><!--celda-->
          <th>N°</th>		
					<th>Nombre</th><!--celda-->>
          <th>Estado</th><!--celda-->
					<th>Opciones</th><!--celda-->						
				</thead>
        <?php $cont=1; ?>
				@foreach($solicitude as $sol)
				<tr><!--fila simple-->
          <td><?php echo $cont; $cont++ ?></td>
          <td hidden="">{{$sol->idsolicitud}}</td>						
						<td>{{$sol->nomSolicitud}}</td>
						<td>@if($sol->condicion==true) Activo
                @else
                Inactivo
                @endif </td><!--celda sencilla-->			
            <td>
@if($sol->condicion==true)
							  <a href="" id="edit" data-target="#modal-edit-{{$sol->idsolicitud}}" data-toggle="modal">
                <button  class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                <a href="" id="" data-target="#modal-id" data-toggle="modal"><button  class="btn btn-success"><i class="fa fa-print"></i></button></a>
                <a href="" data-target="#modal-delete-{{$sol->idsolicitud}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>
@else
                <a href=""  data-target="" data-toggle="modal">
                <button  class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                <a href="" id="" data-target="" data-toggle="modal">
                <button  class="btn btn-success"><i class="fa fa-print"></i></button></a>
                <a href="" data-target="#modal-modalup-{{$sol->idsolicitud}}" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>
@endif 

						</td><!--celda-->
				</tr>
          @include('ues.solicitudesSys.edit')
          @include('ues.solicitudesSys.modal')   
          @include('ues.solicitudesSys.modalup')
        
					@endforeach
			</table>
		</div><!--div tabla responsiva-->
	</div>

<script>
        $(window).load(function(){
            $('#solicitudes').removeAttr('style');
        })
    </script>


<script>
      $(document).ready(function() {
    $('#solicitudes').DataTable({
    
    "language":{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  }
}
  );
} );
    </script>
@endsection