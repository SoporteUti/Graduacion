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
{
margin:2cm 2cm 2cm 2cm;
}

</style>

<h4 align="center">
Universidad de El Salvador<br>
Facultad Multidisciplinaria Paracentral<br>

Dirección General de Trabajos de Graduación
<br>

</h4>
<h5 align="right">
San Vicente, <?php echo date('d');?> de <?php  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre" ); echo $meses[idate('m')-1]; ?> de <?php echo date('Y');?></h5>
<p align="justify">

<h>
   
   
   <?php    $newformat = date('Y',strtotime($grupo->fecharegistro));   ?>
   
   


   <br>Honorables miembros de Junta Directiva
  

  
   


<br>Presente.</h></p>
<p align="justify"><h ><br>Reciban cordiales saludos y deseos de éxitos en sus labores diarias.</h></p>
<p align="justify">


<h >@foreach($enunciado as $en)
  @if($en->idsolicitud==4 && $en->idrol==4)
  {{$en->enunciado}}
  @endif
  @endforeach, le solicito interpongan sus buenos oficios para <STRONG>la Ratificación del Tribunal Calificador</STRONG>  para el  Trabajo de Graduación siguiente:</h>

<p align="justify"><h></h>
         

         Código: {{$grupo->codigoG}}<br>
         <br><h >Tema:{{$grupo->tema}}</h>   
         
</p>


<p align="justify"><h >Bachilleres:</h></p>
   <table class="table table-hover" width="600px"  cellspading="2px" align="center" >
         <thead>
            <tr >
               <th width="5%">N°</th>
            <th width="40%">Nombre</th>
            <th width="20%">Carné</th>
            </tr>
         </thead>
         <tbody>
         <?php $cont=1; ?>
         
         @foreach($grupo->estudiantes_grupo as $per)
            <tr>
            <td><?php echo $cont; $cont++ ?>  </td>
            <td>Br.{{$per->estudiante->persona->full_name}}</td>
            <td>{{$per->estudiante->carnet}}</td>        
            </tr>
         
         @endforeach
         
         </tbody>
   </table> 

<p align="justify"><h >Tribunal Calificador</h></p>
   <table class="table table-hover" width="600px"  cellspading="2px" align="center" >
         <thead>
            <tr >
               <th width="5%">N°</th>
            <th width="40%">Nombre</th>
            </tr>
         </thead>
         <tbody>
         <?php $cont=1; ?>
               @foreach ($dt as $d)
               @if($d->idgrupsol==$gruposol->idgrupsol)
               <tr>
                  <td><?php echo $cont; $cont++ ?>  </td>
                  <td>{{$d->docente->titulo}}{{ $d->docente->persona->full_name}}</td>
               </tr>
               @endif
         @endforeach
         </tbody>
   </table>
<p align="justify"><h >Sin otro particular. Atentamente.</h></p>
<br>
<h4 align="center">"HACIA LA LIBERTAD POR LA CULTURA"</h4>

<br>
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
   <br>{{$r->nombre}} DE PROCESOS DE GRADUACIÓN
   @endif
   @endforeach
   @endif
   @endforeach
</div>

<br>
<br>
<br>
