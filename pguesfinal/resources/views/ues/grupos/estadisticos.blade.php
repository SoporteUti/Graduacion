
<div   class="modal fade" id="modal-estadisticos">
<div class="modal-dialog">
  <div class="modal-content">
     {!! Form::open(['route'=>['ues.grupos.pdfestadistico'],'method'=>'POST']) !!}
        <div class="modal-header" style="background:#00a65a; color:white">
           <!--  <button type="button"  class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
            <h4 class="modal-title">Datos Estadisticos</h4>
        </div>
        <div class="modal-body">
           <div class="box-body">
             <!---Seleccionar Departamento -->  
          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
           <div class="form-group"> 
            <label>Departamento</label>
            <div class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-sitemap"></i></span>
                <select name="dept" id="dept" class="form-inline form-control">
                <option value="-1">[Seleccione]
                </option>
               
                       @foreach($departamento as $depto)

                        @if($depto->condicion==1 )

                        <option value="{{$depto->iddepartamento}}" >{{$depto->nombre}}</option>
                       @endif
                       @endforeach
                </select>
                </div>          
                </div> 
            </div> 
             <!---Seleccionar Carrera -->  
          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
           <div class="form-group"> 
            <label>Carrera</label>
            <div class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                <select name="carrera" id="carrera" class="form-inline form-control">
                <option value="-1">[Seleccione]
                </option>

                @foreach($carreras as $car)

                 @if($car->condicion==true)
                <option value="{{$car->idcarrera}}">{{$car->nombre}} </option>
                @endif

                @endforeach
                </select>
                </div>          
                </div> 
            </div>  
            <!---Seleccionar Año -->  
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
           <div class="form-group"> 
            <label>Año</label>
            <div class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-calendar-o"></i></span>
                <select name="anioselec" id="anioselec" class="form-inline form-control">
                <option value="-1">[Seleccione]
                  @for($a = $aniomin; $a <=$anio1; $a++)
                <option value="{{$a}}">{{ $a }}</option>
                @endfor
                </select>
                </div>          
                </div> 
            </div> 
           
            
            <!---Seleccionar Estado -->  
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
           <div class="form-group"> 
            <label>Estado</label>
            <div class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <select name="estado" id="estado" class="form-inline form-control">
                <option value="-1">[Seleccione]</option>
                <option value="1">Activos</option>
                <option value="0">Inactivos</option>
                </select>
                </div>          
                </div> 
            </div>
           
          </div>
        </div>
        
        <div class="modal-footer">
           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"> Cerrar</button>
           <button class="btn btn-warning" type="reset" onclick="disable()"> <i class="fa fa-times"></i> Cancelar</button>
           <button type="submit" class="btn btn-primary" id="sendBTN" >Generar</button>
       </div>
       {!! Form::close() !!}
    </div>
</div>

</div>
