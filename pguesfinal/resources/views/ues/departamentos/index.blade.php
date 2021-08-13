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


    <script>

$(document).ready(function() {


 $('#modalagregardepartamento').on('show.bs.modal', function () {
             // $('#addNodeForm').bootstrapValidator('resetForm', true);
            $(this).removeData('bs.modal');
            $('#modalagregardepartamento').bootstrapValidator('resetForm', true);
              $.ajax(
                     {
                         url: "ues/departamentos",
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


    $('#modalagregardepartamento').bootstrapValidator({
       feedbackIcons: {
           /* valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
        },
        excluded: [':disabled'],
        fields: {
                nombre: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el nombre del Departamento '
                    },
                    stringLength: {
                        min: 6,
                        max: 75,
                        message: 'Debe ingresar 6 caracteres como mínimo'
                    } 

                }
            },  
             codigo: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el codigo del Departamento '
                    },
                    stringLength: {
                        min: 3,
                        max: 16,
                        message: 'Debe ingresar 3 caracteres como mínimo'
                        },  
                    remote: {
                        message: 'codigo no disponible',
                        url: "{{ url('/codigoDeptoValid/') }}",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "{{ csrf_token() }}";
                          }
                        }
                        
                    }
                    
                }
            }, 
            facultad: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione facultad '
                    },
                
                }
            }


           }



  }).on('success.form.bv', function(e) {
         
         e.preventDefault();
         bootbox.dialog({
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
                                     
                  }
                }
              }
            });
        });


 



});
</script>


	<div class="row" >
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
			<h3>Listado de Departamentos   <button data-backdrop="static" data-keyboard="false" class="btn btn-success" data-toggle="modal" data-target="#modalagregardepartamento"><i class="fa fa-file-o"></i> Nuevo</button>   
       </h3>
			 
          
       

			
		</div>
	</div>




{!!Form::open (array('url'=>'ues/departamentos','method'=>'POST','autocomplete'=>'off'))!!}
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
    
<div id="modalagregardepartamento" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form id="departamentos" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
 

        <div class="modal-header" style="background:#00a65a; color:white">

          

          <h4 class="modal-title">Agregar Departamento</h4>

        </div>





        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
         {{--     <div class="form-group"> 
            <label name="codigolabel" id="codigolabel">Código(*)</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input id="codigo" type="text"    class="form-control" name="codigo"  placeholder="Ingresar código" autofocus>
                </div>          
            </div>
             --}}
            <div class="form-group"> 
				<label>Nombre(*)</label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-text-width"></i></span>
        			<input type="text" class="form-control" name="nombre" placeholder="Ingresar nombre" autofocus>
        		</div>			
			</div>

            <!-- ENTRADA PARA TELEFONO -->

            <!-- ENTRADA PARA LA DIRRECCION -->

           <div class="form-group"> 
			  <label>Facultad(*)</label>
				<div class="input-group">					
					<span class="input-group-addon"><i class="fa fa-bank"></i></span>
        			<select name="facultad" id="facultad" class="form-inline form-control">

        			<option value="">[Seleccione]
        				
        			</option>
        		
        			@foreach($facultades as $fac)
        			@if($fac->condicion==1)
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
          <button class="btn btn-warning" id="cancel" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>

        </div>

       

      </form>

    </div>

  </div>


</div>


{!!Form::close()!!}

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			 <div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover" id="departamentos">
					<thead><!--fila-->
						<th hidden=""></th><!--celda-->
            <th>N°</th>
        {{--     <th>Código</th><!--celda--> --}}
						<th>Nombre</th><!--celda-->
						<!--<th>Decano</th>celda-->
						
						<th>Facultad</th><!--celda-->
                        <th>Estado</th><!--celda-->
						<th>Opciones</th><!--celda-->						
					</thead>
          <?php $cont=1; ?>
					@foreach($departamento as $dep)
					<tr><!--fila simple-->
           <td><?php echo $cont; $cont++ ?></td>
            <td hidden="">{{ $dep->iddepartamento}}</td>						
					{{-- 	<td>{{ $dep->codigo }}</td --}}
						<td>{{ $dep->nombre }}</td><!--celda sencilla-->
						@foreach($facultades as $fac)
        				@if($fac->idfacultad==$dep->idfacultad)

						<td>{{ $fac->nombre }}</td>
						@endif
						@endforeach
						<!--celda sencilla-->
						
						<td> @if($dep->condicion==1) Activo
                         @else
                        Inactivo
                        @endif </td><!--celda sencilla-->
                    <td>
							
@if($dep->condicion==1)
                        <a href="" id="edit" data-target="#modal-edit-{{$dep->iddepartamento}}" data-toggle="modal">
                        <button  class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-{{$dep->iddepartamento}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-delete-{{$dep->iddepartamento}}" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>
@else
                        <a href=""  data-target="" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-{{$dep->iddepartamento}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-modalup-{{$dep->iddepartamento}}" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>


    @endif       		

						</td><!--celda-->
					</tr>
                    @include('ues.departamentos.ver')
                    @include('ues.departamentos.edit')
                    @include('ues.departamentos.modal')
                    @include('ues.departamentos.modalup')
					@endforeach
				</table>
			</div><!--div tabla responsiva-->
			
	</div>
 
   
	</div>


@section('script')

<script>
function ventana(id)
{
ventana1=window.open("{{ url('/listaDepto/')  }}" ,'scrollbars=yes, width=800, height=1000, titlebar=no'); 
}
</script>
<script>
function ventanaI(id)
{
ventana1=window.open("{{ url('/listaDeptoI/')  }}" ,'scrollbars=yes, width=800, height=1000, titlebar=no'); 
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
    $('#departamentos').DataTable({
    
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

@endsection

