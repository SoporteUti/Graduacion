@extends('plantillas.admin')
@section('contenido')

<!-- jQuery 2.1.4 -->
{{-- <script src="{{asset('js/jquery.min.js')}}"></script> --}}
 {{-- <script type="text/javascript" language="javascript" src="{{asset('js/jquery.dataTables.min.js')}}" > </script>
    <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}" > </script>
    <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}" > </script>
    <script type="text/javascript" language="javascript" src="{{asset('js/dataTables.responsive.min.js')}}" > </script>
     --}}

   <div class="container-fluid">
       <div class="row">
         <div class="col-xs-12">

           <div class="row" >
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
      <h3>Listado de Usuarios <a  data-toggle="modal" data-target="#modal-usuarios"><button class="btn btn-info"><i class="fa fa-file-pdf-o" ></i> PDF</button></a> </h3>

    </div>
  </div>



  {!! Form::open(['route'=>['ues.usuarios.listauser'],'method'=>'POST']) !!}
<div   class="modal fade" id="modal-usuarios">
<div class="modal-dialog">
  <div class="modal-content">
     <form id="gruppo" role="form" method="post"  enctype="multipart/form-data">
   
        <div class="modal-header" style="background:#00a65a; color:white">
           <!--  <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
            <h4 class="modal-title">Usuarios por Departamento</h4>
        </div>
        <div class="modal-body">
           <div class="box-body">
             <!---Seleccionar Departamento -->


          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
           <div class="form-group"> 
            <label class="form-inline">Departamento</label>
            <div class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="dept" id="dept" class="form-inline form-control">
                <option value="-1">[Seleccione]
                </option>
               
                       @foreach($departamento as $depto)

                        @if($depto->condicion==1 )

                        <option value="{{$depto->iddepartamento}}" >{{$depto->nombre}}</option>
                       @endif
                       @endforeach
                </select>
                </div>          
                </div> 
            </div> 
             <!---Seleccionar Carrera -->  
    



            <!---Seleccionar Año -->  
          
           
            
       
           
          </div>
        </div>
        
        <div class="modal-footer">
           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> Cerrar</button>
           <button class="btn btn-warning" type="reset" onclick="disable()"> <i class="fa fa-times"></i> Cancelar</button>
           <button type="submit" class="btn btn-primary" onclick="" id="sendBTN" >Generar</button>
       </div>
      </form>
    </div>
</div>

</div>
 {!! Form::close() !!}
             <!-- /.box-header -->
             <div class="box-body">
               <table class="table table-striped table-bordered table-condensed table-hover dataTable1" id="usuarios">
                 <thead>
                   <tr>
                     <th>N°</th>
                     <th>Nombre</th> 
                     <th>Apellidos</th>
                     <th>Estado</th>
                     <th>Opciones</th><!--celda--> 
                   </tr>
                 </thead>
                 <tbody>
                  <?php $cont=1; ?>
                  @foreach($docentesU as $doc)
                  <tr>
                   <td><?php echo $cont; $cont++ ?> {!! Form::hidden(null, $doc->idpersona, ['id'=>'cell_iddocente']) !!}</td>
                   <td  id="cell_nombre">{{ $doc->nombre }}</td>
                   <td  id="cell_apellido">{{ $doc->apellidos }}</td>
                     <?php $a="Rol no asignado";  ?>
                       @foreach($docen as $dc)
                       @if($dc->idpersona== $doc->idpersona)
                       @foreach($roles1 as $rl)
                       @if($rl->iddocente== $dc->iddocente)
                       <?php $a="Rol  asignado";  ?>
                       @endif
                       @endforeach
                       @endif
                       @endforeach
                    <td><?php echo $a; ?></td>
                    
                   <td>
                   <a href="#modal-create" data-toggle="modal" class="btn btn-primary" onclick="addRolCarrera({{$doc->idpersona}})"><i class="glyphicon glyphicon-plus"></i>


                   @if($a=="Rol  asignado")
                   <a href="#modal-edit" data-toggle="modal">
                     <button class="btn btn-warning" onclick="editUser({{$doc->idpersona}})"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                   </a>
                     @else
                     <a href="" data-toggle="modal">
                     <button class="btn btn-danger" onclick=""><i class="fa fa-pencil" aria-hidden="true"></i></button>
                   </a>
                   @endif

                    @if($a=="Rol  asignado")
                    <a href="#modal-show" data-toggle="modal">
                      <button class="btn btn-success" onclick="showUser({{$doc->idpersona}})"><i class="fa fa-eye" aria-hidden="true"></i></button>
                    </a>
                   @else
                   <a href="" data-toggle="modal">
                      <button class="btn btn-danger" onclick=""><i class="fa fa-eye" aria-hidden="true"></i></button>
                    </a>
                   @endif
                   
                   
                 </td>
                     </tr>
                 <?php $a="Rol no asignado";  ?>
                     @endforeach
                   </tbody>
                 </table>
                 {{-- MODALES --}}
                 @include('ues.usuarios.pass')
                 @include('ues.usuarios.ver')
                 @include('ues.usuarios.edit')
                 @include('ues.usuarios.crear')
               </div>
             </div>

           </div>
         </div>
       </div>


  @section('script')

  <script>
