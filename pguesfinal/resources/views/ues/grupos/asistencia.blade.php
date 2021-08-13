<script src="{{asset('js/jquery.min.js')}}"></script>
<div data-backdrop="static" data-keyboard="false" class="modal fade" id="modal-asistencia">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background:#00a65a; color:white">
                <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Asistencias</h4>
            </div>
            <div class="modal-body">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    {!! Form::open(['route'=>['ues.grupos.asistencia',$grupos->idgrupo],'method'=>'POST']) !!}
                    <div class="row">
                        <div class='col-sm-8'>
                            <div class="form-group">
                                {!! Form::label('fecha_asistencia', 'Fecha Asesoria:', ['class'=>"control-label"]) !!}
                                <div class='input-group date datetimepicker'>
                                    <input type='text' class="col-sm-2 form-control" name="fecha_asistencia" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                {!! Form::label('hora_inicio', 'Hora Inicio:', ['class'=>"control-label"]) !!}
                                <div class='input-group date datepicker'>
                                    <input type='text' class="form-control" name="hora_inicio"  step="3600" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        

                        <div class='col-sm-6'>
                            <div class="form-group">
                                {!! Form::label('hora_final', 'Hora Final:', ['class'=>"control-label"]) !!}
                                <div class='input-group date datepicker'>
                                    <input type='text' class=" form-control" name="hora_final" />
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Estudiante</th>
                                <th>Asistencia</th>
                            </tr>
                        </thead>
                        <tbody id="alumns-list">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
               <button class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
               <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
           </div>
           {!! Form::close() !!}
       </div>
   </div>
</div>