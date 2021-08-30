@extends('plantillas.admin')

@section('contenido')
    @if (Auth::user()->idrol == 4)

        <style type="text/css">
            .table-wrapper-scroll-y {
                display: block;
                max-height: 222px;
                overflow-y: auto;
                -ms-overflow-style: -ms-autohiding-scrollbar;
            }

        </style>


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
                <div class="collapse navbar-collapse navbar-ex1-collapse ">
                    <ul class="nav navbar-nav">


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
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab"
                                            href="#page-{{ $et->idetapa }}"><strong>{{ $et->idnombreetapa }}</strong></a>
                                        <?php $var++; ?>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
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
                                                                        @if ($gs->estado == 7)
                                                                            <td>Denegado </td>
                                                                        @else
                                                                            @foreach ($roles as $rl)
                                                                                @if ($gs->estado == $rl->idrol)
                                                                                    @if ($gs->estado == Auth::user()->idrol)
                                                                                        <td>Recibido de Coordinador:
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
                                                            @endif

                                                            <td>

                                                                @if ($sol->idsolicitud != 2 && $sol->idsolicitud != 7)
                                                                    <a href=""
                                                                        data-target="#imprimird-{{ $sol->idsolicitud }}-{{ $gs->idgrupsol }}"
                                                                        data-toggle="modal">
                                                                        <button class="btn btn-warning"><i
                                                                                class="fa fa-print"></i></button></a>


                                                                    @if (($gs->estado == 0 && $gs->condicion == true) || $gs->estado == 1 || $gs->estado == 7)
                                                                        <a href=""
                                                                            data-target="#registrard-{{ $sol->idsolicitud }}-{{ $gs->idgrupsol }}"
                                                                            data-toggle="modal">
                                                                            <button class="btn btn-success"><i
                                                                                    class=" fa fa-folder-open"></i></button></a>
                                                                    @endif
                                                                @else
                                                                    @if ($gs->estado == 4 || $gs->estado == 1)
                                                                        <a href=""
                                                                            data-target="#registrard-{{ $sol->idsolicitud }}-{{ $gs->idgrupsol }}"
                                                                            data-toggle="modal">
                                                                            <button class="btn btn-success"><i
                                                                                    class=" fa fa-folder-open"></i></button></a>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            @include('ues.grupos.imprimir1director')
                                                            @include('ues.grupos.registrar1director')

                                                            @include('ues.grupos.imprimir3director')
                                                            @include('ues.grupos.registrar3director')

                                                            @include('ues.grupos.imprimir8director')
                                                            @include('ues.grupos.registrar8director')

                                                            @include('ues.grupos.registrarRSdirector')


                                                            @include('ues.grupos.imprimirRSdirector')


                                                            @include('ues.grupos.imprimir6director')
                                                            @include('ues.grupos.imprimir4director')
                                                            @include('ues.grupos.imprimir9director')
                                                            @include('ues.grupos.imprimir10director')




                                                            @include('ues.grupos.registrarPIdirector')

                                                            @include('ues.grupos.registrar4director')
                                                            @include('ues.grupos.registrar6director')
                                                            @include('ues.grupos.registrar7director')
                                                            @include('ues.grupos.registrar9director')
                                                            @include('ues.grupos.registrar10director')

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





                </div>

            </div>
        </div>












        <!-- solicitudes: aprobacion de tema -->



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
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
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



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> Cerrar</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                    </div>
                </div>
            </div>
            {{ Form::Close() }}
        </div>




        {{-- cambio tema y tribunal --}}
        <div class="modal fade" id="solicitud-6">
            {{ Form::Open(['action' => ['solicitudpicController@spiconta'], 'route' => ['ues.solicitudesconta.spiconta'], 'method' => 'post', 'files' => 'true']) }}
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



                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
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



                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label>Fecha de Emisión</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                                    <input type="date" readonly="" class="form-control" id="fecha" name="fecha" step="1"
                                        value="<?php echo date('Y-m-d'); ?>">
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
                                <label>Asesores(*)</label>
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
        function rel() {

            location.reload();
        }
    </script>
@endsection
