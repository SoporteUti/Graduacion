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
      <a class="navbar-brand" href="#">Expediente de grupo</a>
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

                      {{--<li><a href="" data-target="#solicitud-4" data-toggle="modal">Ratificación Tribunal Calificador</a></li>--}}

                      <li><a href="#solicitud-6" data-target="#solicitud-6" data-toggle="modal">Modificación de Tema</a></li>

                      



                    </ul>
                  </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                 
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Actividades <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      
                      <li><a href="#" onclick="loadAlumns({{ $grupos->idgrupo }})" data-target="#modal-asistencia" data-toggle="modal">Control de asesorias</a></li>
                      
                    </ul>
                  </li>
                </ul>
              </div><!-- /.navbar-collapse -->
            </div>
          </nav>


          <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3" >
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
          </div>
          
          





          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="home" role="tabpanel">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">

                <?php $var=0; ?>
                @foreach($tiproceso as $tip)
                @if($tip->idtipotema==$grupos->idtipotema)
                @foreach($etapas as $et)
                @if($et->idtipotrabajo==$tip->idtipotema && $et->condicion==true) 
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#page-{{$et->idetapa}}"><strong>{{$et->idnombreetapa}}</strong></a>
                  <?php $var++; ?>
                </li>

                @endif
                @endforeach
                @endif
                @endforeach 
              </ul>




              <div class="tab-content">


                @for ($i = 1; $i <=$var; $i++)


                <div id="page-{{$i}}" class="tab-pane fade">
                  <div class="table-wrapper-scroll-y">
                   <table class="table table-bordered table-striped"  id="{{$et->idetapa}}">
                     <thead>
                       <tr>
                         <th>N°</th>
                         <th>
                         Actividades realizadas </th> 
                         <th>
                         Fecha</th>
                         <th>
                         Estado</th>
                         <th>Opciones</th><!--celda--> 
                       </tr>
                     </thead>
                     <tbody >
                           <?php $cont=0; ?>
                  @foreach($gsol as $gs)
                  @if($gs->idgrupo==$grupos->idgrupo && $gs->etapa==$i)
                   @foreach($Solicitudes as $sol)
                   @if($sol->idsolicitud==$gs->idsolicitud)
                  <tr>
                     
                   
                    <?php $cont++; ?>
                    <td hidden="" >{{$gs->idgrupsol}} </td>
                   <td>{{$cont}} </td>

                   <td >{{ $sol->nombre }}</td>
                   <td >{{ \Carbon\Carbon::parse($gs->fecha )->format('d-m-Y')  }} </td> 
                   @if($gs->condicion==false)
                <td >Cancelado </td> 
                                   @else
                    @if($gs->estado==0)
                  <td >Enviado a: Junta Directiva  </td> 
                  @else
                   @if($gs->estado==1)
                  <td >Aprobado </td>
                  @else
                  @if($gs->estado==7)
                  <td >Denegado </td>
                  @else
                  @foreach($roles as $rl)
                  @if($gs->estado==$rl->idrol)          
                  <td >Enviado a: {{ $rl->nombre }}  </td>
                   @endif
                  @endforeach
                   @endif
                    @endif
                    @endif
                    @endif

                        <td ><a href=""  data-target="#imprimirc-{{$sol->idsolicitud}}-{{$gs->idgrupsol}}" data-toggle="modal">
                          <button  class="btn btn-warning"><i class="fa fa-print"></i></button></a>

   

                   <a href=""   data-target="#verpdfs1-{{$gs->idgrupsol}}" data-toggle="modal">
                    <button   class="btn btn-success"><i  class=" fa fa-folder-open"></i></button></a>
               
@if($gs->estado==3)
<a href=""  data-target="#eliminars-{{$gs->idgrupsol}}" data-toggle="modal">
                          <button  class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
@endif
                        </td>

                      
                         
                          @include('ues.grupos.imprimir3asesor')
                          @include('ues.grupos.imprimir7asesor')
                          @include('ues.grupos.imprimir6asesor')
                          @include('ues.grupos.imprimir4asesor')
                          @include('ues.grupos.imprimirPIasesor')
                          @include('ues.grupos.eliminars')
                            @include('ues.grupos.verpdfs1')
                        </tr>@endif
                        @endforeach
                        @endif
                        @endforeach

                      </tbody>
                    </table>


                  </div>

                </div>  

                @endfor





              </div>

            </div>
          </div>

