<div style="width: 20px;float: left;">
<img src="{{ public_path('img/minerva2.png') }}"  width="100px" height="110px"  ></img>
</div>
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
    Director general de trabajos de graduación
   @endif
   @endforeach
   @endif
   @endforeach

<br>Presente.</h></p>
<p align="justify"><h >Estimado/a<br>Reciba cordiales saludos y deseos de &eacute;xitos en sus labores diarias.</h></p>
<p align="justify">


<h >El motivo de la presente es notificarle que el grupo que se detalla no podr&aacute; completar la etapa en el tiempo correspondiente. Remito a usted los datos del grupo que solicita la pr&oacute;rroga  interna n&uacute;mero {{$numerosoli}} de la etapa {{$etapa}}  del   Proyecto  de Trabajo de Graduaci&oacute;n:</h>
</p>@foreach($grupo as $gru)
	@if($gru->codigoG==$codigo)
<p align="justify"><h>Código: {{$gru->codigoG}}</h></p>	
	@endif
	@endforeach

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
<p align="justify"><h>		Tema:</h>
			@foreach($grupo as $gru)
			@if($gru->codigoG==$codigo)
			<h >{{$gru->tema}}</h>	
			@endif
			@endforeach
</p>
 @foreach($proint as $pi)
	@if($gruposol->idgrupsol==$pi->idgrupsol)  
	<palign="justify">
	<h >La pr&oacute;rroga que solicitan es a partir de {{ \Carbon\Carbon::parse($pi->fechaInicio )->format('d-m-Y')}} hasta {{ \Carbon\Carbon::parse($pi->fechaFinal)->format('d-m-Y')}}.</h>
	</p>
	@endif
 @endforeach
<p align="justify"><h >Sin otro particular. Atentamente.</h></p>


<br>
<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
<br>
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
   @if($r->idrol==$rlc->idrol && $r->idrol==3)<br>
   Coordinador General de Trabajos de Graduación
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
   Jefe de Departamento
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
			 <br >Departamento de {{$d->nombre}}
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


