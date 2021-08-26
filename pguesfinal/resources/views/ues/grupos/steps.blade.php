@extends('plantillas.admin')
@section('contenido')
    @if (Auth::user()->idrol == 3 || Auth::user()->idrol == 1 || Auth::user()->idrol == 2)

        <style type="text/css">
            .table-wrapper-scroll-y {
                display: block;
                max-height: 222px;
                overflow-y: auto;
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }

        </style>

        <!-- One "tab" for each step in the form: -->
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Expediente de grupo</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav">
                        <ul class="nav navbar-nav ">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Solicitudes <b
                                        class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    @if ($consulta1 == 0)
                                        <li><a href="#solicitud-1" data-toggle="modal" data-target="#solicitud-1">Aprobación
                                                de Modalidad</a></li>
                                    @endif
                                    @foreach ($gsol as $gs)
                                        @foreach ($etapaactiva as $ea)
                                            @if ($ea->idgrupo == $grupos->idgrupo && $ea->idnuevaetapa == 3 && $ea->estado == 1 && $gs->idgrupo == $grupos->idgrupo && $gs->idsolicitud == 4 && $gs->estado != 1)

                                            @endif
                                        @endforeach
                                    @endforeach
                                    <li><a href="" data-target="#solicitud-4" data-toggle="modal">Ratificación Tribunal
                                            Calificador</a></li>
                                    <li><a href="#solicitud-5" data-toggle="modal" data-target="#solicitud-5">Ratificación
                                            de resultados</a></li>
                                    <li><a href="#solicitud-10" data-toggle="modal" data-target="#solicitud-10">Impugnación
                                            de resultados</a></li>
                                    <li><a href="#solicitud-9" data-toggle="modal" data-target="#solicitud-9">Renuncia al
                                            Proceso de Graduación</a></li>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acciones <b
                                        class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#cronograma" data-toggle="modal" data-target="#cronograma">Registro de
                                            Fechas</a></li>
                                    <li><a href="#" onclick="ventanaP('{{ $grupos->idgrupo }}')">Imprimir Expediente</a>
                                    </li>
                                    {{-- <li><a href="#" onclick="ventanaC('{{ $grupos->idgrupo}}')" >Imprimir Cronograma</a></li> --}}
                                </ul>
                            </li>
                        </ul>

                        <ul class="nav navbar-nav navbar-right">

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrar Notas <b
                                        class="caret"></b></a>
                                <ul class="dropdown-menu">

                                    @if ($consulta2 != 0)
                                        <li><a href="#notas" data-toggle="modal" data-target="#notas">Registro de Notas</a>
                                        </li>
                                    @endif
                                    <li><a href="#pdfnotas" data-toggle="modal" data-target="#pdfnotas">Imprimir Notas
                                            (Etapas)</a></li>

                                    <li><a href="#" onclick="ventanaN('{{ $grupos->idgrupo }}')">Imprimir Notas </a></li>


                                    <li><a href="#editarnotas" data-toggle="modal" onclick=""
                                            data-target="#editarnotas">Editar Notas</a></li>




                                </ul>
                            </li>

                        </ul>

                </div><!-- /.navbar-collapse -->


            </div>

        </nav>



        <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
            <div class="tab">
                <label>Código </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input id="codigoG" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();" type="text"
                        value="{{ $grupos->codigoG }}" class="form-control" name="codigoG" maxlength="11" autofocus>
                </div>
            </div>
        </div>

        <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9">
            <div class="tab">
                <label>Tipo de Proceso </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    @foreach ($tiproceso as $tip)
                        @if ($tip->idtipotema == $grupos->idtipotema)
                            <input id="tiproceso" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                type="text" value="{{ $tip->tema }}" class="form-control" name="tiproceso" maxlength="11"
                                autofocus>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="tab">
                <label>Tema </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <textarea id="tema" readonly="" value="{{ $grupos->tema }}" class="form-control"
                        name="tema">{{ $grupos->tema }}</textarea>
                </div>
            </div>
        </div>







        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane active" id="home" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">

                    <?php $var = 0; ?>
                    @foreach ($tiproceso as $tip)
                        @if ($tip->idtipotema == $grupos->idtipotema)
                            @foreach ($etapas as $et)
                                @if ($et->idtipotrabajo == $tip->idtipotema && $et->condicion == true)
                                    <li class="nav-item" id="$et->idetapa">

                                        <a o class="nav-link" data-toggle="tab"
                                            href="#page-{{ $et->idetapa }}"><strong>{{ $et->idnombreetapa }}</strong></a>
                                        <?php $var++; ?>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    <li class="nav-item" id="cronograma-tbl">
                        <a o class="nav-link" data-toggle="tab" href="#page-cronograma"><strong>Cronograma</strong></a>
                        <br />

                    </li>
                    </item>
                </ul>





                <div class="tab-content">

                    @for ($i = 1; $i <= $var; $i++)

                        <div id="page-{{ $i }}" class="tab-pane fade">
                            <div class="table-wrapper-scroll-y">
                                <table class="table table-bordered table-striped" id="{{ $et->idetapa }}">
                                    <thead>
                                        <tr>

                                            <th>N°</th>
                                            <th>
                                                Actividades realizadas</th>
                                            <th>
                                                Fecha</th>
                                            <th>
                                                Estado</th>
                                            <th>Opciones</th>
                                            <!--celda-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $cont = 0; ?>
                                        @foreach ($gsol as $gs)
                                            @if ($gs->idgrupo == $grupos->idgrupo && $gs->etapa == $i)
                                                @foreach ($Solicitudes as $sol)
                                                    @if ($sol->idsolicitud == $gs->idsolicitud)
                                                        <tr>
                                                            <?php $cont++; ?>
                                                            <td hidden="">{{ $gs->idgrupsol }} </td>
                                                            <td>{{ $cont }} </td>

                                                            <td>{{ $sol->nombre }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($gs->fecha)->format('d-m-Y') }}
                                                            </td>

                                                            @if ($gs->condicion == false)
                                                                <td>Cancelado </td>
                                                            @else
                                                                @if ($gs->estado == 0)
                                                                    <td>Enviado a: Junta Directiva </td>
                                                                @else
                                                                    @if ($gs->estado == 1)
                                                                        <td>Aprobado </td>
                                                                    @else
                                                                        @foreach ($roles as $rl)
                                                                            @if ($gs->estado == $rl->idrol)

                                                                                @if ($gs->estado == Auth::user()->idrol)
                                                                                    <td>Recibido de Asesor:
                                                                                        @foreach ($personas as $per)
                                                                                            @if ($gs->idpersona == $per->idpersona)
                                                                                                {{ $per->nombres }}
                                                                                                {{ $per->apellidos }}
                                                                                            @endif
                                                                                        @endforeach

                                                                                        ({{ $gs->fechaenv }})
                                                                                    </td>
                                                                                @else
                                                                                    <td>Enviado a: {{ $rl->nombre }}
                                                                                    </td>
                                                                                @endif


                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endif

                                                            @endif


                                                            <td><a data-backdrop="static" data-keyboard="false" href=""
                                                                    data-target="#imprimirc-{{ $sol->idsolicitud }}-{{ $gs->idgrupsol }}"
                                                                    data-toggle="modal">
                                                                    <button class="btn btn-warning"><i
                                                                            class="fa fa-print"></i></button></a>
                                                                @if ($gs->estado == 3 && $gs->condicion == true)
                                                                    <a href="" data-target="#cancelar-{{ $gs->idgrupsol }}"
                                                                        data-toggle="modal"> <button
                                                                            class="btn btn-danger"><i
                                                                                class="fa fa-ban"></i></button></a>
                                                                    @include('ues.grupos.cancelarsolicitud')





                                                                @endif

                                                                @if ($gs->condicion == false)
                                                                    <a href="" data-target="#motivo-{{ $gs->idgrupsol }}"
                                                                        data-toggle="modal"> <button
                                                                            class="btn btn-danger"><i class="fa fa-question-circle 
    "></i></button></a>



                                                                @endif
                                                                <a href="" data-target="#verpdfs-{{ $gs->idgrupsol }}"
                                                                    data-toggle="modal">
                                                                    <button class="btn btn-success"><i
                                                                            class=" fa fa-folder-open"></i></button></a>
                                                            </td>



                                                            @include('ues.grupos.motivo')
                                                            @include('ues.grupos.imprimir1cordinador')
                                                            @include('ues.grupos.imprimirRScordinador')
                                                            @include('ues.grupos.imprimirPIcordinador')
                                                            @include('ues.grupos.imprimir3coordinador')
                                                            @include('ues.grupos.imprimir6coordinador')
                                                            @include('ues.grupos.imprimir4coordinador')
                                                            @include('ues.grupos.imprimir7coordinador')
                                                            @include('ues.grupos.imprimir8coordinador')
                                                            @include('ues.grupos.imprimir9coordinador')
                                                            @include('ues.grupos.imprimir10coordinador')

                                                            @include('ues.grupos.verpdfs')
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                    </tbody>
                                </table>


                            </div>

                        </div>

                    @endfor


                    {{-- CRONOGRAMA --}}
                    <div id="page-cronograma" class="tab-pane fade">
                        <div class="table-wrapper-scroll">
                            {!! $gantt !!}


                        </div>

                    </div>
                    {{-- CRONOGRAMA --}}




                </div>

            </div>
        </div>
        </div>

        @include('ues.grupos.cronograma')



        <div class="modal fade" id="solicitud-5">
            {{ Form::Open(['action' => ['solicitudController@ratiResul'], 'route' => ['ues.solicitudes.ratiResul'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Ratificación de Resultados</h4>
                    </div>

                    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                                <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="5">
                            </div>
                        </div>
                    </div>

                    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                                <input id="idgrupo" type="text" class="form-control" name="idgrupo"
                                    value="{{ $grupos->idgrupo }}">
                            </div>
                        </div>
                    </div>
                    <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label>numero de etapas</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                <input readonly="" type="text" value="{{ $var }}" name="netapas" id="netapas"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $grupos->codigoG }}" name="codigo" id="codigo"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <?php $cet = 0; ?>
                                        <th>Integrantes</th>
                                        @foreach ($tiproceso as $tip)
                                            @if ($tip->idtipotema == $grupos->idtipotema)
                                                @foreach ($etapas as $et)
                                                    @if ($et->idtipotrabajo == $tip->idtipotema)
                                                        @foreach ($porc as $pr)
                                                            @if ($pr->idetapa == $et->idnuevaetapa && $et->condicion == true)
                                                                <th>Etapa {{ $et->idetapa }} ({{ $pr->porcentaje }}%)
                                                                </th>
                                                                <?php $cet++; ?>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                        <th>Promedio</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mostraintegrante as $mint)
                                        @if ($mint->idgrupo == $grupos->idgrupo)
                                            @foreach ($estudiantes as $est)
                                                @if ($mint->idestudiante == $est->idestudiante)
                                                    @foreach ($personas as $per)
                                                        @if ($per->idpersona == $est->idpersona)
                                                            <tr>

                                                                <td>{{ $est->carnet . ' ' . $per->nombres . ' ' . $per->apellidos }}
                                                                </td>
                                                                @for ($j = 1; $j <= $cet; $j++)
                                                                    <td>
                                                                        @foreach ($notas as $not)
                                                                            @if ($not->idestudiante == $est->idestudiante && $not->idetapa == $j && $not->idgrupo == $grupos->idgrupo)
                                                                                <?php $notaet = $not->nota;
                                                                                
                                                                                echo round($notaet, 2); ?>


                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                @endfor



                                                                <?php $prom = 0; ?>
                                                                @foreach ($tiproceso as $tip)
                                                                    @if ($tip->idtipotema == $grupos->idtipotema)
                                                                        @foreach ($etapas as $et)
                                                                            @if ($et->idtipotrabajo == $tip->idtipotema)
                                                                                @foreach ($porc as $pr)
                                                                                    @if ($pr->idetapa == $et->idnuevaetapa)

                                                                                        @foreach ($notas as $not)
                                                                                            @if ($not->idestudiante == $est->idestudiante && $not->idetapa == $et->idetapa && $not->idgrupo == $grupos->idgrupo)


                                                                                                <?php $prom = $prom + $not->nota * ($pr->porcentaje / 100); ?>

                                                                                            @endif
                                                                                        @endforeach



                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach

                                                                <td><strong><?php echo round($prom, 1); ?></strong></td>




                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                <div class="form-group">
                                    <label>Fecha de registro </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>


                                        <input type="date" name="fechar" id="fechar" class="form-control"
                                            value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required="required"
                                            title="">
                                    </div>

                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>


        <!-- solicitudes: impugnacion de resultadis  -->

        <div class="modal fade" id="solicitud-10">
            {{ Form::Open(['action' => ['solicitudController@impugnacionResultados'], 'route' => ['ues.solicitudes.impugnacionResultados'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Impugnación de Resultados</h4>
                    </div>

                    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                                <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="10">
                            </div>
                        </div>
                    </div>

                    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                                <input id="idgrupo" type="text" class="form-control" name="idgrupo"
                                    value="{{ $grupos->idgrupo }}">
                            </div>
                        </div>
                    </div>
                    <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label>numero de etapas</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                <input readonly="" type="text" value="{{ $var }}" name="netapas" id="netapas"
                                    class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $grupos->codigoG }}" name="codigo" id="codigo"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <?php $cet = 0; ?>
                                        <th>Integrantes</th>
                                        @foreach ($tiproceso as $tip)
                                            @if ($tip->idtipotema == $grupos->idtipotema)
                                                @foreach ($etapas as $et)
                                                    @if ($et->idtipotrabajo == $tip->idtipotema && $et->condicion == true)
                                                        @foreach ($porc as $pr)
                                                            @if ($pr->idetapa == $et->idnuevaetapa)
                                                                <th>Etapa {{ $et->idetapa }} ({{ $pr->porcentaje }}%)
                                                                </th>
                                                                <?php $cet++; ?>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                        <th>Promedio</th>


                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mostraintegrante as $mint)
                                        @if ($mint->idgrupo == $grupos->idgrupo)
                                            @foreach ($estudiantes as $est)
                                                @if ($mint->idestudiante == $est->idestudiante)
                                                    @foreach ($personas as $per)
                                                        @if ($per->idpersona == $est->idpersona)
                                                            <tr>

                                                                <td>{{ $est->carnet . ' ' . $per->nombres . ' ' . $per->apellidos }}
                                                                </td>
                                                                @for ($j = 1; $j <= $cet; $j++)
                                                                    <td>
                                                                        @foreach ($notas as $not)
                                                                            @if ($not->idestudiante == $est->idestudiante && $not->idetapa == $j && $not->idgrupo == $grupos->idgrupo)

                                                                                {{ $not->nota }}

                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                @endfor



                                                                <?php $prom = 0; ?>
                                                                @foreach ($tiproceso as $tip)
                                                                    @if ($tip->idtipotema == $grupos->idtipotema)
                                                                        @foreach ($etapas as $et)
                                                                            @if ($et->idtipotrabajo == $tip->idtipotema)
                                                                                @foreach ($porc as $pr)
                                                                                    @if ($pr->idetapa == $et->idnuevaetapa)

                                                                                        @foreach ($notas as $not)
                                                                                            @if ($not->idestudiante == $est->idestudiante && $not->idetapa == $et->idetapa && $not->idgrupo == $grupos->idgrupo)


                                                                                                <?php $prom = $prom + $not->nota * ($pr->porcentaje / 100); ?>

                                                                                            @endif
                                                                                        @endforeach



                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach

                                                                <td><strong><?php echo round($prom, 1); ?></strong></td>




                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Fecha de registro </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>


                                    <input type="date" name="fechar" id="fechar" class="form-control"
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required="required"
                                        title="">
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>

        <!-- solicitudes: aprobacion de modalidad -->
        <div class="modal fade" id="solicitud-1">
            {{ Form::Open(['action' => ['solicitudController@aprovaciont'], 'route' => ['ues.solicitudes.aprovaciont'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Solicitud de aprobación de Modalidad</h4>
                    </div>
                    <div class="modal-body">

                        <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>idsolicitud</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="1" name="idsolicitud" id="idsolicitud"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>idgrupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $grupos->idgrupo }}" name="idgrupo"
                                        id="idgrupo" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>numero de etapas</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $var }}" name="netapas" id="netapas"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $grupos->codigoG }}" name="codigo" id="codigo"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Tema</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <textarea id="tema" readonly="" value="{{ $grupos->tema }}" class="form-control"
                                        name="tema">{{ $grupos->tema }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Integrantes </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-group"></i></span>
                                    @foreach ($mostraintegrante as $mint)
                                        @if ($mint->idgrupo == $grupos->idgrupo)
                                            @foreach ($estudiantes as $est)
                                                @if ($mint->idestudiante == $est->idestudiante)
                                                    @foreach ($personas as $per)
                                                        @if ($per->idpersona == $est->idpersona)
                                                            <input disabled="" type="text" class="form-control"
                                                                value="{{ $est->carnet . ' ' . $per->nombres . ' ' . $per->apellidos }}">
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Asesor/es </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    @foreach ($asesores as $ase)
                                        @if ($ase->idgrupo == $grupos->idgrupo)
                                            @foreach ($docentes as $doc)
                                                @if ($ase->iddocente == $doc->iddocente)
                                                    @foreach ($personas as $per)
                                                        @if ($per->idpersona == $doc->idpersona)
                                                            @foreach ($tipoasesor as $tias)
                                                                @if ($tias->idtipoasesor == $ase->idtipoasesor)
                                                                    <input disabled type="text" class="form-control"
                                                                        value="{{ $doc->titulo . ' ' . $per->nombres . ' ' . $per->apellidos . ' - ' . $tias->tipoasesor }}">
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Fecha de registro </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>


                                    <input type="date" name="fechar" id="fechar" class="form-control"
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required="required"
                                        title="">
                                </div>

                            </div>
                        </div>




                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>
        <!-- solicitudes: imprimir aprovacion modalidad -->



        <!-- solicitudes: Prorroga interna -->
        <div class="modal fade" id="solicitud-2">
            {{ Form::Open(['action' => ['solicitudController@spsistemas'], 'route' => ['ues.solicitudes.spsistemas'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Solicitud de Prórroga Interna Etapa I</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input type="text" value="{{ $grupos->codigoG }}" name="codigo" id="codigo"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Fecha de inicio</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="date" name="fechai" id="fechai" class="form-control" value=""
                                        required="required" title="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Fecha de finalización</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="date" name="fechaf" id="fechaf" class="form-control" value=""
                                        required="required" title="">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Motivo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <textarea name="motivo" cols="35" id="motivo" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>

        <!-- solicitudes: Ratificacion de resultados -->
        <div class="modal fade" id="solicitud-5">
            {{ Form::Open(['action' => ['solicitudController@ratiResul'], 'route' => ['ues.solicitudes.ratiResul'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Ratificacion de Resultado</h4>
                    </div>

                    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                                <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="5">
                            </div>
                        </div>
                    </div>

                    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                                <input id="idgrupo" type="text" class="form-control" name="idgrupo"
                                    value="{{ $grupos->idgrupo }}">
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input type="text" value="{{ $grupos->codigoG }}" name="codigo" id="codigo"
                                        class="form-control">
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>
        <!-- solicitudes: Repobacion por abandono -->
        <div class="modal fade" id="solicitud-8">
            {{ Form::Open(['action' => ['solicitudController@repabandono'], 'route' => ['ues.solicitudes.repabandono'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Repobación por Abandono</h4>
                    </div>

                    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                                <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="8">
                            </div>
                        </div>
                    </div>

                    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                                <input id="idgrupo" type="text" class="form-control" name="idgrupo"
                                    value="{{ $grupos->idgrupo }}">
                            </div>
                        </div>
                    </div>

                    <div class="modal-body">
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input type="text" value="{{ $grupos->codigoG }}" name="codigo" id="codigo"
                                        class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Integrantes </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-group"></i></span>
                                    <select name="estudianteselec" id="estudianteselec" class="form-inline form-control">
                                        <option value="">[Seleccione]</option>
                                        @foreach ($mostraintegrante as $mint)
                                            @if ($mint->idgrupo == $grupos->idgrupo)
                                                @foreach ($estudiantes as $est)
                                                    @if ($mint->idestudiante == $est->idestudiante)
                                                        @foreach ($personas as $per)
                                                            @if ($per->idpersona == $est->idpersona)
                                                                <option value="{{ $est->idestudiante }}">
                                                                    {{ $est->carnet . ' ' . $per->nombres . ' ' . $per->apellidos }}
                                                                </option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Motivo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <textarea name="motivo" cols="35" id="motivo" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>



        {{-- cambio tema y tribunal --}}
        <div class="modal fade" id="solicitud-6">
            {{ Form::Open(['action' => ['solicitudpicController@spicontaCoordinador'], 'route' => ['ues.solicitudesconta.spicontaCoordinador'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Solicitud de Cambio de Tema</h4>
                    </div>
                    <div class="modal-body">


                        <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                                    <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="6">
                                </div>
                            </div>
                        </div>

                        <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                                    <input id="idgrupo" type="text" class="form-control" name="idgrupo"
                                        value="{{ $grupos->idgrupo }}">
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-12 col-md12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input id="codigo" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                        type="text" value="{{ $grupos->codigoG }}" class="form-control" name="codigo"
                                        maxlength="11" autofocus>
                                </div>
                            </div>
                        </div>



                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Nuevo Tema</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <textarea name="nuevotema" cols="35" id="nuevotema" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Motivo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <textarea name="motivo" cols="35" id="motivo" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>

        <div class="modal fade" id="solicitud-4">
            {{ Form::Open(['action' => ['solicitudpicController@sRatificaciondeTribunal'], 'route' => ['ues.solicitudesconta.sRatificaciondeTribunal'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Ratificación de Tribunal Calificador</h4>
                    </div>
                    <div class="modal-body">

                        <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>numero de etapas</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $var }}" name="netapas" id="netapas"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div hidden="">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>

                                    <input id="idsolicitud" type="text" class="form-control" name="idsolicitud" value="4">
                                </div>
                            </div>
                        </div>

                        <div hidden="">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>

                                    <input id="idgrupo" type="text" class="form-control" name="idgrupo"
                                        value="{{ $grupos->idgrupo }}">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input id="codigo" readonly="" onkeyup="javascript:this.value=this.value.toUpperCase();"
                                        type="text" value="{{ $grupos->codigoG }}" class="form-control" name="codigo"
                                        maxlength="11" autofocus>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Tribunal(*)</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-group"></i></span>
                                    <select data-placeholder="Seleccione docentes" multiple
                                        class="chosen-select form-control" name="docentes[]" id="docentes">
                                        <option value="-99">[Seleccione Docentes]</option>
                                        @foreach ($personas as $per)
                                            @foreach ($docentes as $docente)
                                                @if ($per->idpersona == $docente->idpersona)
                                                    @if ($per->condicion == true)
                                                        <option value="{{ $docente->iddocente }}">
                                                            {{ $docente->titulo . ' ' . $per->nombres . ' ' . $per->apellidos }}
                                                        </option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Fecha de registro </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>


                                    <input type="date" name="fechar" id="fechar" class="form-control"
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required="required"
                                        title="">
                                </div>

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>




        <!-- modal notas -->
        <div class="modal fade" id="notas">
            {{ Form::Open(['action' => ['GrupoController@gnotas'], 'route' => ['ues.grupos.gnotas'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Registrar Notas</h4>
                    </div>
                    <div class="modal-body">

                        <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>idgrupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $grupos->idgrupo }}" name="idgrupo"
                                        id="idgrupo" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $grupos->codigoG }}" name="codigo" id="codigo"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Tema</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <textarea id="tema" readonly="" value="{{ $grupos->tema }}" class="form-control"
                                        name="tema">{{ $grupos->tema }}</textarea>
                                </div>
                            </div>
                        </div>


                        <!-- guardar etapa activa 1 al crear el grupo no al generar la solicitud de ap. tema -->

                        @foreach ($etapaactiva as $ea)
                            @if ($ea->idgrupo == $grupos->idgrupo && $ea->estado == 1)
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Etapa</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                            @foreach ($etapas as $et)
                                                @if ($et->idtipotrabajo == $grupos->idtipotema)
                                                    @if ($et->idetapa == $ea->idnuevaetapa)
                                                        <input readonly="" type="text" value="{{ $et->idnombreetapa }}"
                                                            name="etapa" id="etapa" class="form-control">
                                                        <input type="hidden" value="{{ $et->idetapa }}" name="idetapa"
                                                            id="idetapa" class="form-control">
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Integrantes </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-group"></i></span>
                                    @foreach ($mostraintegrante as $mint)
                                        @if ($mint->idgrupo == $grupos->idgrupo)
                                            @foreach ($estudiantes as $est)
                                                @if ($mint->idestudiante == $est->idestudiante)
                                                    @foreach ($personas as $per)
                                                        @if ($per->idpersona == $est->idpersona)
                                                            <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9">
                                                                <input disabled="" type="text" class="form-control"
                                                                    value="{{ $est->carnet . ' ' . $per->nombres . ' ' . $per->apellidos }}">
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                                                <input type="number" min="0" max="10" step=".01"
                                                                    id="{{ $est->idestudiante }}"
                                                                    name="{{ $est->idestudiante }}" class="form-control"
                                                                    value="" placeholder="Nota">
                                                            </div>
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>



                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>


        {{-- pdf notas --}}
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="pdfnotas">
            {{ Form::Open(['action' => ['GrupoController@pdfNotas'], 'route' => ['ues.grupos.impNotas'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Generar Notas</h4>
                    </div>
                    <div class="modal-body">

                        <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>idgrupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $grupos->idgrupo }}" name="idgrupo"
                                        id="idgrupo" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>numero de etapas</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $var }}" name="idne" id="idne"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Seleccione Etapa </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                                    <select name="etapas" id="etapas" class="form-inline form-control">

                                        <option value="">[Seleccione una Etapa]</option>
                                        @if ($idetapa1)<?php $idetapa1 = $idetapa1->idetapa; ?> @else <?php $idetapa1 = 0; ?>@endif

                                        @foreach ($tiproceso as $tip)
                                            @if ($tip->idtipotema == $grupos->idtipotema)
                                                @foreach ($etapas as $et)

                                                    @if ($et->idtipotrabajo == $tip->idtipotema)


                                                        @if ($idetapa1 > 0 && $et->idetapa <= $idetapa1)

                                                            <option value="{{ $et->idnuevaetapa }}">
                                                                {{ $et->idnombreetapa }}

                                                            </option>
                                                        @endif

                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>





                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i> Imprimir</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>



        <!-- modal notas -->
        <div class="modal fade" id="editarnotas">
            {{ Form::Open(['action' => ['GrupoController@editarnotas'], 'route' => ['ues.grupos.editarnotas'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Editar Notas</h4>
                    </div>
                    <div class="modal-body">

                        <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>idgrupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $grupos->idgrupo }}" name="idgrupo"
                                        id="idgrupo" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $grupos->codigoG }}" name="codigo" id="codigo"
                                        class="form-control">
                                </div>
                            </div>
                        </div>



                        <!-- guardar etapa activa 1 al crear el grupo no al generar la solicitud de ap. tema -->


                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Etapa</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>

                                    <select name="etapaselect" id="etapaselect" onchange="nuevafuncion()"
                                        class="form-control" required="">
                                        <option value="">[Seleccione una Etapa]</option>

                                        @if ($idetapa)<?php $idetapa = $idetapa->idetapa; ?> @else <?php $idetapa = 0; ?>@endif

                                        @foreach ($tiproceso as $tip)
                                            @if ($tip->idtipotema == $grupos->idtipotema)
                                                @foreach ($etapas as $et)
                                                    @if ($et->idtipotrabajo == $tip->idtipotema)
                                                        @if ($idetapa > 0 && $et->idetapa <= $idetapa)
                                                            <option value="{{ $et->idetapa }}">{{ $et->idnombreetapa }}
                                                            </option>
                                                        @endif
                                                    @endif
                                                @endforeach

                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Integrantes </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-group"></i></span>
                                    @foreach ($mostraintegrante as $mint)
                                        @if ($mint->idgrupo == $grupos->idgrupo)
                                            @foreach ($estudiantes as $est)
                                                @if ($mint->idestudiante == $est->idestudiante)
                                                    @foreach ($personas as $per)
                                                        @if ($per->idpersona == $est->idpersona)
                                                            <div class="col-lg-9 col-md-9 col-xs-9 col-sm-9">
                                                                <input disabled="" type="text" class="form-control"
                                                                    value="{{ $est->carnet . ' ' . $per->nombres . ' ' . $per->apellidos }}">
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-xs-3 col-sm-3">
                                                                <?php $idupdate = 'u' . $est->idestudiante; ?>


                                                                <input type="number" min="0" max="10" step=".01"
                                                                    id="<?php echo $idupdate; ?>" name="<?php echo $idupdate; ?>"
                                                                    required="" class="form-control">
                                                            </div>

                                                            <br>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>



                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>

        <!-- solicitud 9 -->
        <div class="modal fade" id="solicitud-9">
            {{ Form::Open(['action' => ['solicitudController@renuncia'], 'route' => ['ues.solicitudes.renuncia'], 'method' => 'post', 'files' => 'true']) }}
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background:#00a65a; color:white">
                        <h4 class="modal-title">Renuncia al Proceso de Graduación</h4>
                    </div>
                    <div class="modal-body">

                        <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>idgrupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $grupos->idgrupo }}" name="idgrupo"
                                        id="idgrupo" class="form-control">
                                </div>
                            </div>
                        </div>
                        @foreach ($etapaactiva as $ea)
                            @if ($ea->idgrupo == $grupos->idgrupo && $ea->estado == 1)
                                <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label>Etapa</label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                            @foreach ($etapas as $et)
                                                @if ($et->idtipotrabajo == $grupos->idtipotema)
                                                    @if ($et->idetapa == $ea->idnuevaetapa)

                                                        <input type="hidden" value="{{ $et->idetapa }}" name="idetapa"
                                                            id="idetapa" class="form-control">
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach


                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Código de Grupo</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                                    <input readonly="" type="text" value="{{ $grupos->codigoG }}" name="codigo"
                                        id="codigo" class="form-control">
                                </div>
                            </div>
                        </div>






                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Estudiante</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-info"></i></span>

                                    <select name="estudianterenuncia" id="estudianterenuncia" class="form-control"
                                        required="">
                                        <option value="">[Seleccione un Estudiante]</option>

                                        @foreach ($mostraintegrante as $mint)
                                            @if ($mint->idgrupo == $grupos->idgrupo)
                                                @foreach ($estudiantes as $est)
                                                    @if ($mint->idestudiante == $est->idestudiante)
                                                        @foreach ($personas as $per)
                                                            @if ($per->idpersona == $est->idpersona)
                                                                <option value="{{ $est->idestudiante }}">
                                                                    {{ $per->nombres }} {{ $per->apellidos }}</option>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label>Fecha de registro </label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>


                                    <input type="date" name="fechar" id="fechar" class="form-control"
                                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required="required"
                                        title="">
                                </div>

                            </div>
                        </div>


                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Generar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>






    @endif
@endsection


@section('script')
    <script type="text/javascript">
        function ventanaP(id) {
            ventana1 = window.open("{{ url('ues/grupos/steps/perfilGrup') }}" + "/" + id,
                'scrollbars=yes,width=800,height=1000,titlebar=no');
        }
    </script>

    <script type="text/javascript">
        function ventanaN(id) {
            ventana1 = window.open("{{ url('ues/grupos/notasG') }}" + "/" + id,
                'scrollbars=yes,width=800,height=1000,titlebar=no');
        }
    </script>

    <script type="text/javascript">
        function ventanaC(id) {
            ventana1 = window.open("{{ url('ues/grupos/cronogramapdf') }}" + "/" + id,
                'scrollbars=yes,width=800,height=1000,titlebar=no');
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $(".chosen-select").chosen({
                no_results_text: "Oops,no se encontraron resultados!",
                width: "100%"
            });

        });



        {{-- Sirve para limitar elemntos seleccionados
      $(".chosen-select").chosen("destroy")
        

        $('.chosen-select').chosen({ max_selected_options: 2,width: "100%"}); 
        $('.chosen-select').trigger("chosen:updated"); --}}
    </script>


    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}";
            switch(type){
            case 'info':
            // toastr.info("{{ Session::get('message') }}");
            toastr.info('{{ Session::get('message') }}', '',{progressBar:true});
            break;
        
            case 'warning':
            toastr.warning('{{ Session::get('message') }}', '',{progressBar:true});
            break;
            case 'success':
            toastr.success('{{ Session::get('message') }}', '',{progressBar:true});
            break;
            case 'error':
            toastr.error('{{ Session::get('message') }}', '',{progressBar:true});
            break;
            }
        @endif
    </script>

    <script>
        function nuevafuncion() {
            var idetapa = $('#etapaselect option:selected').val();
            var idgrupo = document.getElementById('idgrupo').value;
            if (idetapa > -1) {
                var url = "{{ route('ues.getnotas') }}";

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        idgrupo: idgrupo,
                        idetapa: idetapa
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    success: function(data) {


                        for (var i = 0; i < data['not'].length; i++) {
                            var not = data['not'][i];
                            var str1 = "u";
                            var str2 = not.idestudiante;
                            var res = str1.concat(str2);
                            console.log(not);

                            document.getElementById(res).value = not.nota;


                        }

                    },
                    error: function(data) {
                        console.log("error: " + data.responseText);
                    }
                });
            }
        }
    </script>
@endsection
