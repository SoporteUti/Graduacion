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
      @if($d->iddepartamento ==$c->iddepartamento)
      
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
  
  


   <br>Honorables Miembros de Junta Directiva
  

  


<br>Presente.</h></p>
<p align="justify"><h >Reciban cordiales saludos y deseos de &eacute;xitos en sus labores diarias.</h></p>
<p align="justify">


  @foreach($grupo as $gru)
@if($gru->codigoG==$codigo)
@foreach($carrera as $c)
  @if($c->idcarrera == $gru->idcarrera)
      @foreach($departamento as $d)
      @if($d->iddepartamento ==$c->iddepartamento)
      <?php
      $depto=$d->nombre;
      $iddepto=$d->iddepartamento;
      $anio=$gru->fecharegistro;
      ?>
      @endif
      @endforeach
  @endif
@endforeach
@endif
@endforeach
@foreach($rol_carrera as $rlc)
    @if($rlc->idrol==3 && $rlc->anio == $newformat && $rlc->idcarrera==$idcarrera)
   @foreach($docentes as $d)
        @if($d->iddocente==$rlc->iddocente)
          @foreach($personas as $p)
          @if($p->idpersona==$d->idpersona)
        <?php   $coor = $p->nombres." ".$p->apellidos; ?> 
          @endif
          @endforeach
        @endif
   @endforeach
  
   @endif
   @endforeach

   

@foreach($carrera as $c)
  @if($c->iddepartamento == $iddepto)
@foreach($rol_carrera as $rlc)
    @if($rlc->idrol==2  && $rlc->idcarrera==$c->idcarrera)
   @foreach($docentes as $d)
        @if($d->iddocente==$rlc->iddocente)
          @foreach($personas as $p)
          @if($p->idpersona==$d->idpersona)
        <?php   $jefe = $d->titulo."".$p->nombres." ".$p->apellidos; ?> 
          @endif
          @endforeach
        @endif
   @endforeach
  

   @endif
   @endforeach
   @endif
   @endforeach

<h >En atenci&oacute;n a la solicitud presentada por el/la @foreach($rol_carrera as $rlc)
 @if($rlc->idrol==3 && $rlc->anio == $newformat && $rlc->idcarrera==$idcarrera)
  @foreach($docentes as $d)
   @if($d->iddocente==$rlc->iddocente)
  @foreach($personas as $p)
   @if($p->idpersona==$d->idpersona)
      {{$d->titulo}}{{" "}}{{$p->nombres}}{{" "}}{{$p->apellidos}}, 
   @endif
  @endforeach
   @endif
  @endforeach
 @foreach($rol as $r)
 @if($r->idrol==$rlc->idrol && $r->idrol==3)
   Coordinador general de trabajos de grado
@endif
@endforeach
@endif
@endforeach
del Departamento de {{$depto}} y con el Visto Bueno del/la Jefe del Departamento de {{$depto}}, {{$jefe}}. Tengo a bien solicitarles muy respetuosamente se tramite la modificaci&oacute;n del tema del Trabajo de Grado que se detalla a continuaci&oacute;n: </h>

<p align="justify"><h></h>
      @foreach($grupo as $gru)
      @if($gru->codigoG==$codigo)
      <h >Tema: {{$gru->tema}}</h>  
      @endif
      @endforeach
</p>
<h >Propuesta de Tema que se pide aprobar con la modificaci&oacute;n : <strong>{{$nuevotema}}</strong> </h>
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
  <br>
<h>Anexo la correspondencia relacionada a la solicitud enviada por el/la Coordinador General de Trabajos de Grado del Departamento de {{$depto}} con el respectivo visto bueno del/la Jefe de Departamento</h>



<p align="justify"><h >Sin otro particular. Atentamente.</h></p>

<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>

<div style="width: 500px;float: left;">
      @foreach($rol_carrera as $rlc)
    @if($rlc->idrol==4 )
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
   @if($r->idrol==$rlc->idrol)
   <br>{{$r->nombre}} DE PROCESOS DE GRADO
   @endif
   @endforeach
   @endif
   @endforeach
</div>

<br>
<br>
<br>