function ventana(id)
{
ventana1=window.open("{{ url('/listaUser/')  }}" ,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>

  <script type="text/javascript">
    $(document).ready(function () {
      $("#cancel").on("click", function () {
        $('.form-group').removeClass('has-success has-error');
        $('.glyphicon ').remove();        
      });
      $(".chosen-select").chosen({no_results_text: "Oops, nothing found!",width: "100%"});  
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      $("#cancel1").on("click", function () {
        $('.form-group').removeClass('has-success has-error');
        $('.glyphicon ').remove();
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
              $('#usuarios').DataTable({
                "order":[[1,"asc"]],
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
  
  function showAlert(dataAlert) {
    toastr[dataAlert['alert-type']](dataAlert['message'], dataAlert['title'],{
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  });
  }

 function getFormData(form) {
  var unindexed_array = form.serializeArray();
  var indexed_array = {};
  $.map(unindexed_array, function(n, i) {
    indexed_array[n['name']] = n['value'];
  });
  return indexed_array;
}

function removeRol(btn) {
  idroldlt=btn.parentNode.parentNode.getElementsByTagName("input")[0].value;
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var Data = {
    id:idroldlt
  }
  var url = "{{ route('ues.usuario.deleterol',':bar') }}";
  url = url.replace(':bar', idroldlt);
  $.ajax({
    type:'DELETE',
    url:url,
    data:Data,
    dataType:'json',
    success:function (data) {
      showAlert(data['notificacion'])
      removeNode(btn);
    },error:function (data) {
      console.log('Error:', data.responseText);
    }
  });
  
}

function removeRow(btn) {
  var idrol = btn.parentNode.parentNode.getElementsByTagName("input")[0].value;
  var idcarrera = btn.parentNode.parentNode.getElementsByTagName("input")[1].value;
  var iddocente = document.getElementById('rol_iddocente').value;
  var Data ={
    'idrol':idrol,
    'idcarrera':idcarrera,
    'iddocente':iddocente
  };
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'POST',
    url: "{{ route('ues.usuario.removerol') }}",
    data: Data,
    dataType: 'json',
    success: function (data) {
      showAlert(data['notificacion']);
      removeNode(btn);
    },
    error: function (data) {
      console.log('Error:', data);
    }
  });//fin
  
}

function removeNode(btn) {
  btn.parentNode.parentNode.remove();
}

function showUser(id) {
  var Data = getFormData($('#formPassword'));
  var url = "{{ route('ues.usuario.getdocenteroles',':bar') }}";
  url = url.replace(':bar', id);
  $('.rol-list').empty();;
  $.ajax({
    type: 'POST',
    url: url,
    data: Data,
    dataType: 'json',
    success: function(data) {
      $('#rol-list-show').empty();
      for (var i = 0; i < data['roles'].length ; i++) {
       // console.log(data['roles'][i].idrol);
        document.getElementById("nombreShow").value= data.docente['nombres']+" " +data.docente['apellidos']
       var rol=data['roles'][i];

       if (rol.anio) {
$('#rol-list-show').append(
          "<tr>"+
              "<input type='hidden' name='idrol' value='"+rol.idrol_carrera+"'>"+
              "<td>"+ rol.nombre  +" "+ rol.anio  + "</td>"+
              "<td></td>"+
            "</tr>"
        );

       }else{

        $('#rol-list-show').append(
          "<tr>"+
              "<input type='hidden' name='idrol' value='"+rol.idrol_carrera+"'>"+
              "<td>"+ rol.nombre  + "</td>"+
              "<td></td>"+
            "</tr>"
        );
       }
        



      }
    },
    error: function(data) {
      console.log('Error:', data.responseText);
    }
  });
}

function editUser(id) {
  var Data = getFormData($('#formPassword'));
  var url = "{{ route('ues.usuario.getdocenteroles',':bar') }}";
  url = url.replace(':bar', id);
  $('.rol-list-edit').empty();;
  $.ajax({
    type: 'POST',
    url: url,
    data: Data,
    dataType: 'json',
    success: function(data) {
      $('#rol-list-edit').empty();
      for (var i = 0; i < data['roles'].length ; i++) {
        //console.log(JSON.stringify(data['roles'][i]));
        document.getElementById("nombreEdit").value=data.docente['nombres']+" " +data.docente['apellidos']
       var rol=data['roles'][i];
       if(rol.anio){
        $('#rol-list-edit').append(
          "<tr>"+
              "<input type='hidden' name='idrol' value='"+rol.idrol_carrera+"'>"+
              "<td>"+ rol.nombre  +" " + rol.anio +"</td>"+
              "<td><button type='button' class='btn btn-danger' onclick='removeRol(this);'><i class='fa fa-trash'></i></button></td>"+
            "</tr>"
        );
}else{
    $('#rol-list-edit').append(
          "<tr>"+
              "<input type='hidden' name='idrol' value='"+rol.idrol_carrera+"'>"+
              "<td>"+ rol.nombre  +"</td>"+
              "<td><button type='button' class='btn btn-danger' onclick='removeRol(this);'><i class='fa fa-trash'></i></button></td>"+
            "</tr>"
        );
}

      }
    },
    error: function(data) {
      console.log('Error:', data.responseText);
    }
  });
}

function addPassUser(id) {
  var url = "{{ route('ues.usuario.getdocenteroles',':bar') }}";
  url = url.replace(':bar', id);
  document.getElementById('iddocente').value=id;
  var Data = getFormData($('#formPassword'));
  console.log(Data);
  /*$.ajax({
    type: 'POST',
    url: url,
    data: Data,
    dataType: 'json',
    success: function(data) {
      console.log(data);
    },
    error: function(data) {
      console.log('Error:', data.responseText);
    }
  });*/
}

function addRolCarrera(id) {
  $('#list-rolcarrera').empty();
  var url = "{{ route('ues.usuarios.loaddata',':bar') }}";
  url = url.replace(':bar', id);
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type:'POST',
    url:url,
    dataType:'json',
    success:function(data) {
      var doc = data['docente'];
       var iddocente = data['iddocente'];
     document.getElementById('rol_iddocente').value = iddocente;
     document.getElementById('fullname').value = doc['nombres'] + ' ' + doc['apellidos'];
    },
    error:function(data) {
      
    }
  });
}

function nuevafuncion(){
      var id = $('#carreraselect option:selected').val();
      if (id >-1) {
        var url = "{{ route('ues.reloadroles',':bar') }}";
      url = url.replace(':bar', id);
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
        type:'POST',
        url:url,
        dataType:'json',
        success:function(data) {
          console.log(data);
          $('#rolselect').empty();
          $('#rolselect').append("<option value='-90'>[Seleccione un Rol]</option>");
          for (var i =  0; i < data['roles'].length; i++) {
            var option = "";
                $('#rolselect').append();
               if(data['roles'][i]['idrol']==6 || data['roles'][i]['idrol']==1){

               }else{
                 if(data['roles'][i]['idrol']==data['rol_jefe']['idrol'] && data['rol_jefe']['num']>0){
                    option = "<option value='"+data['roles'][i]['idrol']+"' disabled>"+data['roles'][i]['nombre']+"</option>"
                }else if(data['roles'][i]['idrol']==data['rol_coordinador']['idrol'] && data['rol_coordinador']['num']>0){
                    option = "<option value='"+data['roles'][i]['idrol']+"' disabled>"+data['roles'][i]['nombre']+"</option>"
                }else if(data['roles'][i]['idrol']==data['rol_director']['idrol'] && data['rol_director']['num']>0){
                    option = "<option value='"+data['roles'][i]['idrol']+"' disabled>"+data['roles'][i]['nombre']+"</option>"
                }else{
                  option = "<option value='"+data['roles'][i]['idrol']+"'>"+data['roles'][i]['nombre']+"</option>"
                }
                                $('#rolselect').append(option);

               }

          }
        },
        error:function(data) {
          console.log("error: "+ data.responseText);
        }
      });
      }
    }

</script>
<script>
    

    
    $('.addRow').click(function() {
      var carrera_id = $('#carreraselect option:selected').val();
      var carrera_nombre = $('#carreraselect option:selected').text();
      var rol_id = $('#rolselect option:selected').val();
      var rol_nombre = $('#rolselect option:selected').text();
      var iddocente = document.getElementById('rol_iddocente').value;
      ///console.log(carrera_id);
      var index = $('#list-rolcarrera tr').length + 1;
      if(carrera_id > -1 ){
            $('#list-rolcarrera').append("<tr>"+
              "<input type='hidden' name='rol_carrera_nombres["+index+"][rol]' value='"+ rol_id +"' >"+
              "<input type='hidden'  name='rol_carrera_nombres["+index+"][carrera]'  value='"+ carrera_id +"' >"+
              "<td>"+index+"</td>"+
              "<td>"+ rol_nombre  +"</td>"+
              "<td>"+ carrera_nombre +"</td>"+
              "<td><button type='button' class='btn btn-danger' onclick='removeRow(this);'><i class='fa fa-trash'></i></button></td>"+
            "</tr>");
            var Data= {
              idrol:rol_id,
              iddocente:iddocente,
              idcarrera:carrera_id
            };
            console.log('data: '+JSON.stringify(Data));
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
            $.ajax({
                  type: 'POST',
                  url: "{{ route('ues.usuario.addrols') }}",
                  data: Data,
                  dataType: 'json',
                  success: function (data) {
                      showAlert(data['notificacion']);
                  },
                  error: function (data) {
                      console.log('Error:', data.responseText);
                  }
              });//fin
              document.getElementById("carreraselect").value=-99;
      }else{
        var dataAlert = {
          'alert-type':'error',
          'message':'Debe de seleccionar una carrera',
          'title':'Error'
        };
        showAlert(dataAlert);
      }
    });



    $('.sendPolCarrera').click(function(e) {
      e.preventDefault();
      document.getElementById("close_btn_modal").click();
  });
  
</script>
@endsection
@endsection
  