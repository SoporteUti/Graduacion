@extends('plantillas.admin')
@section('contenido')
<div class="row" >
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
		<h3> Listado de Etapas   <button class="btn btn-success" data-toggle="modal" data-target="#modalagregaretapa"><i class="fa fa-file-o"></i> Nuevo</button></h3>
	</div>
</div>

     @if(count($errors)>0)
    <div class="alert alert-danger">
        <ul>
        @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            
        @endforeach
        </ul>
    </div>
    @endif

<div id="modalagregaretapa" class="modal fade" role="dialog">
  {!!Form::open (array('url'=>'ues/nuevaetapa','method'=>'POST','autocomplete'=>'off'))!!}
  <div class="modal-dialog">
    <div class="modal-content">
      <form name="formEtapa" id="etapa" role="form" method="post" enctype="multipart/form-data">

    <!--=====================================
    CABEZA DEL MODAL
    ======================================-->
        <div class="modal-header" style="background:#00a65a; color:white">
          
          <h4 class="modal-title">Agregar Etapa</h4>
        </div>
    <!--=====================================
    CUERPO DEL MODAL
    ======================================-->
    <div class="modal-body">
      <div class="box-body">
        <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group"> 
              <label >Tipo trabajo</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                <select name="idtipotrabajo" id="idtipotrabajo" class="form-inline form-control">
                  <option value="-1">[Seleccione]</option>
                  @foreach($tipotrabajo as $tipo)
                    @if($tipo->condicion==true)
                      {{-- @foreach($carreras as $carrera)
                        @foreach($nombreetapa as $nombre)
                          @if($tipo->idcarrera == $carrera->idcarrera)
                            <option value="{{$tipo->idtipotema}}" >{{$tipo->tema}} - {{ $carrera->nombre }}</option>
                          @endif
                        @endforeach --}}
                        <option value="{{$tipo->idtipotema}}" >{{ $tipo->tema_carrera }}</option>
                    @endif
                  @endforeach
                </select>
              </div>  
            </div>


          {{--  <div class="form-group"> 
        <label>Nº Etapa</label>
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                <select name="idetapa" id="idetapa" class="form-inline form-control">
                            <option value="">[Seleccione]</option>
                            @foreach($etapa as $eta)
                            
                            <option value="{{$eta->idetapa}}" >{{$eta->etapanumero}}</option>
                           
                           @endforeach
                            </select>
                </div>  
        </div> --}}


        <div class="form-group"> 
        <label id="num_etapa" >Nombre Etapa </label>
          <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                <input type="text" name="idnombreetapa" id="idnombreetapa"  class="form-control">
                </div>  
        </div>


        <input type="hidden" name="idetapa" id="idetapa">

        <!-- ENTRADA PARA LA DIRRECCION -->

     

      </div>

    </div>

    <!--=====================================
    PIE DEL MODAL
    ======================================-->

    <div class="modal-footer">

      <button id="cancel1" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      <button id="cancel" class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Guardar</button>

    </div>

   

  </form>

</div>

</div>
{!!Form::close()!!}

</div>

<div class="row">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
   <div class="table-responsive">
<table class="table table-striped table-bordered table-condensed table-hover" id="nuevaetapa">
      <thead><!--fila-->
        <th hidden=""></th><!--celda-->
        <th>N°</th>
        <th>Carrera</th><!--celda-->
        <th>Tipo Trabajo</th><!--celda-->
        <th>Nº Etapa</th><!--celda-->
        <th>Nombre</th><!--celda-->
        <th>Estado</th><!--celda-->
        <th>Opciones</th><!--celda-->           
      </thead>
      <?php $cont=1; ?>
      @foreach($etapas as $nueva)
      <tr><!--fila simple-->
        <td><?php echo $cont; $cont++ ?></td>
        <td hidden="">{{ $nueva->idnuevaetapa}}</td><!--celda sencilla-->
        <td>{{ $nueva->nombre}}</td>
        <td>{{ $nueva->tema}}</td>
        <td>{{ $nueva->idetapa}}</td>
        <td>{{ $nueva->idnombreetapa}}</td>
        <td> @if($nueva->condicion==1) Activo 
         @else
         Inactivo
       @endif </td><!--celda sencilla-->
       <td> 
         <a href="#modal-edit" data-toggle="modal">
          <button class="btn btn-warning" onclick="editEtapa({{$nueva->idnuevaetapa}})"><i class="fa fa-pencil" aria-hidden="true"></i></button>
         <a href="#modal-show" data-toggle="modal">
          <button class="btn btn-success" onclick="showEtapa({{$nueva->idnuevaetapa}})"><i class="fa fa-eye" aria-hidden="true"></i></button>
        </a>
        @if($nueva->condicion) 
        <a href="" data-target="#modal-modalup" data-toggle="modal"><button class="btn btn-danger" onclick="chageStatusEtapa({{$nueva->idnuevaetapa}})"><i class="fa fa-caret-square-o-down"></i></button></a>
         @else
         <a href="" data-target="#modal-modalup" data-toggle="modal"><button class="btn btn-info" onclick="chageStatusEtapa({{$nueva->idnuevaetapa}})"><i class="fa fa-caret-square-o-up"></i></button></a>
         @endif 
      </td>
    </tr>
    @endforeach
  </table>
