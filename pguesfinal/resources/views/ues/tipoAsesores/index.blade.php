@extends('plantillas.admin')
@section('contenido')

<div class="row" >
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
		<h3>Listado de Tipos de Asesores <button class="btn btn-success" data-toggle="modal" data-target="#modalagregarasesor"><i class="fa fa-file-o"></i> Nuevo</button></h3>

	</div>
</div>




{!!Form::open (array('url'=>'ues/tipoAsesores','method'=>'POST','autocomplete'=>'off'))!!}
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

<div id="modalagregarasesor" class="modal fade" role="dialog">

<div class="modal-dialog">

<div class="modal-content">

  <form id="tipoasesor" role="form" method="post" enctype="multipart/form-data" id="formA" name="formA">

    <!--=====================================
    CABEZA DEL MODAL
    ======================================-->


    <div class="modal-header" style="background:#00a65a; color:white">

      

      <h4 class="modal-title">Agregar Tipo de Asesor</h4>

    </div>





    <!--=====================================
    CUERPO DEL MODAL
    ======================================-->
    <div class="modal-body">

      <div class="box-body">

        <!-- ENTRADA PARA EL NOMBRE -->
       
        
        <div class="form-group"> 
			<label>Tipo de Asesor</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-text-width"></i></span>
    			<input type="text" class="form-control" name="tipoasesor" id="tipoasesor" placeholder="Ingresar tipo deAsesor" autofocus>
    		</div>			
		</div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idcarrera" type="text" class="form-control" name="idcarrera" value="{{Auth::user()->idcarrera}}" >
            </div>          
        </div>
    </div> 


        <!-- ENTRADA PARA LA DIRRECCION -->

     

      </div>

    </div>


    <!--=====================================
    PIE DEL MODAL
    ======================================-->

    <div class="modal-footer">

      <button id="cancel1" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      <button id="cancel" class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Guardar </button>

    </div>

    

  </form>


</div>

</div>


</div>



</script>



{!!Form::close()!!}

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		 <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="asesor">
				<thead><!--fila-->
					<th hidden=""></th><!--celda-->
        <th>N°</th>
					<th>Tipos de A sesores</th><!--celda-->
					<th>Estado</th><!--celda-->
					<th>Opciones</th><!--celda-->						
				</thead>
        <?php $cont=1; ?>
				@foreach($tasesor as $tas)
         @if($tas->idcarrera==Auth::user()->idcarrera)
				<tr><!--fila simple-->
          <td hidden="">{{ $tas->idtipoasesor}}</td><!--celda sencilla-->
          <td><?php echo $cont; $cont++ ?></td>
					<td>{{ $tas->tipoasesor }}</td><!--celda sencilla-->
					<td> @if($tas->condicion==true) Activo 
                         @else
                        Inactivo
                        @endif </td><!--celda sencilla-->
					<td>				
@if($tas->condicion==true)
                        <a href="" data-target="#modal-edit-{{$tas->idtipoasesor}}" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-{{$tas->idtipoasesor}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
						<a href="" data-target="#modal-delete-{{$tas->idtipoasesor}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>
@else
                        <a href=""  data-target="" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-{{$tas->idtipoasesor}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-modalup-{{$tas->idtipoasesor}}" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>


    @endif        

         
                                  						

					</td><!--celda-->
				</tr>
                @include('ues.tipoAsesores.ver')
                @include('ues.tipoAsesores.edit')
                 @include('ues.tipoAsesores.edit')
                @include('ues.tipoAsesores.modal')
                 @include('ues.tipoAsesores.modalup')
       @endif        
				@endforeach
			</table>
		</div><!--div tabla responsiva-->
		

</div>

</div>



@section('script')
<script src="{{ asset('js/tbljson/tabletojson.js') }}"></script>
<script>
  $(document).ready(function() {
$('#asesor').DataTable({

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

<script>
$(document).ready(function() {



    $('#modalagregarasesor').bootstrapValidator({
       feedbackIcons: {
           /* valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
        },
        fields: {
                tipoasesor: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el tipo de Asesor '
                    },
                    stringLength: {
                        min: 5,
                        max: 256,
                        message: ' '
                    } 

                }
            }
         
    


           }



  }).on('success.form.bv', function(e) {
         
         e.preventDefault();
         bootbox.dialog({
              message: "¿Esta seguro de guardar?",
              title: "CONFIRMAR",
              buttons: {
                success: {
                  label: "SI",
                  className: "btn-success",
                  callback: function() {
                    var formulario = document.getElementById('tipoasesor');
                    formulario.submit();
                  }
                },
                danger: {
                  label: "NO",
                  className: "btn-danger",
                  callback: function() {
                                     
                  }
                }
              }
            });
        });


});
</script>

@endsection
@endsection

