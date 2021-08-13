<div class="modal fade" id="modal-id">
{{Form::Open(array('action'=>array('SolicitudSysController@spsistemas'),'route'=>['ues.solicitudesSys.spsistemas'], 'method'=>'post', 'files' =>'true'))}}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header" style="background:#00a65a; color:white>
			<h4 class="modal-title">Solicitud de Prórroga Interna Etapa I</h4>
		</div>
		<div class="modal-body">
			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input type="text" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
			<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
            <div class="form-group"> 
            <label>Fecha de inicio</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="date" name="fechai" id="fechai" class="form-control" value="" required="required" title="">
                </div>          
            </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
            <div class="form-group"> 
            <label>Fecha de finalización</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <input type="date" name="fechaf" id="fechaf" class="form-control" value="" required="required" title="">
                </div>          
            </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Motivo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <textarea  name="motivo"  cols="35" id="motivo" class="form-control" ></textarea>
                </div>          
            </div>
            </div>
          
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary">Generar</button>
		</div>
	</div>
</div>
{{Form::Close()}}
</div>