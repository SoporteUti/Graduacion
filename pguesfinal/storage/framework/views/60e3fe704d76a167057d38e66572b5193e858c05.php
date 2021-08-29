<?php foreach($enunciado as $en): ?>
    <?php if($en->idsolicitud == 1 && $en->idrol == 3): ?>

        <head>
            <meta charset="utf-8" />
        </head>
        <div style="width: 20px;float: left;">
            <img src="<?php echo e(public_path('img/minerva2.png')); ?>" width="100px" height="110px"></img>
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

            <?php foreach($grupo as $gru): ?>
                <?php if($gru->codigoG == $codigo): ?>
                    <?php foreach($carrera as $c): ?>
                        <?php if($c->idcarrera == $gru->idcarrera): ?>
                            <?php foreach($departamento as $d): ?>
                                <?php if($d->iddepartamento == $c->iddepartamento): ?>
							<!--PARA EL NOMBRE DEL DEPARTAMENTO-->
                                    Departamento de <?php echo e($d->nombre); ?>

                                    <?php
                                    $idcarrera = $gru->idcarrera;
                                    $anio = $gru->fecharegistro;
                                    ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <br>

        </h4>
        <h5 align="right">
            <?php echo e($en->ciudad); ?>, <?php echo date('d'); ?> de <?php $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
echo $meses[idate('m') - 1]; ?> de <?php echo date('Y'); ?></h5>
        <!--aqui la parte donde se coloca el director en curso-->
		<p align="justify">

            <h>


                <?php $newformat = date('Y', strtotime($anio)); ?>



                <?php foreach($rol_carrera as $rlc): ?>
                    <?php if($rlc->idrol == 4): ?>
                        <?php foreach($docentes as $d): ?>
                            <?php if($d->iddocente == $rlc->iddocente): ?>
                                <?php foreach($personas as $p): ?>
                                    <?php if($p->idpersona == $d->idpersona): ?>
                                        <?php echo e($d->titulo); ?><?php echo e(' '); ?><?php echo e($p->nombres); ?><?php echo e(' '); ?><?php echo e($p->apellidos); ?>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php foreach($rol as $r): ?>
                            <?php if($r->idrol == $rlc->idrol && $r->idrol == 4): ?>
                                <br>
                                Director general de trabajos de graduaci&oacute;n
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>





                <br>Presente
            </h>
        </p>
		<!--hasta aqui donde se coloca el director en curso-->

		<!--SALUDO: Reciba cordiales saludos y deseos de éxitos en sus labores diarias-->
        <p align="justify">
            <h><br><?php echo e($en->saludo); ?></h>
        </p>
		<!--FIN DE SALUDO: Reciba cordi......-->
		<!--ENUNCIADO DE LOS ARTICULO-->
        <p align="justify">
            <h>
                <?php echo e($en->enunciado); ?>

            </h>
        </p>
		<!--ENUNCIADO DE LOS ARTICULOS-->

		<!--MODALIDAD A LA QUE APLICA-->
        <p align="justify">
            <h>
                <?php foreach($grupo as $gr): ?>
                    <?php if($gr->codigoG==$codigo): ?>
                        <?php foreach($tipotema as $mod): ?>
                            <?php if($gr->idtipotema==$mod->idtipotema): ?>
                            Modalidad: <?php echo e($mod->tema); ?>  
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
               
                <?php endforeach; ?>
              
            </h>
        </p>
		<!--FINDE DE LA MODALIDAD A LA QUE APLICA-->
        <?php foreach($grupo as $gru): ?>
            <?php if($gru->codigoG == $codigo): ?>
                <p align="justify">
                    <h><?php echo e($en->infogrupo); ?><?php echo e($gru->codigoG); ?>:</h>
                </p>
            <?php endif; ?>
        <?php endforeach; ?>




        <?php foreach($grupo as $gru): ?>
            <?php if($gru->codigoG == $codigo): ?>
                <?php 
                //aqui extraen informacion del grupo entonces obtendre la institucion aqui
                //porque estan en la misma tabla
                $tema       = $gru->tema;
                $idgrupo    = $gru->idgrupo;
                $institucion = $gru->institucion;
                ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <table id="tabla" class="table table-hover" width="600px" cellspacing="5px" align="center">
            <thead>
                <tr>

                    <th width="25%">Nombre</th>
                    <th width="10%">Carn&eacute;</th>


                </tr>

            </thead>
            <?php $rs = 0; ?>
            <?php foreach($grupo as $gru): ?>
                <?php if($gru->codigoG == $codigo): ?>
                    <?php foreach($estudianteg as $esg): ?>
                        <?php if($esg->idgrupo == $gru->idgrupo): ?>
                            <?php foreach($estudiante as $est): ?>
                                <?php if($est->idestudiante == $esg->idestudiante): ?>
                                    <?php foreach($personas as $per): ?>
                                        <?php if($per->idpersona == $est->idpersona): ?>
                                            <?php $rs++; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>



            <tbody>
                <?php $t = 0; ?>
                <?php foreach($grupo as $gru): ?>
                    <?php if($gru->codigoG == $codigo): ?>
                        <?php foreach($estudianteg as $esg): ?>
                            <?php if($esg->idgrupo == $gru->idgrupo): ?>
                                <?php foreach($estudiante as $est): ?>
                                    <?php if($est->idestudiante == $esg->idestudiante): ?>
                                        <?php foreach($personas as $per): ?>
                                            <?php if($per->idpersona == $est->idpersona): ?>
                                                <tr>

                                                    <td>Br.<?php echo e($per->nombres); ?><?php echo e(' '); ?><?php echo e($per->apellidos); ?>

                                                    </td>
                                                    <td><?php echo e($est->carnet); ?></td>
                                                    <?php if($t == 0): ?>

                                                        <?php $t++; ?>
                                                    <?php endif; ?>

                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
