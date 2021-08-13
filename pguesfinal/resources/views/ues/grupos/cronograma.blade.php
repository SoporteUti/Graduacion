<div class="modal fade" aria-hidden="true" 
role="dialog" tabindex="-1" id="cronograma">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="background:#00a65a; color:white">
          <h4 class="modal-title">Periódo de Realización del Proceso de Graduación</h4>
      </div>
      <div class="modal-body">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
            {!! Form::open(['route'=>['ues.grupos.cronograma',$grupos->idgrupo],'method'=>'POST']) !!}

            {!! Form::hidden('idgrupo', $grupos->idgrupo, []) !!}
            @if ($grupos->periodo)
            {!! Form::hidden('idperiodo', $grupos->periodo->idperiodo, []) !!}
            @endif
            
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
                <div class="form-group">
                    <label>Fecha de Inicio de Periódo</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type='date' class="form-control" name="fInicioPeriodo" id="fInicioPeriodo" @if ($grupos->periodo)
                        value="{{ $grupos->periodo->fInicio }}"
                        @else
                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                        @endif>

                    </div> 
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
                <div class="form-group">
                    <label>Fecha de Fin de Periódo</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type='date' class="form-control" name="fFinPeriodo" id="fFinPeriodo" @if ($grupos->periodo)
                        value="{{ $grupos->periodo->fFin }}"
                        @else
                        value="{{ \Carbon\Carbon::now()->addYears(3)->format('Y-m-d') }}"
                        @endif>
                    </div> 
                </div>
            </div>

            <table class="table table-striped table-bordered table-condensed table-hover" >
                <thead><!--fila-->

                    <th>N°</th>
                    <th>Nombre de la  Defensa (Etapa)</th><!--celda-->
                    <!--<th>Decano</th>celda-->
                    <th>Fecha de Defensa (Etapas)</th><!--celda-->                     
                </thead>
                @if ($grupos->periodo)
                @foreach($grupos->periodo->fechas->sortBy('idnuevaetapa') as $eta)
                <tr><!--fila simple-->
                        {!! Form::hidden("periodo_fechas[". $eta->idnuevaetapa."][idnuevaetapa]", $eta->etapa->idnuevaetapa, []) !!}
                        {!! Form::hidden("periodo_fechas[". $eta->idnuevaetapa."][idfecha]", $eta->idfecha, []) !!}
			@if($eta->etapa->condicion==true)
                    <td>{{ $eta->etapa->idetapa }}</td>
                    <td>{{$eta->etapa->idnombreetapa}}</td>
                    <td><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type='date'  class="form-control" name="{{ 'periodo_fechas['. $eta->idnuevaetapa.'][fecsetapas]' }}" id="fecsetapas" value="{{$eta->fechasetapas}}"  /></div></td>
                    </tr>
	            @endif
                    @endforeach
                    @else
                    @foreach ($grupos->tema_grupo->nuevaetapas->sortBy('idetapa') as $element)
                    <tr>
                        {!! Form::hidden("periodo_fechas[". $element->idnuevaetapa."][idnuevaetapa]", $element->idnuevaetapa, []) !!}
                        @if($element->condicion==true)
			<td>{{ $element->idetapa }}</td>
                        <td>{{ $element->idnombreetapa }}</td>
                        <td><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type='date'  class="form-control" name="{{ 'periodo_fechas['. $element->idnuevaetapa.'][fecsetapas]' }}" id="fecsetapas" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  /></div></td>
                        </tr>
  			@endif
                        @endforeach
                @endif
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                	 <button type="button" onclick="rel();" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
                   <!--  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left" onclick="rel();"></i> Cerrar</button> -->
                    <button class="btn btn-warning" type="reset" onclick="rel();"> <i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" onclick="rel();" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    {{Form::Close()}}
</div>