@include('ues.grupos.asistencia')
          <!-- tap pane para controlde asesorias-->



<!-- solicitudes: aprobacion de tema -->
<div class="modal fade" id="solicitud-1">
  {{Form::Open(array('action'=>array('solicitudController@aprovaciont'),'route'=>['ues.solicitudes.aprovaciont'], 'method'=>'post', 'files' =>'true'))}}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud de aprobación de tema</h4>
    </div>
    <div class="modal-body">

     <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
      <div class="form-group"> 
        <label>idsolicitud</label>
        <div class="input-group">                   
          <span class="input-group-addon"><i class="fa fa-info"></i></span>
          <input readonly="" type="text" value="1" name="idsolicitud" id="idsolicitud" class="form-control"  >
        </div>          
      </div>
    </div>
    <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
      <div class="form-group"> 
        <label>idgrupo</label>
        <div class="input-group">                   
          <span class="input-group-addon"><i class="fa fa-info"></i></span>
          <input readonly="" type="text" value="{{$grupos->idgrupo}}" name="idgrupo" id="idgrupo" class="form-control"  >
        </div>          
      </div>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
      <div class="form-group"> 
        <label>numero de etapas</label>
        <div class="input-group">                   
          <span class="input-group-addon"><i class="fa fa-info"></i></span>
          <input readonly="" type="text" value="{{$var}}" name="netapas" id="netapas" class="form-control"  >
        </div>          
      </div>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
      <div class="form-group"> 
        <label>Código de Grupo</label>
        <div class="input-group">                   
          <span class="input-group-addon"><i class="fa fa-info"></i></span>
          <input readonly="" type="text" value="{{$grupos->codigoG}}" name="codigo" id="codigo" class="form-control"  >
        </div>          
      </div>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
      <div class="form-group"> 
        <label>Tema</label>
        <div class="input-group">                   
          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
          <textarea id="tema" readonly=""    value="{{$grupos->tema}}"  class="form-control" name="tema"  >{{$grupos->tema}}</textarea>
        </div>          
      </div>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
      <div class="form-group"> 
        <label>Integrantes </label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-group"></i></span>
          @foreach($mostraintegrante as $mint)
          @if($mint->idgrupo==$grupos->idgrupo)
          @foreach($estudiantes as $est)
          @if($mint->idestudiante==$est->idestudiante)
          @foreach($personas as $per)
          @if($per->idpersona == $est->idpersona)
          <input disabled=""  type="text" class="form-control"    value="{{$est->carnet." ".$per->nombres." ".$per->apellidos}}">
          @endif
          @endforeach
          @endif
          @endforeach
          @endif
          @endforeach 
        </div>          
      </div>
    </div>  

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
      <div class="form-group"> 
        <label>Asesor/es </label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-user"></i></span>
          @foreach($asesores as $ase)
          @if($ase->idgrupo==$grupos->idgrupo)
          @foreach($docentes as $doc)
          @if($ase->iddocente==$doc->iddocente)
          @foreach($personas as $per)
          @if($per->idpersona==$doc->idpersona)
          @foreach($tipoasesor as $tias)
          @if($tias->idtipoasesor==$ase->idtipoasesor)
          <input disabled type="text" class="form-control"   value="{{$doc->titulo." ".$per->nombres." ".$per->apellidos." - ".$tias->tipoasesor}}">
          @endif
          @endforeach 
          @endif
          @endforeach
          @endif
          @endforeach
          @endif
          @endforeach 
        </div>          
      </div>
    </div> 


  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Generar</button>
  </div>
</div>
</div>
{{Form::Close()}}
</div>




<!-- solicitudes: Prorroga interna  -->
<div class="modal fade" id="solicitud-2">
  {{Form::Open(array('action'=>array('solicitudController@spsistemas'),'route'=>['ues.solicitudes.spsistemas'], 'method'=>'post', 'files' =>'true'))}}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud de Prórroga Interna</h4>
    </div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
     <div class="form-group"> 
      <div  class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-database"></i></span>
        <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="2" >
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

