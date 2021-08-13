@extends('plantillas.admin')
@section('contenido')


  <style type="text/css">
   .table-wrapper-scroll-y {
  display: block;
  max-height: 222px;
  overflow-y: auto;
  -ms-overflow-style: -ms-autohiding-scrollbar;
} 
  </style>
    
   <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Control de asesorías</a>
            <a href="" data-target="#modalasesoria" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-plus-square"></i></button></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
             <ul class="nav navbar-nav ">
                
                              </li>
            </ul>
          
        </div><!-- /.navbar-collapse -->
    </div>
</nav>

<div id="modalasesoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form id="asesoria" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
 

        <div class="modal-header" style="background:#00a65a; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Asesoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body" >

          <div class="box-body">

            <!-- ENTRADA PARA la fecha -->
           <div class="col-lg-12 col-md-12 col-xs-12 col-sm-6" > 
        <div class="form-group"> 
            <label>Fecha</label>   
            <div class="input-group">  
                <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                <input disabled="" type="date" class="form-control" id="fecha" name="fecha" step="1" value="<?php echo date("Y-m-d");?>" >
            </div>         
        </div>
    </div>



         <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
         <label>Hora inicio</label> 
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
        </div>

         <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
         <label>Hora final</label> 
            <div class="form-group">
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
        </div>
       


    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Integrantes </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                <select data-placeholder="Seleccione estudiantes" multiple class="chosen-select form-control" name="docentes[]" id="docentes"  >
                <option value="-99">[Seleccione Estudiantes]</option>
                @foreach($mostraintegrante as $mint)
                @if($mint->idgrupo==$grupos->idgrupo)
                @foreach($estudiantes as $est)
                @if($mint->idestudiante==$est->idestudiante)
                @foreach($personas as $per)
                @if($per->idpersona == $est->idpersona)
                <option value="{{ $est->idestudiante }}">{{$est->carnet." ".$per->nombres." ".$per->apellidos}}
                </option>>
                @endif
                @endforeach
                @endif
                @endforeach
                @endif
                @endforeach 
                </select>
                </div>          
            </div>
        </div>  




    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >           
        <div class="form-group"> 
            <label>Revisión</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                <textarea name="tema" id="revision" class="form-control rounded-0" rows=""  placeholder="Ingresar revison"></textarea>
            </div>          
        </div>
    </div>    

       
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


</div>
          
          <div class="modal fade" id="solicitud-6">
  {{Form::Open(array('action'=>array('solicitudpicController@spiconta'),'route'=>['ues.solicitudesconta.spiconta'], 'method'=>'post', 'files' =>'true'))}}
 <div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud de Cambio de Tema</h4>
    </div>
    <div class="modal-body">


 <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="6" >
            </div>          
        </div>
    </div> 

     <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idgrupo" type="text" class="form-control" name="idgrupo" value="{{$grupos->idgrupo}}" >
            </div>          
        </div>
    </div> 


   
      <div class="col-lg12 col-md-12 col-xs-12 col-sm-12" > 
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                   <input id="codigo" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"  value="{{$grupos->codigoG}}"  class="form-control" name="codigo"  maxlength="11" autofocus>
                </div>          
            </div>
            </div>


      
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Nuevo Tema</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <textarea  name="nuevotema"  cols="35" id="nuevotema" class="form-control" ></textarea>
                </div>          
            </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Motivo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <textarea  name="motivo"  cols="35" id="motivo" class="form-control" ></textarea>
                </div>          
            </div>
            </div>
          
    </div>
    <div class="modal-footer">
      <button  type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Generar</button>
    </div>
  </div>
</div>
{{Form::Close()}}
</div>
   




@section('script')





<script type="text/javascript">
    $(document).ready(function () {
         $(".chosen-select").chosen({no_results_text: "Oops,no se encontraron resultados!",width: "100%"});     

    });



    {{--  Sirve para limitar elemntos seleccionados
      $(".chosen-select").chosen("destroy")
        

        $('.chosen-select').chosen({ max_selected_options: 2,width: "100%"}); 
        $('.chosen-select').trigger("chosen:updated");   
   
  
      --}}
</script>

<script>
            $(function () {
                $('#datetimepicker1').datetimepicker({
                    format: 'LT'
                });
            });
            </script>
            <script>
            $(function () {
                $('#datetimepicker2').datetimepicker({
                    format: 'LT'
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


  @endsection


@endsection






