@extends('plantillas.admin')
@section('contenido')


<div class="row" >
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
		<h3>Listado de Procesos de Trabajos de Graduación <button class="btn btn-success" data-toggle="modal" data-target="#modalagregartema"><i class="fa fa-file-o"></i> Nuevo</button></h3>
		 
	</div>
</div>


{!!Form::open (array('url'=>'ues/tipoTemas','method'=>'POST','autocomplete'=>'off'))!!}
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

<div id="modalagregartema" class="modal fade" role="dialog">

<div class="modal-dialog">

<div class="modal-content">

  <form id="agregartema" role="form" method="post" enctype="multipart/form-data" id="formA" name="formA">

    <!--=====================================
    CABEZA DEL MODAL
    ======================================-->


    <div class="modal-header" style="background:#00a65a; color:white">

      

      <h4 class="modal-title">Agregar Tipo de Procesos de Graduación</h4>

    </div>





    <!--=====================================
    CUERPO DEL MODAL
    ======================================-->
    <div class="modal-body">

      <div class="box-body">

        <!-- ENTRADA PARA EL NOMBRE -->
       
        
        <div class="form-group"> 
			<label>Tipos de Procesos de Graduación</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-cogs"></i></span>
    			<input type="text" class="form-control" name="tema" id="tema" placeholder="Ingresar tipo de Trabajo de Graduación" autofocus>
    		</div>			
		</div>

     <div class="form-group"> 
        <label>Carrera(*)</label>
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
                <select name="idcarrera" id="idcarrera" class="form-inline form-control">
                            <option value="">[Seleccione]</option>
                            @foreach($carrera as $car)
                            @if($car->condicion==true)
                            <option value="{{$car->idcarrera}}" >{{$car->nombre}}</option>
                           @endif
                           @endforeach
                            </select>
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
			<table class="table table-striped table-bordered table-condensed table-hover" id="temas">
				<thead><!--fila-->
					<th hidden=""></th><!--celda-->
          <th>N°</th>
					<th>Procesos de Graduación</th><!--celda-->
          <th>Carrera</th><!--celda-->
					<th>Estado</th><!--celda-->
					<th>Opciones</th><!--celda-->						
				</thead>
        <?php $cont=1; ?>
				@foreach($ttemas as $ttem)
        
				<tr><!--fila simple-->
          <td><?php echo $cont; $cont++ ?></td>
					<td hidden="">{{ $ttem->idtipotema}}</td><!--celda sencilla-->
					<td>{{ $ttem->tema }}</td><!--celda sencilla-->
          <td>{{$ttem->nombre}}</td>
					<td> @if($ttem->condicion==true) Activo 
                         @else
                        Inactivo
                        @endif </td><!--celda sencilla-->
					<td>				
@if($ttem->condicion==true)
                        <a href="" data-target="#modal-edit-{{$ttem->idtipotema}}" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>

                        <a href="#modal-id" data-toggle="modal">
                        <button class="btn btn-info" onclick="loadEtapas({{$ttem->idtipotema}})"><i class="fa fa-percent" aria-hidden="true"></i></i></button></a>

                       <a href="" data-target="#modal-ver-{{$ttem->idtipotema}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>

						<a href="" data-target="#modal-delete-{{$ttem->idtipotema}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>

