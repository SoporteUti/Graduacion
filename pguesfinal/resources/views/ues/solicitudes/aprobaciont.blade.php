@foreach ($enunciado as $en)
    @if ($en->idsolicitud == 1 && $en->idrol == 3)

        <head>
            <meta charset="utf-8" />
        </head>
        <div style="width: 20px;float: left;">
            <img src="{{ public_path('img/minerva2.png') }}" width="100px" height="110px"></img>
        </div>

        <style type="text/css">
            p {
                font-size: small;
            }

            .table {
                font-size: small;
            }

            html {
                margin: 2cm 2cm 2cm 2cm;
            }

        </style>



        <h4 align="center">
            Universidad de El Salvador<br>
            Facultad Multidisciplinaria Paracentral <br>

            @foreach ($grupo as $gru)
                @if ($gru->codigoG == $codigo)
                    @foreach ($carrera as $c)
                        @if ($c->idcarrera == $gru->idcarrera)
                            @foreach ($departamento as $d)
                                @if ($d->iddepartamento == $c->iddepartamento)
							<!--PARA EL NOMBRE DEL DEPARTAMENTO-->
                                    Departamento de {{ $d->nombre }}
                                    <?php
                                    $idcarrera = $gru->idcarrera;
                                    $anio = $gru->fecharegistro;
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
            {{ $en->ciudad }}, <?php echo date('d'); ?> de <?php $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
echo $meses[idate('m') - 1]; ?> de <?php echo date('Y'); ?></h5>
        <!--aqui la parte donde se coloca el director en curso-->
		<p align="justify">

            <h>


                <?php $newformat = date('Y', strtotime($anio)); ?>



                @foreach ($rol_carrera as $rlc)
                    @if ($rlc->idrol == 4)
                        @foreach ($docentes as $d)
                            @if ($d->iddocente == $rlc->iddocente)
                                @foreach ($personas as $p)
                                    @if ($p->idpersona == $d->idpersona)
                                        {{ $d->titulo }}{{ ' ' }}{{ $p->nombres }}{{ ' ' }}{{ $p->apellidos }}
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        @foreach ($rol as $r)
                            @if ($r->idrol == $rlc->idrol && $r->idrol == 4)
                                <br>
                                Director general de trabajos de grado
                            @endif
                        @endforeach
                    @endif
                @endforeach





                <br>Presente
            </h>
        </p>
		<!--hasta aqui donde se coloca el director en curso-->

		<!--SALUDO: Reciba cordiales saludos y deseos de ??xitos en sus labores diarias-->
        <p align="justify">
            <h><br>{{ $en->saludo }}</h>
        </p>
		<!--FIN DE SALUDO: Reciba cordi......-->
		<!--ENUNCIADO DE LOS ARTICULO-->
        <p align="justify">
            <h>
                {{ $en->enunciado }}
            </h>
        </p>
		<!--ENUNCIADO DE LOS ARTICULOS-->

		<!--MODALIDAD A LA QUE APLICA-->
        <p align="justify">
            <h>
                @foreach ($grupo as $gr)
                    @if ($gr->codigoG==$codigo)
                        @foreach ($tipotema as $mod)
                            @if ($gr->idtipotema==$mod->idtipotema)
                            Modalidad: {{$mod->tema}}  
                            @endif
                        @endforeach
                    @endif
               
                @endforeach
              
            </h>
        </p>
		<!--FINDE DE LA MODALIDAD A LA QUE APLICA-->
        @foreach ($grupo as $gru)
            @if ($gru->codigoG == $codigo)
                <p align="justify">
                    <h>{{ $en->infogrupo }}{{ $gru->codigoG }}:</h>
                </p>
            @endif
        @endforeach




        @foreach ($grupo as $gru)
            @if ($gru->codigoG == $codigo)
                <?php 
                //aqui extraen informacion del grupo entonces obtendre la institucion aqui
                //porque estan en la misma tabla
                $tema       = $gru->tema;
                $idgrupo    = $gru->idgrupo;
                $institucion = $gru->institucion;
                ?>
            @endif
        @endforeach
        <table id="tabla" class="table table-hover" width="600px" cellspacing="5px" align="center">
            <thead>
                <tr>

                    <th width="25%">Nombre</th>
                    <th width="10%">Carn&eacute;</th>


                </tr>

            </thead>
            <?php $rs = 0; ?>
            @foreach ($grupo as $gru)
                @if ($gru->codigoG == $codigo)
                    @foreach ($estudianteg as $esg)
                        @if ($esg->idgrupo == $gru->idgrupo)
                            @foreach ($estudiante as $est)
                                @if ($est->idestudiante == $esg->idestudiante)
                                    @foreach ($personas as $per)
                                        @if ($per->idpersona == $est->idpersona)
                                            <?php $rs++; ?>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                @endif
            @endforeach



            <tbody>
                <?php $t = 0; ?>
                @foreach ($grupo as $gru)
                    @if ($gru->codigoG == $codigo)
                        @foreach ($estudianteg as $esg)
                            @if ($esg->idgrupo == $gru->idgrupo)
                                @foreach ($estudiante as $est)
                                    @if ($est->idestudiante == $esg->idestudiante)
                                        @foreach ($personas as $per)
                                            @if ($per->idpersona == $est->idpersona)
                                                <tr>

                                                    <td>Br.{{ $per->nombres }}{{ ' ' }}{{ $per->apellidos }}
                                                    </td>
                                                    <td>{{ $est->carnet }}</td>
                                                    @if ($t == 0)

                                                        <?php $t++; ?>
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
<!--fin de mostrar a los alumnos-->
<!--muestra el tema-->
        <p align="justify">
            <h> Tema: {{ $tema }}</h>
        </p>
