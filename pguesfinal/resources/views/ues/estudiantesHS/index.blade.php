@extends('plantillas.admin')



@section('contenido')

<script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>


	<div class="row" >
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
			<h3>Listado de Estudiantes en Servicio Social <a><button onclick="ventana()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> P D F </button></a> </h3>

		</div>
	</div>




{!!Form::open (array('url'=>'ues/estudiantesHS','method'=>'POST','autocomplete'=>'off', 'files' =>'true'))!!}
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
    
<div id="modalagregarestudiante" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

     

    </div>

  </div>


</div>
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

 

{!!Form::close()!!}






<div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover" id="estudiantes">
                    <thead><!--fila-->
                        <th hidden=""></th><!--celda-->
                        <th>N°</th>
                        <th>Carné</th><!--celda-->
                        <th>Nombres</th><!--celda-->
                        <th>Apellidos</th><!--celda-->
                        <th>Carrera</th><!--celda-->
                        <th>Opciones</th><!--celda-->        
                    </thead>
                    <?php $cont=1; ?>
                    @foreach($persona as $per)
                    @if($per->condicion==true)
                    @foreach($estudiante as $est)
                    @if($est->idpersona==$per->idpersona && $est->idcarrera==Auth::user()->idcarrera)
                    @if($est->horassoc==true)
                    <tr><!--fila simple-->
                        <td><?php echo $cont; $cont++ ?></td>
                        <td hidden="">{{ $est->idestudiante}}</td>                      
                        <td>{{ $est->carnet }}</td>
                        <td>{{ $per->nombres }}</td>
                        <td>{{ $per->apellidos }}</td><!--celda sencilla-->
                        @foreach($carreras as $car)
                        @if($car->idcarrera==$est->idcarrera)

                        <td>{{ $car->nombre }}</td>
                        @endif
                        @endforeach
                        <!--celda sencilla-->
                        
                        
                    <td>
                            

                       
                       <a href="" data-target="#modal-ver-{{$per->idpersona}}" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        



                

                        </td><!--celda-->
                    </tr>
                       @include('ues.estudiantesHS.ver')
                       @endif
                    @endif
                      @endforeach

                      @endif
                    @endforeach
                </table>
            </div><!--div tabla responsiva-->
			
	
 
   </div>
	</div>

@section('script')

<script>
      $(document).ready(function() {
    $('#estudiantes').DataTable({
    
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
    function soloNumeros(e){
    var key = window.Event ? e.which : e.keyCode
    return (key >= 48 && key <= 57)
}
</script>
<script>
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = "8-37-39-46";

        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }
</script>

<script>
document.getElementById('correo').addEventListener('input', function() {
    campo = event.target;
    valido = document.getElementById('emailOK');
        
    emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo.value)) {
      valido.innerText = "válido";
    } else {
      valido.innerText = "incorrecto";
    }
});
</script>

<script>
function ventana(id)
{
ventana1=window.open("{{ url('/listaEstHS/')  }}" ,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>
@endsection


@endsection