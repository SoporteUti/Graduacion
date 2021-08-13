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
			Departamento de {{$d->nombre}}
			@endif
			@endforeach
	@endif
@endforeach
@endif
@endforeach
<br>Presente.</h></p>
<p align="justify"><h >Estimado/a<br>Reciba cordiales saludos y deseos de &eacute;xitos en sus labores diarias.</h></p>
<p align="justify">




@foreach($ni as $ni)
                @if($ni->idgrupsol==$gruposol->idgrupsol)
                @foreach($estudiante as $est)
                @if($ni->idestudiante==$est->idestudiante)
                @foreach($personas as $per)
                @if($per->idpersona == $est->idpersona)

                <?php
			$carnet=$est->carnet;
			$nombre= $per->nombres." ".$per->apellidos;
			?>
        
                            
                @endif
                @endforeach
                @endif
                @endforeach
                @endif
            @endforeach 

    <?php
			if($numero=="PRIMERA") $veces=3;
			if($numero=="SEGUNDA") $veces=6;
			if($numero=="TERCERA") $veces=9;
			?>


<h >Por medio de la presente le comunico que el/la estudiante {{$nombre}} con Carnet N° {{$carnet}} no se ha presentado de manera consecutiva durante {{$veces}}
 sesiones de asesor&iacute;a que estaban Programadas. Luego de tres d&iacute;as h&aacute;biles no ha presentado ninguna justificante al respecto, por tanto, le hago
llegar la {{$numero}} notificación de inasistencia.</h>
</p>@foreach($grupo as $gru)
	@if($gru->codigoG==$codigo)
<p align="justify"><h>Código: {{$gru->codigoG}}</h></p>	
	@endif
	@endforeach

	
<p align="justify">
<h>			Tipo de Proceso de Graduaci&oacute;n:</h>
			@foreach($grupo as $gru)
			@if($gru->codigoG==$codigo)
			@foreach($tipotema as $tp)
			@if($tp->idtipotema==$gru->idtipotema)
			<h >{{$tp->tema}}</h>	
			@endif
			@endforeach
			@endif
			@endforeach
</p><p align="justify"><h>		Tema:</h>
			@foreach($grupo as $gru)
			@if($gru->codigoG==$codigo)
			<h >{{$gru->tema}}</h>	
			@endif
			@endforeach
</p>

<p align="justify"><h >Sin otro particular. Atentamente.</h></p>


<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
<br>
<br>
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
<br><br>

<p>
	
</p>	