<div class="modal-body">
  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
    <div class="form-group"> 
      <label>Código de Grupo</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-info"></i></span>
        <input type="text" value="{{$grupos->codigoG}}" name="codigo" id="codigo" class="form-control"  >
      </div>          
    </div>
  </div>

  <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
    <div class="form-group"> 
      <label>numero de etapas</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-info"></i></span>
        <input readonly="" type="text" value="{{$var}}" name="netapas" id="netapas" class="form-control"  >
      </div>          
    </div>
  </div>
 

  <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
    <div class="form-group"> 
      <label>Fecha de Inicio</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        <input type="date" name="fechai" id="fechai" class="form-control" step="31" value="<?php echo date("Y-m-d");?>"  required="required" >
      </div>          
    </div>
  </div>
  <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
    <div class="form-group"> 
      <label>Fecha de Finalización</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
        <input type="date" name="fechaf" id="fechaf" class="form-control" step="1" value="<?php echo date("Y-m-d");?>"  required="required" >
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
   <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Fecha de registro </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
               
                
                    <input type="date" name="fechar" id="fechar" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required="required" title="">
                  </div>
                         
            </div>
        </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
  <button type="submit" class="btn btn-primary">Generar</button>
</div>
</div>
</div>
{{Form::Close()}}
</div>

<!-- solicitudes: Prorroga JD  -->

<div class="modal fade" id="solicitud-3">
  {{Form::Open(array('action'=>array('solicitudController@prorrogajd'),'route'=>['ues.solicitudes.prorrogajd'], 'method'=>'post', 'files' =>'true'))}}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Solicitud de Prórroga a Junta Directiva</h4>
    </div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
     <div class="form-group"> 
      <div  class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-database"></i></span>
        <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="3" >
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

<div class="modal-body">
  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
    <div class="form-group"> 
      <label>Código de Grupo</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-info"></i></span>
        <input type="text" value="{{$grupos->codigoG}}" name="codigo" id="codigo" class="form-control"  >
      </div>          
    </div>
  </div>

  <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
    <div class="form-group"> 
      <label>numero de etapas</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-info"></i></span>
        <input readonly="" type="text" value="{{$var}}" name="netapas" id="netapas" class="form-control"  >
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

  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Fecha de registro </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
               
                
                    <input type="date" name="fechar" id="fechar" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required="required" title="">
                  </div>
                         
            </div>
        </div>

</div>
<div class="modal-footer">
 <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
  <button type="submit" class="btn btn-primary">Generar</button>
</div>
</div>
</div>
{{Form::Close()}}
</div>

<!-- solicitudes: Ratificacion de resultados -->
<div class="modal fade" id="solicitud-5">
  {{Form::Open(array('action'=>array('solicitudController@ratiResul'),'route'=>['ues.solicitudes.ratiResul'], 'method'=>'post', 'files' =>'true'))}}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Ratificacion de Resultados</h4>
    </div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
     <div class="form-group"> 
      <div  class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-database"></i></span>
        <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="5" >
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

<div class="modal-body">
  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
    <div class="form-group"> 
      <label>Código de Grupo</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-info"></i></span>
        <input type="text" value="{{$grupos->codigoG}}" name="codigo" id="codigo" class="form-control"  >
      </div>          
    </div>
  </div>



</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
  <button type="submit" class="btn btn-primary">Generar</button>
</div>
</div>
</div>
{{Form::Close()}}
</div>
<!-- solicitudes: Repobacion por abandono -->
<div class="modal fade" id="solicitud-8">
  {{Form::Open(array('action'=>array('solicitudController@repabandono'),'route'=>['ues.solicitudes.repabandono'], 'method'=>'post', 'files' =>'true'))}}
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Repobación por Abandono</h4>
    </div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
     <div class="form-group"> 
      <div  class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-database"></i></span>
        <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="8" >
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

<div class="modal-body">
  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
    <div class="form-group"> 
      <label>Código de Grupo</label>
      <div class="input-group">                   
        <span class="input-group-addon"><i class="fa fa-info"></i></span>
        <input type="text" value="{{$grupos->codigoG}}" name="codigo" id="codigo" class="form-control"  >
      </div>          
    </div>
  </div>