@else
                        <a href=""  data-target="" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-{{$ttem->idtipotema}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-modalup-{{$ttem->idtipotema}}" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>


    @endif        

         
                                  						

					</td><!--celda-->
				</tr>
                @include('ues.tipoTemas.ver')
                @include('ues.tipoTemas.edit')
                @include('ues.tipoTemas.modal')
                @include('ues.tipoTemas.modalup')
               
				@endforeach
			</table>
		</div><!--div tabla responsiva-->
		
</div>


</div>

@include('ues.tipoTemas.add_porcent')





@endsection

@section('script')
<script src="{{ asset('js/tbljson/tabletojson.js') }}"></script>
<script>
  $(document).ready(function() {
$('#temas').DataTable({

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

        <script type="text/javascript">
        $(document).ready(function () {
        $("#cancel").on("click", function () {
            $('.form-group').removeClass('has-success has-error');
           $('.glyphicon ').remove();
            /*$("#codigo").validate().resetForm();
   $("#codigo").removeClass("has-error");
   $('.form-group').removeClass('has-error has-feedback');
        $('.form-group').find('small.help-block').hide();
        $('.form-group').find('i.form-control-feedback').hide();*/
           

        });
    });
</script>
<script type="text/javascript">
        $(document).ready(function () {
        $("#cancel1").on("click", function () {
            $('.form-group').removeClass('has-success has-error');
           $('.glyphicon ').remove();
            /*$("#codigo").validate().resetForm();
   $("#codigo").removeClass("has-error");
   $('.form-group').removeClass('has-error has-feedback');
        $('.form-group').find('small.help-block').hide();
        $('.form-group').find('i.form-control-feedback').hide();*/
           

        });
    });
</script>

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

  $('.sendPorcent').click(function(e) {
    var table = getFormData($('#formPoderaciones'));
    $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });


              e.preventDefault();
              $.ajax({
                  type: 'POST',
                  url: "{{ route('ues.ponderacion.store') }}",
                  data: {table:table},
                  dataType: 'json',
                  success: function (data) {
                      console.log(data);
                  },
                  error: function (data) {
                      console.log('Error:', data);
                  }
              });//fin
    console.log(table);
  });

$('#modalagregartema').on('show.bs.modal', function () {
             // $('#addNodeForm').bootstrapValidator('resetForm', true);
            $(this).removeData('bs.modal');
            $('#modalagregartema').bootstrapValidator('resetForm', true);
              $.ajax(
                     {
                         url: "ues/tipoTemas",
                         type: "GET",
                         success:function(text) 
                         {
                             /*alert(text);
                            nodelist = text;*/
                         },
                         error: function(jqXHR, textStatus, errorThrown) 
                         {
                             //if fails      
                         }
                     });
            });

    $('#modalagregartema').bootstrapValidator({
       feedbackIcons: {
           /* valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
        },
        fields: {
                tema: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el tema '
                    },
                    stringLength: {
                        min: 5,
                        max: 256,
                        message: ' '
                    } 

                }
            },  
         

            direccion: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese la direccion de la facultad '
                    },
                    stringLength: {
                        min: 10,
                        message: 'Debe ingresar una direccionmas específica'
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
                    var formulario = document.getElementById('agregartema');
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
<script>

  function getFormData(form) {
    var unindexed_array = form.serializeArray();
    var indexed_array = {};
    $.map(unindexed_array, function(n, i) {
        indexed_array[n['name']] = n['value'];
    });
    return indexed_array;
}
  
    function loadEtapas(idtipotema) {
      var vidtbody = 'tbody-'+idtipotema
      var url = "{{ route('ues.nuevaetapa.getetapas',':bar') }}";
      url = url.replace(':bar', idtipotema);
      var Data = {
        "_token": $('meta[name="csrf-token"]').attr('content'),
      }; 

      $("#listEtapas").empty();
      $.ajax({
        type: 'POST',
              url: url,
              data: Data,
              dataType: 'json',
              success: function(data) {
                  console.log(data);
                  var list = document.getElementById("listEtapas");
                  var etapas=data.etapas;
                  for (var i = 0; i < etapas.length; i++) {
                    var etapa= etapas[i];
                    var markup = "<tr><td>"+ etapa.idetapa+"</td><td>"+etapa.idnombreetapa+"<input type='hidden' name='etapas["+ i +"][idetapa]' value='"+ etapa.idetapa+"'><input type='hidden' name='etapas["+ i +"][idponderacion]' value='"+ etapa.idponderacion+"'></td><td><div class='input-group'><input type='number' class='form-control percent' name='etapas["+ i +"][porcentaje]' value='"+ etapa.porcentaje+"' step='0.1'><span class='input-group-addon'>%</span></div></td></tr>";
                    $("#listEtapas").append(markup);
                  }
              },
              error: function(data) {
                  console.log('Error:', data.responseText);
              }
      });
    }
</script>
@endsection