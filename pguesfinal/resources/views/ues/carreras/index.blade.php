@extends('plantillas.admin')
@section('contenido')


<!-- jQuery 2.1.4 -->
<script src="{{asset('js/jquery.min.js')}}"></script>
    




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
$(document).ready(function() {

$('#modalagregarcarrera').on('show.bs.modal', function () {
             // $('#addNodeForm').bootstrapValidator('resetForm', true);
            $(this).removeData('bs.modal');
            $('#modalagregarcarrera').bootstrapValidator('resetForm', true);
              $.ajax(
                     {
                         url: "ues/carreras",
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

    $('#modalagregarcarrera').bootstrapValidator({
        feedbackIcons: {
            /*valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
        },
        fields: {
                nombre: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el nombre del Departamento '
                    },
                    stringLength: {
                        min: 10,
                        max: 75,
                        message: 'Debe ingresar 10 caracteres como mínimo'
                    },

                      remote: {
                        message: 'La carrera ya existe',
                        url: "{{ url('/nombreCarreraValid/') }}",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "{{ csrf_token() }}";
                          }
                        }
                        
                    }
                    

                }
            },  
            codigo: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el codigo de la Carrera '
                    },
                    stringLength: {
                        min: 11,
                        max: 11,
                        message: 'Debe ingresar 11 caracteres'
                        },  
                    remote: {
                        message: 'codigo no disponible',
                        url: "{{ url('/codigoCarreraValid/') }}",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "{{ csrf_token() }}";
                          }
                        }
                        
                    }
                    
                }
            }, 


            iddep: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione Departamento '
                    },
                
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
                    var formulario = document.getElementById('departamentos');
                    formulario.submit();
                  }
                },
                danger: {
                  label: "NO",
                  className: "btn-danger",
                  callback: function() {

                    /*var formulario = document.getElementById('departamentos');
                    formulario.bootstrapValidator.destroy();
                    $('#departamentos').data('bootstrapValidator',null);*/
                                     
                  }
                }
              }
            });
        });


});
</script>





<div class="row" >
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
		<h3>Listado de Carreras   <button data-backdrop="static" data-keyboard="false" class="btn btn-success" data-toggle="modal" data-target="#modalagregarcarrera"><i class="fa fa-file-o"></i> Nueva</button>  <a><button onclick="ventana()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> Activas </button></a>  
     <a><button onclick="ventanaI()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> Inactivas </button></a></h3>
		 
      


	</div>
</div>




{!!Form::open (array('url'=>'ues/carreras','method'=>'POST','autocomplete'=>'off'))!!}
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

<div id="modalagregarcarrera" class="modal fade" role="dialog">

<div class="modal-dialog">

<div class="modal-content">

  <form id="carrera" role="form" method="post" enctype="multipart/form-data">

    <!--=====================================
    CABEZA DEL MODAL
    ======================================-->


    <div class="modal-header" style="background:#00a65a; color:white">

      

      <h4 class="modal-title">Agregar Carrera</h4>

    </div>





    <!--=====================================
    CUERPO DEL MODAL
    ======================================-->
    <div class="modal-body">

      <div class="box-body">

        <!-- ENTRADA PARA EL NOMBRE -->
        <div class="form-group"> 
            <label>Código</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input type="text" maxlength="11" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="codigo" name="codigo" placeholder="Ingresar código" autofocus>
            </div>          
        </div>
        
        <div class="form-group"> 
			<label>Nombre</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-text-width"></i></span>
    			<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresar carrera" autofocus>
    		</div>			
		</div>

    

            <div class="form-group"> 
    		<label>Departamento</label>
    			<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="iddep" id="iddep" class="form-inline form-control">
                            <option value="">[Seleccione]</option>
                            
                            @foreach($departamento as $depto)

                            @if($depto->condicion==1)

                            <option value="{{$depto->iddepartamento}}" >{{$depto->nombre}}</option>
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
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>

    </div>

   

  </form>

</div>

</div>


</div>

{!!Form::close()!!}

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		 <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="carreras">
				<thead><!--fila-->
					<th hidden=""></th><!--celda-->
          <th>N°</th>
					<th>Código</th><!--celda-->
					<th>Nombre</th>
					<th>Departamento</th><!--celda-->
					<th>Estado</th><!--celda-->
					<th>Opciones</th><!--celda-->						
				</thead>
        <?php $cont=1; ?>
				@foreach($carreras as $carr)
				<tr><!--fila simple-->
          <td><?php echo $cont; $cont++ ?></td>
					<td hidden="">{{ $carr->idcarrera}}</td><!--celda sencilla-->
					<td>{{ $carr->codigo }}</td><!--celda sencilla-->
					<td>{{ $carr->nombre }}</td><!--celda sencilla-->
                    <td>@foreach($departamento as $depto)
                            @if($depto->iddepartamento ==$carr->iddepartamento ) 
                            {{ $depto->nombre }}
                            @endif
                            @endforeach</td>
				<!--	<td>{{ $carr->iddepartamento}}</td>-->
                   	<td> @if($carr->condicion==true) Activa 
                         @else
                        Inactiva 
                        @endif </td><!--celda sencilla-->
					<td>				
@if($carr->condicion==true)
                        <a href="" data-target="#modal-edit-{{$carr->idcarrera}}" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-{{$carr->idcarrera}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
						<a href="" data-target="#modal-delete-{{$carr->idcarrera}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>
@else
                        <a href=""  data-target="" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-{{$carr->idcarrera}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-modalup-{{$carr->idcarrera}}" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>


    @endif        

         
                                  						

					</td><!--celda-->
				</tr>
                @include('ues.carreras.ver')
                @include('ues.carreras.edit')
				@include('ues.carreras.modal')
                @include('ues.carreras.modalup')
				@endforeach
			</table>
		</div><!--div tabla responsiva-->
		

</div>

</div>
@endsection

@section('script')

<script>
function ventana(id)
{
ventana1=window.open("{{ url('/listaCar/')  }}" ,'scrollbars=yes, width=800, height=1000, titlebar=no'); 
}
</script>
<script>
function ventanaI(id)
{
ventana1=window.open("{{ url('/listaCarI/')  }}" ,'scrollbars=yes, width=800, height=1000, titlebar=no'); 
}
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
$('#carreras').DataTable({

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


