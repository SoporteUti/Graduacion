<h4 align="center">
Universidad de El Salvador<br>
Facultad Multidisciplinaria Paracentral<br>
Departamento de Informática<br>
Coordinación General de Trabajos de Graduación
</h4>
<h5 align="right">
San Vicente, <?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?></h5>
<p>
<h align="">Ing. MSc. Jossué Humberto Henriquez Garcia<br>Coordinador General de Trabajos de Graduación
<br>Departamento de Informatica<br>Presente</h></p>
<p>
<h align="">Estimado Ing.Henriquez<br>Reciban cordiales saludos y deseos de éxitos en sus labores.</h></p>
<p align="justify">
<h >Por medio de la presente le comunicamos no hemos podido completar la etapa I debido a: {{$motivo}}</h>
</p>@foreach($grupo as $gru)
	@if($gru->codigoG==$codigo)
<p><h align="">Trabajo de Graduación desarrollado por el grupo N°:{{$gru->codigoG}}:</h></p>	
	@endif
	@endforeach

	<table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
		<thead>
			<tr >
				<th width="5%">N°</th>
				<th width="40%">Nombre</th>
				<th width="20%">Carné</th>
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
<p>
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
<p><h>		Tema:</h>
			@foreach($grupo as $gru)
			@if($gru->codigoG==$codigo)
			<h >{{$gru->tema}}</h>	
			@endif
			@endforeach
</p>
<p>
<h >Por lo que solicitamos prórroga por un mes a partir desde {{$fechai}} hasta {{$fechaf}}</h></p>
<p>
<h >Sin otro particular. Atentamente.</h></p>
<p><h >Bachilleres:</h></p>
	<table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
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
<br>
<p><h > Docente/es Asesor/es:</h></p>
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
					<td>{{$per->nombres}}{{" "}}{{$per->apellidos}}</td>
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