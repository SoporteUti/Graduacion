<div style="width: 20px;float: left;">
<img src="{{ public_path('img/minerva2.png') }}"  width="100px" height="110px"  ></img>
</div>
<style type="text/css">
	html {
margin:2cm 2cm 2cm 2cm;
}
</style>
<h4 align="center">
Universidad de El Salvador<br>
Facultad Multidisciplinaria Paracentral<br>
@foreach($grupo as $gru)
@if($gru->codigoG==$codigo)
@foreach($carrera as $c)
  @if($c->idcarrera == $gru->idcarrera)
      @foreach($departamento as $d)
      @if($d->iddepartamento == $c->iddepartamento)
      Departamento de {{$d->nombre}}
      <br>
Coordinación General de Trabajos de Graduación
<br>
<?php
      $idcarrera=$gru->idcarrera;
      $anio=$gru->fecharegistro;
      ?>
      @endif
      @endforeach
  @endif
@endforeach
@endif
@endforeach
<br>

</h4>
<h5 align="right">
San Vicente, <?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?></h5>
<p align="justify">

<h>
  
  
  <?php    $newformat = date('Y',strtotime($anio));   ?>
  
  


  
  
     @foreach($rol_carrera as $rlc)
    @if($rlc->idrol==3 && $rlc->anio == $newformat && $rlc->idcarrera==$idcarrera)
   @foreach($docentes as $d)
        @if($d->iddocente==$rlc->iddocente)
          @foreach($personas as $p)
          @if($p->idpersona==$d->idpersona)
          {{$d->titulo}}{{" "}}{{$p->nombres}}{{" "}}{{$p->apellidos}}
          @endif
          @endforeach
        @endif
   @endforeach
   @foreach($rol as $r)
   @if($r->idrol==$rlc->idrol && $r->idrol==3)
   <br>
    Coordinador General de Trabajos de Graduación
   @endif
   @endforeach
   @endif
   @endforeach

  
  
<br>
@foreach($grupo as $gru)
@if($gru->codigoG==$codigo)
@foreach($carrera as $c)
  @if($c->idcarrera == $gru->idcarrera)
      @foreach($departamento as $d)
      @if($d->iddepartamento ==$c->iddepartamento)
      {{$d->nombre}}
      @endif
      @endforeach
  @endif
@endforeach
@endif
@endforeach
<br>Presente</h></p>
<p align="justify"><h >Estimado/a<br>Reciba cordiales saludos y deseos de éxitos en sus labores diarias.</h></p>
<p align="justify">


<h >Por este medio, muy respetuosamente, le solicitamos interponga sus buenos oficios para que se otorgue una  <strong>corrección en el nombre</strong> del Trabajo de Graduación que se detalla a continuación:</h>


<p align="justify"><h></h>
      @foreach($grupo as $gru)
      @if($gru->codigoG==$codigo)
      <h >Tema: {{$gru->tema}}</h>  
      @endif
      @endforeach
</p>
<h >Propuesta de tema que se pide aprobar con la modificación : <strong>{{$nuevotema}}</strong> </h>
<br>
<br>
<h >Motivo: {{$motivo}}</h>
<br>
<br>
<p align="justify"><h > Docente/es Asesor/es:</h></p>
  @foreach($grupo as $gru)
      @if($gru->codigoG==$codigo)
       <?php $tema =$gru->tema;
          $idgrupo=$gru->idgrupo;
        ?>
      @endif
      @endforeach

   @foreach($asesores as $ase)
                @if($ase->idgrupo==$idgrupo)
                         @foreach($docentes as $doc)
                                 @if($ase->iddocente==$doc->iddocente)
                     @foreach($personas as $per)
                @if($per->idpersona==$doc->idpersona)
               
       
          {{$doc->titulo}}{{" "}}{{$per->nombres}}{{" "}}{{$per->apellidos}}
         <br>
              
  
                @endif
                @endforeach
                @endif
                @endforeach
                @endif
                @endforeach
 
  
 












  <br>
<h>Esperando una resolución favorable.</h>



<p align="justify"><h >Sin otro particular. Atentamente.</h></p>


<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>


<br>
<br>
<br>