</div><!--div tabla responsiva-->



</div>
</div>

@include('ues.nuevaetapa.edit')
@include('ues.nuevaetapa.ver')
@include('ues.nuevaetapa.modalup')

@endsection
@section('script')

<!-- jQuery 2.1.4 -->
  
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
$('#nuevaetapa').DataTable({

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
$("#idtipotrabajo").change(function() {
              var tmpserv = $('#idtipotrabajo  option:selected').val();
              var num_etapa;
              //console.log(label_num_etapa);
              var url = "{{ route('ues.nuevaetapa.numetapas',':bar') }}";
              url = url.replace(':bar', tmpserv);
             // console.log(url); 
              var Data = {
              "_token": $('meta[name="csrf-token"]').attr('content'),
          }; 
          //console.log(Data);
              if(tmpserv > 0){
                $.ajax({
              type: 'POST',
              url: url,
              data: Data,
              dataType: 'json',
              success: function(data) {
                  //console.log(data);
                  
               document.getElementById('num_etapa').innerHTML = "Nombre Etapa #"+ data.num_etapa;
               document.getElementById('idetapa').value = data.num_etapa;
               //console.log(document.getElementById('idetapa').val());
              },
              error: function(data) {
                  console.log('Error:', data.responseText);
              }

          });
              } else {
                document.getElementById('num_etapa').innerHTML = "Nombre Etapa"
              }
          });
} );


   
</script>

<script>
  function editEtapa(idetapa) {
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var Data = {
    id:idetapa
  }
  var url = "{{ route('ues.nuevaetapa.edit',':bar') }}";
  url = url.replace(':bar', idetapa);
  $.ajax({
    type:'GET',
    url:url,
    data:Data,
    dataType:'json',
    success:function (data) {
      /*showAlert(data['notificacion'])
      removeNode(btn);*/
      data=data["etapa"];
      console.log(data);
      document.getElementById("id_etapa").value=data['idetapa'];
      document.getElementById('id_tipotrabajo').value=data['idtipotrabajo'];
      document.getElementById('nombreetapa').value=data['idnombreetapa'];
      url=document.FormEtapaEdit.action;
      url = url.replace(':bar', idetapa);
      document.FormEtapaEdit.action=url;
    },error:function (data) {
      console.log('Error:', data.responseText);
    }
  });
  }

  function showEtapa(idetapa) {
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var Data = {
    id:idetapa
  }
  var url = "{{ route('ues.nuevaetapa.show',':bar') }}";
  url = url.replace(':bar', idetapa);
  $.ajax({
    type:'GET',
    url:url,
    data:Data,
    dataType:'json',
    success:function (data) {
      /*showAlert(data['notificacion'])
      removeNode(btn);*/
      data=data["etapa"];
      document.getElementById('shownombreetapa').value=data['idnombreetapa'];
      document.getElementById("show-header").innerHTML='Etapa #'+data['idetapa'];
    },error:function (data) {
      console.log('Error:', data.responseText);
    }
  });
  }

  function chageStatusEtapa(idetapa) {
    $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var Data = {
    id:idetapa
  };
  var url = "{{ route('ues.nuevaetapa.show',':bar') }}";
  url = url.replace(':bar', idetapa);
  $.ajax({
    type:'GET',
    url:url,
    data:Data,
    dataType:'json',
    success:function (data) {
      /*showAlert(data['notificacion'])
      removeNode(btn);*/
      data=data["etapa"];
      console.log(data);
      var text= "";
      if(data["condicion"]){
        text = "Baja";
      }else{
        text = "Alta";
      }
      document.getElementById("modal-title").innerHTML='Dar de '+text+' Etapa';
      document.getElementById("modal-body").innerHTML='Confirme si desea Dar de '+ text+' la Etapa:<strong> '+ data['idnombreetapa']+'</strong>';
      url=document.Formstatus.action;
      url = url.replace(':bar', idetapa);
      document.Formstatus.action=url;
    },error:function (data) {
      console.log('Error:', data.responseText);
    }
  });
  }
</script>


@endsection