<!--fin de mostrar a los alumnos-->
<!--muestra el tema-->
        <p align="justify">
            <h> Tema: <?php echo e($tema); ?></h>
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
                <?php foreach($asesores as $ase): ?>
                    <?php if($ase->idgrupo == $idgrupo): ?>
                        <?php foreach($docentes as $doc): ?>
                            <?php if($ase->iddocente == $doc->iddocente): ?>
                                <?php foreach($personas as $per): ?>
                                    <?php if($per->idpersona == $doc->idpersona): ?>

                                        <?php foreach($tipoasesor as $tias): ?>
                                            <?php if($tias->idtipoasesor == $ase->idtipoasesor): ?>

                                                <tr>
                                                    <td></td>
                                                    <td><?php echo e($doc->titulo); ?><?php echo e(' '); ?><?php echo e($per->nombres); ?><?php echo e(' '); ?><?php echo e($per->apellidos); ?><?php echo e(' - '); ?><?php echo e($tias->tipoasesor); ?>

                                                    </td>
                                                    <td></td>

                                                </tr>

                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
<!--fin de mostrar docentes asesores-->

<!--Inicio de mostrar institucion-->
<p align="justify">
    <h>institución: <?php echo e($institucion); ?></h>
</p>
<!--fin de mostrar el nombre de la institucion-->

<!--informacion adicional-->
        <p align="justify">
            <h><?php echo e($en->infoad); ?></h>
        </p>
<!--fin de informacion adicional-->

        <p align="justify">
            <h><?php echo e($en->despedida); ?></h>
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
   <?php foreach($grupo as $gru): ?>
   <?php if($gru->codigoG == $codigo): ?>
   <?php foreach($estudianteg as $esg): ?>
   <?php if($esg->idgrupo == $gru->idgrupo): ?>
   <?php foreach($estudiante as $est): ?>
   <?php if($est->idestudiante == $esg->idestudiante): ?>
   <?php foreach($personas as $per): ?>
   <?php if($per->idpersona == $est->idpersona): ?>
    <tr>
     <td><?php echo e($per->nombres); ?><?php echo e(' '); ?><?php echo e($per->apellidos); ?></td>
      <td><?php echo e($est->carnet); ?></td>
      <td>F.______________</td>			
    </tr>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?>
    <?php endif; ?>
    <?php endforeach; ?>
   </tbody>
 </table>
<br> -->


        <div class="panel panel-default">
            <div class="panel-body">

            </div>
            <div class="panel-footer">
                <h4 align="center"><?php echo e($en->frase); ?></h4>
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
                        <?php foreach($rol_carrera as $rlc): ?>
                            <?php if($rlc->idrol == 3 && $rlc->anio == $newformat && $rlc->idcarrera == $idcarrera): ?>
                                <?php foreach($docentes as $d): ?>
                                    <?php if($d->iddocente == $rlc->iddocente): ?>
                                        <?php foreach($personas as $p): ?>
                                            <?php if($p->idpersona == $d->idpersona): ?>
                                                <?php echo e($d->titulo); ?><?php echo e(' '); ?><?php echo e($p->nombres); ?><?php echo e(' '); ?><?php echo e($p->apellidos); ?>

                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <?php foreach($rol as $r): ?>
                                    <?php if($r->idrol == $rlc->idrol && $r->idrol == 3): ?>
                                        <br> Coordinador general de trabajos de graduaci&oacute;n
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        <?php foreach($grupo as $gru): ?>
                            <?php if($gru->codigoG == $codigo): ?>
                                <?php foreach($carrera as $c): ?>
                                    <?php if($c->idcarrera == $gru->idcarrera): ?>
                                        <?php foreach($departamento as $d): ?>
                                            <?php if($d->iddepartamento == $c->iddepartamento): ?>
                                                <?php $iddepto = $d->iddepartamento; ?>
                                                <br>Departamento de <?php echo e($d->nombre); ?>

                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                    <td align="center">
                        <?php foreach($carrera as $c): ?>
                            <?php if($c->iddepartamento == $iddepto): ?>
                                <?php foreach($rol_carrera as $rlc): ?>
                                    <?php if($rlc->idrol == 2 && $rlc->idcarrera == $c->idcarrera): ?>
                                        <?php foreach($docentes as $d): ?>
                                            <?php if($d->iddocente == $rlc->iddocente): ?>
                                                <?php foreach($personas as $p): ?>
                                                    <?php if($p->idpersona == $d->idpersona): ?>
                                                        <?php echo e($d->titulo); ?><?php echo e(' '); ?><?php echo e($p->nombres); ?><?php echo e(' '); ?><?php echo e($p->apellidos); ?>

                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                        <?php foreach($rol as $r): ?>
                                            <?php if($r->idrol == $rlc->idrol && $r->idrol == 2): ?>
                                                <br>Jefe de departamento
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <?php foreach($grupo as $gru): ?>
                            <?php if($gru->codigoG == $codigo): ?>
                                <?php foreach($carrera as $c): ?>
                                    <?php if($c->idcarrera == $gru->idcarrera): ?>
                                        <?php foreach($departamento as $d): ?>
                                            <?php if($d->iddepartamento == $c->iddepartamento): ?>
                                                <br>Departamento de <?php echo e($d->nombre); ?>

                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>



                    </td>
                </tr>

            </tbody>
        </table>


    <?php endif; ?>
<?php endforeach; ?>
