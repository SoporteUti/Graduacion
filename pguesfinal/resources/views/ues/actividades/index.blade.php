@extends('plantillas.admin')
@section('contenido')



    <!-- jQuery 2.1.4 -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
        
        <script type="text/javascript" language="javascript" src="{{asset('js/jquery.dataTables.min.js')}}" > </script>
       
        <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}" > </script>
        
        <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}" > </script>
        
        <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.responsive.min.js')}}" > </script>

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
<style>
        .panel-heading {
            padding: 0;
        }
        .panel-heading ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .panel-heading li {
            float: left;
            border-right:1px solid #bbb;
            display: block;
            padding: 14px 16px;
            text-align: center;
        }
        .panel-heading li:last-child:hover {
            background-color: #ccc;
        }
        .panel-heading li:last-child {
            border-right: none;
        }
        .panel-heading li a:hover {
            text-decoration: none;
        }

        .table.table-bordered tbody td {
            vertical-align: baseline;
        }
    </style>


    <script>

$(document).ready(function() {


 $('#modalagregaractividad').on('show.bs.modal', function () {
             // $('#addNodeForm').bootstrapValidator('resetForm', true);
            $(this).removeData('bs.modal');
            $('#modalagregaractividad').bootstrapValidator('resetForm', true);
              $.ajax(
                     {
                         url: "ues/actividades",
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





    $('#modalagregaractividad').bootstrapValidator({
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
                        message: 'Ingrese el nombre de la Actividad '
                    },
                    stringLength: {
                        min: 5,
                        max: 75,
                        message: 'Debe ingresar 5 caracteres como mínimo'
                    } 

                }
            },  
            codigo: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el codigo de la facultad '
                    },
                    stringLength: {
                        min: 3,
                        max: 16,
                        message: 'Debe ingresar 3 caracteres como mínimo'
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
                    var formulario = document.getElementById('actividades');
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



          
       

<div style="width: 20px; height: 30px;float: left;">
<img src="{{ asset('img/minerva2.png') }}"   width="100px" height="110px"  ></img>

</div>
<h4 align="center">
Universidad de El Salvador<br>
Facultad Multidisciplinaria Paracentral<br>
<br>
<h4 align="center">
APLICACIÓN WEB PARA EL CONTROL DE PROCESOS DE GRADUACIÓN <br>
EN LA FACULTAD MULTIDISCIPLINARIA PARACENTRAL<br>
DE LA UNIVERSIDAD DE EL SALVADOR<br>

<br>
<br>
          <b align="center">Version de la aplicacion</b> 1.0
<br>
 <strong>Copyright &copy; <?php echo date("Y"); ?> <a href="http://www.fmp.ues.edu.sv/">UES-FMP</a>.</strong> Todos los derechos reservados.

<br>
<br>
<br>
<br>









	
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
        $(window).load(function(){
            $('#actividades').removeAttr('style');
        })
    </script>


<script>
      $(document).ready(function() {
    $('#actividades').DataTable({
    
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

