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
	
	


   <br>Honorables miembros de Junta Directiva
  

<br>Presente.</h></p>
<p align="justify"><h ><br>Reciban cordiales saludos y deseos de &eacute;xitos en sus labores diarias.</h></p>
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


<?php    $newformat = date('Y',strtotime($anio));   ?>

@foreach($rol_carrera as $rlc)
   	@if($rlc->idrol==3 && $rlc->anio == $newformat && $rlc->idcarrera==$idcarrera)
   @foreach($docentes as $d)
				@if($d->iddocente==$rlc->iddocente)
					@foreach($personas as $p)
					@if($p->idpersona==$d->idpersona)
				<?php 	$coor = $p->nombres." ".$p->apellidos; ?> 
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
				<?php 	$jefe = $p->nombres." ".$p->apellidos; ?> 
					@endif
					@endforeach
				@endif
   @endforeach
  

   @endif
   @endforeach
   @endif
   @endforeach


<h >En atenci&oacute;n a la solicitud presentada por el Coordinador General de Trabajos de Grado del {{$depto}}, {{$coor}} y con el Visto Bueno del Jefe del {{$depto}}, {{$jefe}} y 
  @foreach($enunciado as $en)
  @if($en->idsolicitud==5 && $en->idrol==4)
  {{$en->enunciado}}
  @endif
  @endforeach, tengo a bien solicitarles muy respetuosamente la <strong>Ratificación de Resultados</strong> del trabajo de grado que se detalla a continuaci&oacute;n:</h>
</p>@foreach($grupo as $gru)
	@if($gru->codigoG==$codigo)
<p align="justify"><h>Trabajo de Grado código: {{$gru->codigoG}}</h></p>	
	@endif
	@endforeach
			@foreach($grupo as $gru)
			@if($gru->codigoG==$codigo)
			 <?php $tema =$gru->tema;	$tipotema=$gru->idtipotema; $idgrupo=$gru->idgrupo?>
			@endif
			@endforeach
<h>Tema: {{$tema}}</h>
<br>
<br>
<h>Los resultados son los siguientes</h>
<br>

<table class="table table-hover" cellspacing="10" border="0">
       <thead>
         <tr>
          <?php $cet=0; ?>
           <th  >Carn&eacute;</th>
           <th  >Nombre</th>
           @foreach($tiproceso as $tip)
    @if($tip->idtipotema==$tipotema)
    @foreach($etapas as $et)
    @if($et->idtipotrabajo==$tip->idtipotema) 
     @foreach($porcentaje as $pr)
     @if($pr->idetapa==$et->idnuevaetapa && $et->condicion==true)
   <th>Etapa {{$et->idetapa}} <br> ({{$pr->porcentaje}}%)</th>
    <?php $cet++; ?>
    @endif
    @endforeach
    @endif
    @endforeach
    @endif
    @endforeach 
<th>Promedio <br> Final</th>


         </tr>
       </thead>
       <tbody>  @foreach($mostraintegrante as $mint)
                @if($mint->idgrupo==$idgrupo)
                @foreach($estudiantes as $est)
                @if($mint->idestudiante==$est->idestudiante)
                @foreach($personas as $per)
                @if($per->idpersona == $est->idpersona)
         <tr>
           
               <td>{{$est->carnet}}</td> <td>Br.{{$per->nombres." ".$per->apellidos}}</td>
@for ($j = 1; $j <=$cet; $j++)
<td>
@foreach($notas as $not)
@if($not->idestudiante==$est->idestudiante && $not->idetapa==$j && $not->idgrupo==$idgrupo)

 {{$not->nota }}
 
@endif
@endforeach
</td>
@endfor



<?php $prom=0; ?>
       @foreach($tiproceso as $tip)
    @if($tip->idtipotema==$tipotema)
    @foreach($etapas as $et)
    @if($et->idtipotrabajo==$tip->idtipotema) 
     @foreach($porcentaje as $pr)
     @if($pr->idetapa==$et->idnuevaetapa)
   
@foreach($notas as $not)
@if($not->idestudiante==$est->idestudiante &&  $not->idetapa==$et->idetapa && $not->idgrupo==$idgrupo)


<?php $prom=$prom+$not->nota*($pr->porcentaje/100); ?>

@endif
@endforeach

    @endif
    @endforeach
    @endif
    @endforeach
    @endif
    @endforeach 

<td ><strong><?php echo round($prom,1);?></strong></td>

         </tr> @endif
                @endforeach
                @endif
                @endforeach
                @endif
                @endforeach 
           
       </tbody>
     </table>
<br>
<h> <strong>
<?php
if($gs1){
switch ($gs1->idsolicitud) {

case 1:
echo "Acuerdo de Aprobaci&oacute;n de Modalidad: ".$gs1->nacuerdo;
break;
	case 3:
	echo "Acuerdo de Pr&oacute;rroga a Junta Directiva: ".$gs1->nacuerdo;
break;
case 4:
echo "Acuerdo de Ratificaci&oacute;n del Tribunal Calificador: ".$gs1->nacuerdo;
break;
case 5:
echo "Acuerdo de Ratificaci&oacute;n de los Resultados: ".$gs1->nacuerdo;
break;
case 6:
echo "Acuerdo de Modificaci&oacute;n del Tema: ".$gs1->nacuerdo;
break;

           case 8:
echo "Acuerdo de Reprobaci&oacute;n por abandono: ".$gs1->nacuerdo;
           break;

case 9:
echo "Acuerdo de Renuncia al Proceso de Grado: ".$gs1->nacuerdo;
break;
        }
}
?>
</strong></h>

<p align="justify"><h >Se anexa la correspondencia relacionada a los acuerdos mencionados y la solicitud del  {{$depto}}</h></p>
<p align="justify"><h >Sin otro particular. Atentamente.</h></p>

<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>
{{--quite un br--}}
<div><h align="center"> 
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
</h></div>

<br>