</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> Cerrar</button>
  <button type="submit" class="btn btn-primary">Generar</button>
</div>
</div>
</div>
{{Form::Close()}}
</div>




{{-- cambio tema y tribunal--}}
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

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Fecha de registro </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
               
                
                    <input type="date" name="fechar" id="fechar" class="form-control" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required="required" title="">
                  </div>
                         
            </div>
        </div>

</div>
<div class="modal-footer">
  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
  <button type="submit" class="btn btn-primary">Generar</button>
</div>
</div>
</div>
{{Form::Close()}}
</div>

<div class="modal fade" id="solicitud-4">
  {{Form::Open(array('action'=>array('solicitudpicController@sRatificaciondeTribunal'),'route'=>['ues.solicitudesconta.sRatificaciondeTribunal'], 'method'=>'post', 'files' =>'true'))}} 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Ratificación de Tribunal Calificador</h4>
    </div>
    <div class="modal-body">

      <div hidden="" >
        <div class="form-group"> 
          <label>Código de Grupo</label>
          <div class="input-group">                   
            <span class="input-group-addon"><i class="fa fa-info"></i></span>

            <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="4" >
          </div>          
        </div>
      </div>

      <div hidden="" >
        <div class="form-group"> 
          <label>Código de Grupo</label>
          <div class="input-group">                   
            <span class="input-group-addon"><i class="fa fa-info"></i></span>

            <input id="idgrupo" type="text" class="form-control" name="idgrupo" value="{{$grupos->idgrupo}}" >
          </div>          
        </div>
      </div>


      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" > 
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
          <label>Asesores(*)</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-group"></i></span>
            <select data-placeholder="Seleccione docentes" multiple class="chosen-select form-control" name="docentes[]" id="docentes"  >
              <option value="-99">[Seleccione Docentes]</option>
              @foreach($personas as $per)
              @foreach($docentes as $docente)
              @if($per->idpersona == $docente->idpersona)
              @if($per->condicion==true)
              <option value="{{ $docente->iddocente }}">{{ $docente->titulo." ".$per->nombres." ".$per->apellidos}}</option>
              @endif
              @endif
              @endforeach
              @endforeach
            </select>
          </div>
        </div>
      </div>



    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Generar</button>
    </div>
  </div>
</div>
{{Form::Close()}} 
</div>


@endsection
@section('script')
<script type="text/javascript">
  $(document).ready(function () {
   $(".chosen-select").chosen({no_results_text: "Oops,no se encontraron resultados!",width: "100%"});     

   $('.loadAlumns').click(function(e) {
      console.log(e);
   });
   
    
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

           <script>
           
      function loadAlumns(idgrupo) {
              $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
              var list = $("#alumns-list");
              var url = "{{ route('grupo.integrantes',':bar') }}";
              url = url.replace(':bar', idgrupo);
              list.empty();
              $.ajax({
                type: 'GET',
                url: url,
                
                dataType: 'json',
                success: function (data) {
                  //console.log(data.alumnos);
                  for (var i =  0; i <data.alumnos.length; i++) {
                    var alumno = data.alumnos[i];
                    list.append(
                    '<tr>'+
                    '<td>'+
                    '<input type="hidden" name="estudiante['+i+'][idestudiante]" value="'+alumno["id"] +'">'
                    + alumno["nombre"]+
                    '</td><td><div class="btn-group">'+
                    '<input type="hidden" class="asistencia" name="estudiante['+i+'][asistencia]" value="0">'+
                    '<label>Asistio <input type="radio" name="radio'+i+'" onclick="asistencia(this)" value="1"></label>'+
                    '<label>No Asistio <input type="radio" name="radio'+i+'" checked="" onclick="asistencia(this)" value="0"></label>'+'</div></td></tr>'
                    );
                  }
                  

                },
                error: function (data) {
                 
                }
              });//fin
            }
            function asistencia(radio) {
              radio.parentNode.parentNode.getElementsByClassName("asistencia")[0].value =radio.value;
            }
          </script>

          


          @endsection






