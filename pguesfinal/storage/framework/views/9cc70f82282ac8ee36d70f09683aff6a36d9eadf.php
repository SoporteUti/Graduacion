<?php $__env->startSection('contenido'); ?>


<script type="text/javascript">
        $(document).ready(function () {
        $("#cancel").on("click", function () {
            $('.form-group').removeClass('has-success has-error');
           $('.glyphicon ').remove();
            /*$("#codigo").validate().resetForm();
   $("#codigo").removeClass("has-error");
   $('.form-group').removeClass('has-error has-feedback');
        $('.form-group').find('small.help-block').hide();
        $('.form-group').find('i.form-control-feedback').hide();*/
           

        });
    });
</script>
<script type="text/javascript">
        $(document).ready(function () {
        $("#cancel1").on("click", function () {
            $('.form-group').removeClass('has-success has-error');
           $('.glyphicon ').remove();
            /*$("#codigo").validate().resetForm();
   $("#codigo").removeClass("has-error");
   $('.form-group').removeClass('has-error has-feedback');
        $('.form-group').find('small.help-block').hide();
        $('.form-group').find('i.form-control-feedback').hide();*/
           

        });
    });
</script>

<script>
$(document).ready(function() {

$('#modalagregarasesor').on('show.bs.modal', function () {
             // $('#addNodeForm').bootstrapValidator('resetForm', true);
            $(this).removeData('bs.modal');
            $('#modalagregarasesor').bootstrapValidator('resetForm', true);
              $.ajax(
                     {
                         url: "ues/tipoAsesores",
                         type: "GET",
                         success:function(text) 
                         {
                             /*alert(text);
                            nodelist = text;*/
                         },
                         error: function(jqXHR, textStatus, errorThrown) 
                         {
                             //if fails      
                         }
                     });
            });

    $('#modalagregarasesor').bootstrapValidator({
       feedbackIcons: {
           /* valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
        },
        fields: {
                tipoasesor: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el nombre de la facultad '
                    },
                    stringLength: {
                        min: 6,
                        max: 75,
                        message: ' '
                    } 

                }
            },  
            

            direccion: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese la direccion de la facultad '
                    },
                    stringLength: {
                        min: 10,
                        message: 'Debe ingresar una direccionmas específica'
                    } 

                }
            }     


           }



  }).on('success.form.bv', function(e) {
         
         e.preventDefault();
         bootbox.dialog({
              message: "¿Esta seguro de guardar?",
              title: "CONFIRMAR",
              buttons: {
                success: {
                  label: "SI",
                  className: "btn-success",
                  callback: function() {
                    var formulario = document.getElementById('tipoasesor');
                    formulario.submit();
                  }
                },
                danger: {
                  label: "NO",
                  className: "btn-danger",
                  callback: function() {
                                     
                  }
                }
              }
            });
        });


});
</script>



<div class="row" >
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
		<h3>Listado de Tipos de Asesores <button class="btn btn-success" data-toggle="modal" data-target="#modalagregarasesor">Nuevo</button></h3>
		 
      
   

	</div>
</div>




<?php echo Form::open (array('url'=>'ues/tipoAsesores','method'=>'POST','autocomplete'=>'off')); ?>

		<?php echo e(Form::token()); ?>


        <?php if(count($errors)>0): ?>
    <div class="alert alert-danger">
        <ul>
        <?php foreach($errors->all() as $error): ?>
            <li><?php echo e($error); ?></li>
            
        <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

<div id="modalagregarasesor" class="modal fade" role="dialog">

<div class="modal-dialog">

<div class="modal-content">

  <form id="tipoasesor" role="form" method="post" enctype="multipart/form-data" id="formA" name="formA">

    <!--=====================================
    CABEZA DEL MODAL
    ======================================-->


    <div class="modal-header" style="background:#00a65a; color:white">

      

      <h4 class="modal-title">Agregar Tipo de Asesor</h4>

    </div>





    <!--=====================================
    CUERPO DEL MODAL
    ======================================-->
    <div class="modal-body">

      <div class="box-body">

        <!-- ENTRADA PARA EL NOMBRE -->
       
        
        <div class="form-group"> 
			<label>Tipo de Asesor</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-text-width"></i></span>
    			<input type="text" class="form-control" name="tipoasesor" id="tipoasesor" placeholder="Ingresar tipo deAsesor" autofocus>
    		</div>			
		</div>

    <div hidden="" class="col-lg-6 col-md-6 col-xs-12 col-sm-6" > 
         <div class="form-group"> 
            <div  class="input-group">                   
                <span class="input-group-addon"><i class="fa fa-database"></i></span>
                <input id="idcarrera" type="text" class="form-control" name="idcarrera" value="<?php echo e(Auth::user()->idcarrera); ?>" >
            </div>          
        </div>
    </div> 


        <!-- ENTRADA PARA LA DIRRECCION -->

     

      </div>

    </div>


    <!--=====================================
    PIE DEL MODAL
    ======================================-->

    <div class="modal-footer">

      <button id="cancel1" type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>  Salir</button>
      <button id="cancel" class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
      <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Guardar </button>

    </div>

    

  </form>


</div>

</div>


</div>



</script>



<?php echo Form::close(); ?>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		 <div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover" id="asesor">
				<thead><!--fila-->
					<th hidden=""></th><!--celda-->
        <th>N°</th>
					<th>Tipos de A sesores</th><!--celda-->
					<th>Estado</th><!--celda-->
					<th>Opciones</th><!--celda-->						
				</thead>
        <?php $cont=1; ?>
				<?php foreach($tasesor as $tas): ?>
         <?php if($tas->idcarrera==Auth::user()->idcarrera): ?>
				<tr><!--fila simple-->
          <td hidden=""><?php echo e($tas->idtipoasesor); ?></td><!--celda sencilla-->
          <td><?php echo $cont; $cont++ ?></td>
					<td><?php echo e($tas->tipoasesor); ?></td><!--celda sencilla-->
					<td> <?php if($tas->condicion==true): ?> Activo 
                         <?php else: ?>
                        Inactivo
                        <?php endif; ?> </td><!--celda sencilla-->
					<td>				
<?php if($tas->condicion==true): ?>
                        <a href="" data-target="#modal-edit-<?php echo e($tas->idtipoasesor); ?>" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-<?php echo e($tas->idtipoasesor); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
						<a href="" data-target="#modal-delete-<?php echo e($tas->idtipoasesor); ?>" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>
<?php else: ?>
                        <a href=""  data-target="" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-<?php echo e($tas->idtipoasesor); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-modalup-<?php echo e($tas->idtipoasesor); ?>" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>


    <?php endif; ?>        

         
                                  						

					</td><!--celda-->
				</tr>
                <?php echo $__env->make('ues.tipoAsesores.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('ues.tipoAsesores.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                 <?php echo $__env->make('ues.tipoAsesores.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php echo $__env->make('ues.tipoAsesores.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                 <?php echo $__env->make('ues.tipoAsesores.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       <?php endif; ?>        
				<?php endforeach; ?>
			</table>
		</div><!--div tabla responsiva-->
		

</div>

</div>



<?php $__env->startSection('script'); ?>
<script>
<?php if(Session::has('message')): ?>
    var type = "<?php echo e(Session::get('alert-type', 'info')); ?>";
    switch(type){
        case 'info':
           // toastr.info("<?php echo e(Session::get('message')); ?>");
           toastr.info('<?php echo e(Session::get('message')); ?>', '',{progressBar:true});
            break;
        
        case 'warning':
            toastr.warning('<?php echo e(Session::get('message')); ?>', '',{progressBar:true});
            break;
        case 'success':
            toastr.success('<?php echo e(Session::get('message')); ?>', '',{progressBar:true});
             break;
        case 'error':
            toastr.error('<?php echo e(Session::get('message')); ?>', '',{progressBar:true});
            break;
    }
<?php endif; ?>

<script>
  $(document).ready(function() {
$('#asesor').DataTable({

"language":{
"sProcessing":     "Procesando...",
"sLengthMenu":     "Mostrar _MENU_ registros",
"sZeroRecords":    "No se encontraron resultados",
"sEmptyTable":     "Ningún dato disponible en esta tabla",
"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
"sInfoPostFix":    "",
"sSearch":         "Buscar:",
"sUrl":            "",
"sInfoThousands":  ",",
"sLoadingRecords": "Cargando...",
"oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
},
"oAria": {
    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
}
}
}



    );
} );
</script>


<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>