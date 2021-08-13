<div class="modal fade modal-slide-in-right" aria-hidden="true" 
role="dialog" tabindex="-1" id="imprimird-1-<?php echo e($gs->idgrupsol); ?>">
<?php echo e(Form::Open(array('action'=>array('solicitudController@imprimiraprovaciontd'),'route'=>['ues.solicitudes.imprimiraprovaciontd'], 'method'=>'post', 'files' =>'true'))); ?>

<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header" style="background:#00a65a; color:white">
      <h4 class="modal-title">Imprimir Aprobación de Tema</h4>
    </div>
    <div class="modal-body">

 <div  hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idgrupsol</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($gs->idgrupsol); ?>" name="idsolicitud" id="idsolicitud" class="form-control"  >
                </div>          
            </div>
            </div>

            <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>idgrupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->idgrupo); ?>" name="idgrupo" id="idgrupo" class="form-control"  >
                </div>          
            </div>
            </div>

            <div hidden="" class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>numero de etapas</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($var); ?>" name="netapas" id="netapas" class="form-control"  >
                </div>          
            </div>
            </div>

      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Código de Grupo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-info"></i></span>
                    <input readonly="" type="text" value="<?php echo e($grupos->codigoG); ?>" name="codigo" id="codigo" class="form-control"  >
                </div>          
            </div>
            </div>
            
      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
            <div class="form-group"> 
            <label>Tema</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <textarea id="tema" readonly=""    value="<?php echo e($grupos->tema); ?>"  class="form-control" name="tema"  ><?php echo e($grupos->tema); ?></textarea>
                </div>          
            </div>
            </div>

            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Integrantes </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-group"></i></span>
                <?php foreach($mostraintegrante as $mint): ?>
                <?php if($mint->idgrupo==$grupos->idgrupo): ?>
                <?php foreach($estudiantes as $est): ?>
                <?php if($mint->idestudiante==$est->idestudiante): ?>
                <?php foreach($personas as $per): ?>
                <?php if($per->idpersona == $est->idpersona): ?>
                <input disabled=""  type="text" class="form-control"    value="<?php echo e($est->carnet." ".$per->nombres." ".$per->apellidos); ?>">
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
                </div>          
            </div>
        </div>  

        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">  
          <div class="form-group"> 
                <label>Asesor/es </label>
                <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <?php foreach($asesores as $ase): ?>
                <?php if($ase->idgrupo==$grupos->idgrupo): ?>
                         <?php foreach($docentes as $doc): ?>
                                 <?php if($ase->iddocente==$doc->iddocente): ?>
                     <?php foreach($personas as $per): ?>
                <?php if($per->idpersona==$doc->idpersona): ?>
                <?php foreach($tipoasesor as $tias): ?>
                <?php if($tias->idtipoasesor==$ase->idtipoasesor): ?>
                <input disabled type="text" class="form-control"   value="<?php echo e($doc->titulo." ".$per->nombres." ".$per->apellidos." - ".$tias->tipoasesor); ?>">
                <?php endif; ?>
                <?php endforeach; ?> 
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?>
                <?php endif; ?>
                <?php endforeach; ?> 
                </div>          
            </div>
        </div> 
            
          
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" onclick="rel();" data-dismiss="modal">Cerrar</button>
      <button type="submit" onclick="rel();" class="btn btn-primary">Imprimir</button>
    </div>
  </div>
</div>
<?php echo e(Form::Close()); ?>

</div>