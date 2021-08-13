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
    Director General de Trabajos de Graduación
   @endif
   @endforeach
   @endif
   @endforeach


<br>Presente.</h></p>
<p align="justify"><h >Estimado/a<br>Reciba cordiales saludos y deseos de &eacute;xitos en sus labores diarias.</h></p>
<p align="justify">


<h > @foreach($enunciado as $en)
	@if($en->idsolicitud==3 && $en->idrol==3)
	{{$en->enunciado}}
	@endif
	@endforeach, le solicitamos interponga sus buenos oficios para que la Junta Directiva de esta Facultad otorgue la  pr&oacute;rroga n&uacute;mero {{$numerosoli}} al Trabajo de Graduaci&oacute;n que se detalla a continuaci&oacute;n: </h>
</p>@foreach($grupo as $gru)
	@if($gru->codigoG==$codigo)
<p align="justify"><h>Trabajo de Graduaci&oacute;n código: {{$gru->codigoG}}</h></p>	
	@endif
	@endforeach

@foreach($grupo as $gru)
			@if($gru->codigoG==$codigo)
			 <?php $tema =$gru->tema;
			 		$idgrupo=$gru->idgrupo;
			 	?>
			@endif
			@endforeach
	<table class="table table-hover" width="600px"  cellspacing="5px" align="center" >
		<thead>
			<tr >
				
				<th width="35%">Nombre</th>
				<th width="10%">Carn&eacute;</th>
				
				
			</tr>
			
		</thead>
		<?php $rs =0;	?>
		@foreach($grupo as $gru)
			@if($gru->codigoG==$codigo)
			@foreach($estudianteg as $esg)
			@if($esg->idgrupo==$gru->idgrupo)
			@foreach($estudiante as $est)
			@if($est->idestudiante==$esg->idestudiante)
			@foreach($personas as $per)
			@if($per->idpersona==$est->idpersona)
		<?php $rs++;	?>	
			@endif
			@endforeach
			@endif
			@endforeach
			@endif
			@endforeach
			@endif
			@endforeach
				
				
			
		<tbody>
			<?php $t =0;	?>	
			@foreach($grupo as $gru)
			@if($gru->codigoG==$codigo)
			@foreach($estudianteg as $esg)
			@if($esg->idgrupo==$gru->idgrupo)
			@foreach($estudiante as $est)
			@if($est->idestudiante==$esg->idestudiante)
			@foreach($personas as $per)
			@if($per->idpersona==$est->idpersona)
				<tr>	
						
				<td>Br.{{$per->nombres}}{{" "}}{{$per->apellidos}}</td>
				<td>{{$est->carnet}}</td>
				@if($t==0)
				
				<?php $t++;	?>	
				@endif

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
		<p align="justify"><h > Tema: {{$tema}}</h>
<p align="justify"><h > Docente/es Asesor/es:</h>
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
				@foreach($asesores as $ase)
                @if($ase->idgrupo==$gru->idgrupo)
                @foreach($docentes as $doc)
                @if($ase->iddocente==$doc->iddocente)
                @foreach($personas as $per)
                @if($per->idpersona==$doc->idpersona)
				<tr>
					<td >{{$doc->titulo}}{{" 
						"}}{{$per->nombres}}{{" "}}{{$per->apellidos}}</td>
						
							
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
	</p>



<p align="justify"><h >Sin otro particular. Atentamente.</h>
	<br>

<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4></p>
<br>
<table class="table table-hover" width="600px">
	<thead>
		<tr>
			<th width="40%">

 </th>
 	<th width="15%">

 </th>

<th width="40%">
	

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
			<?php  $iddepto=$d->iddepartamento;?>
			 <br >Departamento de {{$d->nombre}}
			@endif
			@endforeach
	@endif
@endforeach
@endif
@endforeach</td>
<td align="center">                   </td>
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
	