<!--fin de mostrar el tema-->

<!--inicio para mostrar los docentes asesores-->
        <p align="justify">
            <h> Docente/es Asesor/es:</h>
        </p>
        <table class="table table-hover" width="1000px" cellspacing="5px" align="center">
            <thead>
                <tr>
                    <th width="10%"></th>
                    <th width="80%"></th>
                    <th width="10%"></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($asesores as $ase)
                    @if ($ase->idgrupo == $idgrupo)
                        @foreach ($docentes as $doc)
                            @if ($ase->iddocente == $doc->iddocente)
                                @foreach ($personas as $per)
                                    @if ($per->idpersona == $doc->idpersona)

                                        @foreach ($tipoasesor as $tias)
                                            @if ($tias->idtipoasesor == $ase->idtipoasesor)

                                                <tr>
                                                    <td></td>
                                                    <td>{{ $doc->titulo }}{{ ' ' }}{{ $per->nombres }}{{ ' ' }}{{ $per->apellidos }}{{ ' - ' }}{{ $tias->tipoasesor }}
                                                    </td>
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
<!--fin de mostrar docentes asesores-->

<!--Inicio de mostrar institucion-->
<p align="justify">
    <h>Instituci??n: {{ $institucion }}</h>
</p>
<!--fin de mostrar el nombre de la institucion-->

<!--informacion adicional-->
        <p align="justify">
            <h>{{ $en->infoad }}</h>
        </p>
<!--fin de informacion adicional-->

        <p align="justify">
            <h>{{ $en->despedida }}</h>
        </p>
        <!-- <p align="justify"><h >Bachilleres:</h></p>
 <table class="table table-hover" width="600px"  cellspading="2px" align="center" >
   <thead>
    <tr >
     <th width="45%"></th>
     <th width="20%"></th>
     <th width="15%"></th>
    </tr>
   </thead>
   <tbody>
   @foreach ($grupo as $gru)
   @if ($gru->codigoG == $codigo)
   @foreach ($estudianteg as $esg)
   @if ($esg->idgrupo == $gru->idgrupo)
   @foreach ($estudiante as $est)
   @if ($est->idestudiante == $esg->idestudiante)
   @foreach ($personas as $per)
   @if ($per->idpersona == $est->idpersona)
    <tr>
     <td>{{ $per->nombres }}{{ ' ' }}{{ $per->apellidos }}</td>
      <td>{{ $est->carnet }}</td>
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
<br> -->


        <div class="panel panel-default">
            <div class="panel-body">

            </div>
            <div class="panel-footer">
                <h4 align="center">{{ $en->frase }}</h4>
            </div>
        </div>

        <p>

        </p>
        <p>

        </p>
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
                    <td align="center">
                        @foreach ($rol_carrera as $rlc)
                            @if ($rlc->idrol == 3 && $rlc->anio == $newformat && $rlc->idcarrera == $idcarrera)
                                @foreach ($docentes as $d)
                                    @if ($d->iddocente == $rlc->iddocente)
                                        @foreach ($personas as $p)
                                            @if ($p->idpersona == $d->idpersona)
                                                {{ $d->titulo }}{{ ' ' }}{{ $p->nombres }}{{ ' ' }}{{ $p->apellidos }}
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                @foreach ($rol as $r)
                                    @if ($r->idrol == $rlc->idrol && $r->idrol == 3)
                                        <br> Coordinador general de trabajos de grado
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        @foreach ($grupo as $gru)
                            @if ($gru->codigoG == $codigo)
                                @foreach ($carrera as $c)
                                    @if ($c->idcarrera == $gru->idcarrera)
                                        @foreach ($departamento as $d)
                                            @if ($d->iddepartamento == $c->iddepartamento)
                                                <?php $iddepto = $d->iddepartamento; ?>
                                                <br>Departamento de {{ $d->nombre }}
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </td>
                    <td align="center">
                        @foreach ($carrera as $c)
                            @if ($c->iddepartamento == $iddepto)
                                @foreach ($rol_carrera as $rlc)
                                    @if ($rlc->idrol == 2 && $rlc->idcarrera == $c->idcarrera)
                                        @foreach ($docentes as $d)
                                            @if ($d->iddocente == $rlc->iddocente)
                                                @foreach ($personas as $p)
                                                    @if ($p->idpersona == $d->idpersona)
                                                        {{ $d->titulo }}{{ ' ' }}{{ $p->nombres }}{{ ' ' }}{{ $p->apellidos }}
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                        @foreach ($rol as $r)
                                            @if ($r->idrol == $rlc->idrol && $r->idrol == 2)
                                                <br>Jefe de departamento
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @foreach ($grupo as $gru)
                            @if ($gru->codigoG == $codigo)
                                @foreach ($carrera as $c)
                                    @if ($c->idcarrera == $gru->idcarrera)
                                        @foreach ($departamento as $d)
                                            @if ($d->iddepartamento == $c->iddepartamento)
                                                <br>Departamento de {{ $d->nombre }}
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


    @endif
@endforeach
