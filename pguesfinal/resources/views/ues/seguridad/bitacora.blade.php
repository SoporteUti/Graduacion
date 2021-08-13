@extends('plantillas.admin')
@section('contenido')

 <div class="col-md-12 " style="margin-top:0px;">
 <br/>

 


        <div class="panel" >
        <div class="panel-heading" style="background:#00a65a; color:white"> <strong><h4>Bitácora </h4></strong> </div>
       <table id="example" class="table table-striped table-bordered" >
        <thead>
            <tr>
                <th>No.</th>
               <!-- <th>Nombre</th>-->
                <th>Usuario</th>
                <th>Estado</th>
                <!--<th>rol</th> era tipo-->
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>

        <?php $cont=1; ?>
          @foreach($usuario as $u)

            <tr>
                <td><?php echo $cont; $cont++ ?>   </td>

                <td><?php echo $u->name; ?> </td>
                <td><?php if($u->condicion==1){ echo "Activo";}else{echo "Inactivo";} ?> </td>
             
                <td>

                
         <button type="button" class="btn "  onclick="location.href='<?php  echo url('/bitacRep/'.$u->id); ?>'"><img src="{{URL::asset('img/historial.png')}}" style="width:20%" width="15%"></img> Ver historial</button>
                
                </td>

              </tr>
          

       @endforeach 
        </tbody>
        </table>
        <div class="panel-footer " style="background-color: #00a65a;">
            <center>
            
        <button type="button" onclick="location.href = '<?php  echo url('/');?>'" style="width:20%" class="btn btn-danger " id="btnSalir" name="btnSalir">Cerrar</button>
             </center>


            </div>
</div>
</div>
   



@section('script')

<script>

$(document).ready(function() {
    $('#example').DataTable({
        "order":[[1,"asc"]],
    "language":{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     " Mostrar _MENU_ registros ",
    "sZeroRecords":    " No se encontraron resultados ",
    "sEmptyTable":     " Ningún dato disponible en esta tabla ",
    "sInfo":           " Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros ",
    "sInfoEmpty":      " Mostrando registros del 0 al 0 de un total de 0 registros ",
    "sInfoFiltered":   " (filtrado de un total de _MAX_ registros) ",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar: ", 
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    " Primero ",
        "sLast":     " Último ",
        "sNext":     " Siguiente ",
        "sPrevious": " Anterior "
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


