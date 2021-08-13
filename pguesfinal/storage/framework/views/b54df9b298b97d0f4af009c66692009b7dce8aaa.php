<div class="modal fade" aria-hidden="true" 
role="dialog" tabindex="-1" id="cronograma">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header" style="background:#00a65a; color:white">
          <h4 class="modal-title">Periódo de Realización del Proceso de Graduación</h4>
      </div>
      <div class="modal-body">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"> 
            <?php echo Form::open(['route'=>['ues.grupos.cronograma',$grupos->idgrupo],'method'=>'POST']); ?>


            <?php echo Form::hidden('idgrupo', $grupos->idgrupo, []); ?>

            <?php if($grupos->periodo): ?>
            <?php echo Form::hidden('idperiodo', $grupos->periodo->idperiodo, []); ?>

            <?php endif; ?>
            
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
                <div class="form-group">
                    <label>Fecha de Inicio de Periódo</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type='date' class="form-control" name="fInicioPeriodo" id="fInicioPeriodo" <?php if($grupos->periodo): ?>
                        value="<?php echo e($grupos->periodo->fInicio); ?>"
                        <?php else: ?>
                        value="<?php echo e(\Carbon\Carbon::now()->format('Y-m-d')); ?>"
                        <?php endif; ?>>

                    </div> 
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
                <div class="form-group">
                    <label>Fecha de Fin de Periódo</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                        <input type='date' class="form-control" name="fFinPeriodo" id="fFinPeriodo" <?php if($grupos->periodo): ?>
                        value="<?php echo e($grupos->periodo->fFin); ?>"
                        <?php else: ?>
                        value="<?php echo e(\Carbon\Carbon::now()->addYears(3)->format('Y-m-d')); ?>"
                        <?php endif; ?>>
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
                <?php if($grupos->periodo): ?>
                <?php foreach($grupos->periodo->fechas->sortBy('idnuevaetapa') as $eta): ?>
                <tr><!--fila simple-->
                        <?php echo Form::hidden("periodo_fechas[". $eta->idnuevaetapa."][idnuevaetapa]", $eta->etapa->idnuevaetapa, []); ?>

                        <?php echo Form::hidden("periodo_fechas[". $eta->idnuevaetapa."][idfecha]", $eta->idfecha, []); ?>

                    <td><?php echo e($eta->etapa->idetapa); ?></td>
                    <td><?php echo e($eta->etapa->idnombreetapa); ?></td>
                    <td><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type='date'  class="form-control" name="<?php echo e('periodo_fechas['. $eta->idnuevaetapa.'][fecsetapas]'); ?>" id="fecsetapas" value="<?php echo e($eta->fechasetapas); ?>"  /></div></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <?php foreach($grupos->tema_grupo->nuevaetapas->sortBy('idetapa') as $element): ?>
                    <tr>
                        <?php echo Form::hidden("periodo_fechas[". $element->idnuevaetapa."][idnuevaetapa]", $element->idnuevaetapa, []); ?>

                        <td><?php echo e($element->idetapa); ?></td>
                        <td><?php echo e($element->idnombreetapa); ?></td>
                        <td><div class="input-group"><span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type='date'  class="form-control" name="<?php echo e('periodo_fechas['. $element->idnuevaetapa.'][fecsetapas]'); ?>" id="fecsetapas" value="<?php echo e(\Carbon\Carbon::now()->format('Y-m-d')); ?>"  /></div></td>
                        </tr>
                        <?php endforeach; ?>
                <?php endif; ?>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left" onclick="rel();"></i>  Salir</button>
                    <button class="btn btn-warning" type="reset" onclick="rel();"> <i class="fa fa-times"></i> Cancelar</button>
                    <button type="submit" onclick="rel();" class="btn btn-primary">Registrar</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo e(Form::Close()); ?>

</div>
