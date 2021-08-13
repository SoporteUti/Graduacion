

<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="modal-delete-{{$carr->idcarrera}}">
	{{Form::Open(array('action'=>array('CarreraController@destroy',$carr->idcarrera),'method'=>'delete'))}}
	
          
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background:#00a65a; color:white">
               
                <h4 class="modal-title">Dar de Baja Carrera</h4>
			</div>
			<div class="modal-body">
				<p>Confirme si desea Dar de Baja la Carrera: <strong>{{$carr->nombre}}</strong> </p>
			</div>

			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" > 
        <div class="form-group"> 
            <label>Fecha</label>   
            <div class="input-group">  
                <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                <input type="date" class="form-control" id="fechadebaja" name="fechadebaja" step="1" value="<?php echo date("d-m-y");?>" >
            </div>         
        </div>
    </div>

			<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Ingrese un Motivo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <textarea  name="motivo"  cols="35" id="motivo" class="form-control" placeholder="Ingresar el motivo"></textarea>
                </div>          
            </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>N° de Acuerdo de Baja</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input type="text"  name="acuerdoBaja"   id="acuerdoBaja" class="form-control" placeholder="Ingresar el N° de acuerdo" >
                </div>          
            </div>
            </div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
				<button type="submit" class="btn btn-primary">Confirmar</button>
			</div>
		</div>
		
	</div>
	{{Form::Close()}}



</div>