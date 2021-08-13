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
            <a class="navbar-brand" href="#">Control de Asesorías</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
             <ul class="nav navbar-nav ">
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Solicitudes <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      {{-- @foreach($Solicitudes as $sol)
                        <!-- numero de solicitud -->
                      <li><a href="#solicitud-{{$sol->idsolicitud}}" data-toggle="modal" data-target="#solicitud-{{$sol->idsolicitud}}">{{$sol->nombre}}</a></li>
                      @endforeach --}}

                    <li><a href="" data-target="#solicitud-2" data-toggle="modal">Prórroga interna</a></li>

                     <li><a href="" data-target="#solicitud-3" data-toggle="modal">Prórroga J.D</a></li>

                      <li><a href="" data-target="#solicitud-4" data-toggle="modal">Ratificación Tribunal Calificador</a></li>

                       <li><a href="#solicitud-6" data-target="#solicitud-6" data-toggle="modal">Modificación de Tema</a></li>

                        <li><a href="" data-target="#solicitud-7" data-toggle="modal">Notificación de Inasistencia</a></li>


                   
                    </ul>
                </li>
            </ul>
          
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"  data-target="#modas-sole" data-toggle="modal" >Control de Asesorías</a>


                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Actividades <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Aprobación del P.G.</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>


  {{-- <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3" >
            <div class="tab"> 
              <label>Código </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input id="codigoG" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"  value="{{$grupos->codigoG}}"  class="form-control" name="codigoG"  maxlength="11" autofocus>
                </div>          
            </div>
          </div>

          <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9" >
            <div class="tab"> 
              <label>Tipo de Proceso </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    @foreach($tiproceso as $tip)
                    @if($tip->idtipotema==$grupos->idtipotema)
                    <input id="tiproceso" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"  value="{{$tip->tema}}"  class="form-control" name="tiproceso"  maxlength="11" autofocus>
                    @endif
    @endforeach
                </div>          
            </div>
          </div>

          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="tab"> 
              <label>Tema </label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <textarea id="tema" readonly=""    value="{{$grupos->tema}}"  class="form-control" name="tema"  >{{$grupos->tema}}</textarea> 
                </div>          
            </div>
          </div> --}}
          
          
   




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






