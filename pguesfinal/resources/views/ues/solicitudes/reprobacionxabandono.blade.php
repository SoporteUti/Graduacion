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
      Departamento de {{$d->nombre}}
      
<?php       $iddepto=$d->iddepartamento;
      $idcarrera=$gru->idcarrera;
      $anio=$gru->fecharegistro;
      ?>
      @endif
      @endforeach
  @endif
@endforeach
@endif
@endforeach
<br >

Coordinaci&oacute;n General de Trabajos de Graduaci&oacute;n
<br >
</h4>
<h5 align="right">
San Vicente, <?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?></h5>
<p align="justify">

<h>
  
  
  <?php    $newformat = date('Y',strtotime($anio));   ?>
  
  

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
   @if($r->idrol==$rlc->idrol && $r->idrol==4)
   <br>
    Director General de Trabajos de Graduaci&oacute;n
   @endif
   @endforeach
   @endif
   @endforeach

<br>Presente.</h></p>
<p align="justify"><h >Estimado/a<br>Reciba cordiales saludos y deseos de &eacute;xitos en sus labores diarias.</h></p>
<p align="justify">


<h >@foreach($enunciado as $en)
  @if($en->idsolicitud==8 &&$en->idrol==3)
  {{$en->enunciado}}
  @endif
  @endforeach, le solicitamos que se gestione ante la Junta Directiva la <strong>reprobaci&oacute;n</strong>  por abandono de parte del/la estudiante con carnet N°: {{$estudianteselec}} al Trabajo de Graduaci&oacute;n que se detalla a continuaci&oacute;n:</h>
<p align="justify">
         @foreach($grupo as $gru)
         @if($gru->codigoG==$codigo)
C&oacute;digo: {{$gru->codigoG}}
         <br>
         <h >Tema:{{$gru->tema}}</h>   
         @endif
         @endforeach 
</p>

</p>@foreach($grupo as $gru)
   @if($gru->codigoG==$codigo)
   
   @endif
   @endforeach

      <p align="justify"><h > Docente/es Asesor/es:</h></p>
   <table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
         <thead>
            <tr >
               <th width="45%"></th>
               <th width="20%"></th>
               <th width="25%"></th>
            </tr>
         </thead>
         <tbody>
            @foreach($asesores as $ase)
                @if($ase->idgrupo==$gru->idgrupo)
                @foreach($docentes as $doc)
                @if($ase->iddocente==$doc->iddocente)
                @foreach($personas as $per)
                @if($per->idpersona==$doc->idpersona)

                @foreach($tipoasesor as $tias)
                @if($tias->idtipoasesor==$ase->idtipoasesor)
            <tr>
               <td>{{$doc->titulo}}{{" "}}{{$per->nombres}}{{" "}}{{$per->apellidos}}{{" - "}}{{$tias->tipoasesor}}</td>
                  <td></td>
                  <td></td>
                     
            </tr> 
                @endif
                @endforeach


                @endif
                @endforeach
                @endif
                @endforeach
                @endif
                @endforeach
         </tbody>
   </table>
<br>


<br> 
<p align="justify">
<h>Dicha petici&oacute;n obedece a que el/la estudiante no se ha presentado a  las asesorias programadas en repetidas ocaciones  sin presentar ninguna justificaci&oacute;n</h>
<br>
<h >Sin otro particular. Atentamente.</h></p>

<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
<br> <br> <p>
<div style="width: 250px; float: left;"> 

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
   Coordinador General de Trabajos de Graduaci&oacute;n
@endif
@endforeach
@endif
@endforeach
@foreach($grupo as $gru)
 @if($gru->codigoG==$codigo)
  @foreach($carrera as $c)
   @if($c->idcarrera == $gru->idcarrera)
  @foreach($departamento as $d)
   @if($d->iddepartamento ==$c->iddepartamento)
    Departamento de {{$d->nombre}}
   @endif
  @endforeach
   @endif
  @endforeach
 @endif
@endforeach

</div>


<div style="width: 250px; float: right; "> 

  @foreach($rol_carrera as $rlc)
 @if($rlc->idrol==2 && $rlc->idcarrera==$idcarrera)
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
 @if($r->idrol==$rlc->idrol && $r->idrol==2)
   Jefe de Departamento
@endif
@endforeach
@endif
@endforeach
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
</div>
   
</p>  