<h4 align="center">
Universidad de El Salvador<br>
Facultad Multidisciplinaria Paracentral<br>
<style type="text/css">
	html {
margin:2cm 2cm 2cm 2cm;
}
</style>
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
<br>

</h4>
<h5 align="right">
San Vicente, <?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?></h5>
<p align="justify">

<h>
	
	
	<?php  $anio=$gru->fecharegistro;  $newformat = date('Y',strtotime($anio));   $idcarrera=$gru->idcarrera;?>
	
	

      @foreach($rol_carrera as $rlc)
      	@if($rlc->idrol==3 && $rlc->anio == $newformat && $rlc->idcarrera==$idcarrera)
      @foreach($docentes as $d)
   				@if($d->iddocente==$rlc->iddocente)
   					@foreach($personas as $p)
   					@if($p->idpersona==$d->idpersona)
   					{{$p->nombres}}{{" "}}{{$p->apellidos}}
   					@endif
   					@endforeach
   				@endif
      @endforeach
      @foreach($rol as $r)
      @if($r->idrol==$rlc->idrol && $r->idrol==3)
   <br>
    Director General de Trabajos de Graduación
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


<h >Por este medio, muy respetuosamente, solicito corrección en nombre de tema de trabajo de graduación:</h>

<p align="justify"><h>		Tema:</h>
			@foreach($grupo as $gru)
			@if($gru->codigoG==$codigo)
			<h >{{$gru->tema}}</h>	
			@endif
			@endforeach
</p>

</p>@foreach($grupo as $gru)
	@if($gru->codigoG==$codigo)
<p align="justify"><h>Trabajo de Graduación código: {{$gru->codigoG}}</h></p>	
	@endif
	@endforeach

	<table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
		<thead>
			<tr >
				<th width="5%">N°</th>
				<th width="40%">Nombre</th>
				<th width="20%">Carné</th>
				<th width="20%">Firma</th>
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
				<td>{{$per->nombres}}{{" "}}{{$per->apellidos}}</td>
				<td>{{$est->carnet}}</td>
				<td>_____________</td>			
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
<p align="justify">
<h>			Tipo de Proceso de graduación:</h>
			@foreach($grupo as $gru)
			@if($gru->codigoG==$codigo)
			@foreach($tipotema as $tp)
			@if($tp->idtipotema==$gru->idtipotema)
			<h >{{$tp->tema}}</h>	
			@endif
			@endforeach
			@endif
			@endforeach
</p>
<p align="justify"><h >Por lo que solicitamos prórroga por un mes a partir desde {{$fechai}} hasta {{$fechaf}}</h></p>
<p align="justify"><h >Sin otro particular. Atentamente.</h></p>
{{--<p align="justify"><h >Bachilleres:</h></p>
	<table class="table table-hover" width="600px"  cellspading="2px" align="center" >
			<thead>
				<tr >
					<th width="45%"></th>
					<th width="20%"></th>
					<th width="15%"></th>
				</tr>
			</thead>
			<tbody>
			@foreach($grupo as $gru)
			@if($gru->codigoG==$codigo)
			@foreach($estudianteg as $esg)
			@if($esg->idgrupo==$gru->idgrupo)
			@foreach($estudiante as $est)
			@if($est->idestudiante==$esg->idestudiante)
			@foreach($personas as $per)
			@if($per->idpersona==$est->idpersona)
				<tr>
					<td>{{$per->nombres}}{{" "}}{{$per->apellidos}}</td>
						<td>{{$est->carnet}}</td>
						<td>F.______________</td>			
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
<br>  --}}
<p align="justify"><h > Docente/es Asesor/es:</h></p>
	<table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
			<thead>
				<tr >
					<th width="45%"></th>
					<th width="20%"></th>
					<th width="15%"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($asesores as $ase)
                @if($ase->idgrupo==$gru->idgrupo)
                @foreach($docentes as $doc)
                @if($ase->iddocente==$doc->iddocente)
                @foreach($personas as $per)
                @if($per->idpersona==$doc->idpersona)
				<tr>
					<td>{{$doc->titulo}}{{" "}}{{$per->nombres}}{{" "}}{{$per->apellidos}}</td>
						<td></td>
						<td>F.______________</td>
							
				</tr> 
                @endif
                @endforeach
                @endif
                @endforeach
                @endif
                @endforeach
			</tbody>
	</table>
<br><br>
<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
<p>
	
</p>	