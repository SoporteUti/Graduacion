<div style="width: 20px;float: left;">
<img src="{{ public_path('img/minerva2.png') }}"  width="100px" height="110px"  ></img>
</div>

<h4 align="center">
<style type="text/css">
	p{
		font-size: small;
	}
	.table{
		font-size: small;
	}
html {
margin:2cm 2cm 2cm 2cm;
}
</style>
Universidad de El Salvador<br>
Facultad Multidisciplinaria Paracentral<br>
@foreach($grupo as $gru)
@if($gru->codigoG==$codigo)
@foreach($carrera as $c)
	@if($c->idcarrera == $gru->idcarrera)
			@foreach($departamento as $d)
			@if($d->iddepartamento ==$c->iddepartamento)
			Departamento de {{$d->nombre}}
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
   	@if($rlc->idrol==4)
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
    Director general de trabajos de grado
   @endif
   @endforeach
   @endif
   @endforeach

<br>Presente.</h></p>
<h >Reciba cordiales saludos y deseos de &eacute;xitos en sus labores diarias.</h>

<p align="justify"><h >
	@foreach($enunciado as $en)
	@if($en->idsolicitud==10 && $en->idrol==3)
	{{$en->enunciado}}
	@endif
	@endforeach, solicitamos  que interponga sus buenos oficios ante la Junta Directiva de &eacute;sta Facultad para que sean <strong>Impugnados los Resultados</strong> obtenidos en el  Trabajo de Grado.</h></p>

@foreach($grupo as $gru)
 @if($gru->codigoG==$codigo)
  <p align="justify"><h>C&oacute;digo: {{$gru->codigoG}}</h>	
 <?php    $idgrupo=$gru->idgrupo;   ?>
 @endif
@endforeach
<br>
<h>Tema:</h>
@foreach($grupo as $gru)
 @if($gru->codigoG==$codigo)
  <h >{{$gru->tema}}</h>	
 @endif
@endforeach
</p>
<h>Estudiantes:</h>
<table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
	<thead>
		<tr >
			<th width="5%">N°</th>
			<th width="40%">Nombre</th>
			<th width="20%">Carn&eacute;</th>	
		</tr>
	</thead>
	<tbody>
	<?php $cont=1; ?>
	@foreach($grupo as $gru)
	 @if($gru->codigoG==$codigo)
	  @foreach($estudianteg as $esg)
	   @if($esg->idgrupo==$gru->idgrupo)
		@foreach($estudiante as $est)
		 @if($est->idestudiante==$esg->idestudiante)
		  @foreach($personas as $per)
		   @if($per->idpersona==$est->idpersona)
		<tr>
			<td><?php echo $cont; $cont++ ?>  </td>
			<td>Br.{{$per->nombres}}{{" "}}{{$per->apellidos}}</td>
			<td>{{$est->carnet}}</td>			
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

<p align="justify"><h > Tribunal Evaluador:</h></p>
<table class="table table-hover" width="600px"  cellspading="2px" align="center" >
         <thead>
            <tr >
            	<th width="5%">N°</th>
            <th width="40%">Nombres</th>
            </tr>
         </thead>
         <tbody>
         <?php $cont=1; ?>
               @foreach ($dt as $d)
               	@foreach($gruposoli as $gs)
               @if($d->idgrupsol==$gs->idgrupsol && $gs->idgrupo==$idgrupo)
               <tr>
                  <td><?php echo $cont; $cont++ ?>  </td>
                  <td>{{$d->docente->titulo}} {{ $d->docente->persona->full_name}}</td>
               </tr>
               @endif
               @endforeach
         @endforeach
         </tbody>
   </table>
<br>
<p align="justify"><h >Se anexa la solicitud  presentada por los Bachilleres en donde expresan los motivos por los cuales estan inconformes con las calificaciones obtenidas.</h></p>
<h >Sin otro particular. Atentamente.</h>
<br>
<div class="panel panel-default">
	<div class="panel-body">
		
	</div>
	<div class="panel-footer">
		<h4 align="center" >"HACIA LA LIBERTAD POR LA CULTURA"</h4>
	</div>
</div>

<br>
	
<table class="table table-hover" width="600px">
	<thead>
		<tr>
			<th width="50%">

 </th>

<th width="50%">
	

</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="center">@foreach($rol_carrera as $rlc)
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
   <br>Coordinador General de Trabajos de Grado
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
			<?php  $iddepto=$d->iddepartamento;?>
			 <br >Departamento de {{$d->nombre}}
			@endif
			@endforeach
	@endif
@endforeach
@endif
@endforeach</td>
			<td align="center">
				@foreach($carrera as $c)
	@if($c->iddepartamento == $iddepto)
				@foreach($rol_carrera as $rlc)
   	@if($rlc->idrol==2 && $rlc->idcarrera==$c->idcarrera)
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
   <br>Jefe de Departamento 
   @endif
   @endforeach
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



</td>
		</tr>
		
	</tbody>
</table>


 