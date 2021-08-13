@extends('plantillas.admin')
@section('contenido')





<div class="row" >
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
		<h3>Listado de Categorías <button class="btn btn-success" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalagregarcategoria"><i class="fa fa-file-o"></i> Nueva</button></h3>
		 
      
   

	</div>
</div>




{!!Form::open (array('url'=>'ues/categorias','method'=>'POST','autocomplete'=>'off'))!!}
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

<div id="modalagregarcategoria" class="modal fade" role="dialog">

<div class="modal-dialog">

<div class="modal-content">

  <form id="categoria" role="form" method="post" enctype="multipart/form-data">

    <!--=====================================
    CABEZA DEL MODAL
    ======================================-->


    <div class="modal-header" style="background:#00a65a; color:white">

     <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>-->
      <h4 class="modal-title">Agregar Categoria Docente</h4>

    </div>





    <!--=====================================
    CUERPO DEL MODAL
    ======================================-->
    <div class="modal-body">

      <div class="box-body">

        <!-- ENTRADA PARA EL NOMBRE -->
       
        
        <div class="form-group"> 
			<label>Nombre Categoría</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-text-width"></i></span>
    			<input type="text" class="form-control" name="nombrecat" id="nombrecat" placeholder="Ingresar la categoría" autofocus>
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



{!!Form::close()!!}






<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		 <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="categoria">
				<thead><!--fila-->
					<th hidden=""></th><!--celda-->
          <th>N°</th>
					<th>Categoría</th><!--celda-->
					<th>Estado</th><!--celda-->
					<th>Opciones</th><!--celda-->						
				</thead>
        <?php $cont=1; ?>
				@foreach($categoria as $cat)
				<tr><!--fila simple-->
          <td><?php echo $cont; $cont++ ?></td>
					<td hidden="">{{ $cat->idcategoria}}</td><!--celda sencilla-->
					<td>{{ $cat->nombrecat }}</td><!--celda sencilla-->
					<td> @if($cat->condicion==true) Activa 
                         @else
                        Inactiva
                        @endif </td><!--celda sencilla-->
					<td>				
@if($cat->condicion==true)
                        <a href="" data-target="#modal-edit-{{$cat->idcategoria}}" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
						<a href="" data-target="#modal-delete-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>
@else
                        <a href=""  data-target="" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-modalup-{{$cat->idcategoria}}" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>


    @endif        

         
                                  						

					</td><!--celda-->
				</tr>
                @include('ues.categorias.ver')
                @include('ues.categorias.modal')
                @include('ues.categorias.edit')
                 @include('ues.categorias.modalup')
				@endforeach
			</table>
		</div><!--div tabla responsiva-->
		
</div>


</div>


@section('script')

<script>
@if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
           // toastr.info("{{ Session::get('message')}}");
           toastr.info('{{ Session::get('message') }}', '',{progressBar:true});
            break;
        
        case 'warning':
            toastr.warning('{{ Session::get('message') }}', '',{progressBar:true});
            break;
        case 'success':
            toastr.success('{{ Session::get('message') }}', '',{progressBar:true});
             break;
        case 'error':
            toastr.error('{{ Session::get('message') }}', '',{progressBar:true});
            break;
    }
@endif



</script>


<script>
  $(document).ready(function() {
$('#categoria').DataTable({

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



    $('#modalagregarcategoria').bootstrapValidator({
       feedbackIcons: {
           /* valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
        },
        fields: {
                nombrecat: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese la categoria '
                    },
                    stringLength: {
                        min: 1,
                        max: 10,
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
                    var formulario = document.getElementById('categoria');
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

