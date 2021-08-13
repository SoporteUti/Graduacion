<?php $__env->startSection('contenido'); ?>

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
        
    
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

$('#modalagregarfacultad').on('show.bs.modal', function () {
             // $('#addNodeForm').bootstrapValidator('resetForm', true);
            $(this).removeData('bs.modal');
            $('#modalagregarfacultad').bootstrapValidator('resetForm', true);
              $.ajax(
                     {
                         url: "ues/facultades",
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

    $('#modalagregarfacultad').bootstrapValidator({
       feedbackIcons: {
           /* valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
        },
        fields: {
                nombre: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el nombre de la facultad '
                    },
                    stringLength: {
                        min: 5,
                        max: 75,
                        message: 'Debe ingresar 5 caracteres como mínimo'
                    } 

                }
            },  
            codigo: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el codigo de la facultad '
                    },
                    stringLength: {
                        min: 3,
                        max: 16,
                        message: 'Debe ingresar 3 caracteres como mínimo'
                        },  
                    remote: {
                        message: 'codigo no disponible',
                        url: "<?php echo e(url('/usuValid/')); ?>",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "<?php echo e(csrf_token()); ?>";
                          }
                        }
                        
                    }
                    
                }
            }, 
            telefono: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el telefono de la Facultad'
                    },
                    stringLength: {
                        min: 9,
                        max: 9,
                        message: 'Ingrese el telefono de la Facultad'
                         },  
                    remote: {
                        message: 'El telefono no está disponible',
                        url: "<?php echo e(url('/telefonoValid/')); ?>",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "<?php echo e(csrf_token()); ?>";
                          }
                        }
                        
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
                    var formulario = document.getElementById('facultad');
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
			<h3>Listado de Facultades   <button data-backdrop="static" data-keyboard="false" class="btn btn-success" data-toggle="modal" data-target="#modalagregarfacultad"><i class="fa fa-file-o"></i> Nueva</button>   
       </h3>

			
		</div>
	</div>

<?php echo Form::open (array('url'=>'ues/facultades','method'=>'POST','autocomplete'=>'off')); ?>

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

    
<div id="modalagregarfacultad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form id="facultad" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
 

        <div class="modal-header" style="background:#00a65a; color:white">

          <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->

          <h4 class="modal-title">Agregar Facultad</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body" >

          <div class="box-body">

        <?php /*     <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group" id="validationCustom01"> 
                <label >Código</label>
                <div class="input-group" >
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input value="" type="text" class="form-control" id="codigo" name="codigo" placeholder="Ingresar código" autofocus>
                </div>     
            </div> */ ?>


            <div class="form-group"> 
				<label>Nombre</label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-text-width"></i></span>
        			<input type="text" onKeyPress="return soloLetras(event)" class="form-control" name="nombre" placeholder="Ingresar nombre" focus>
        		</div>			
			</div>

            <!-- ENTRADA PARA TELEFONO -->

            <div class="form-group"> 
			<label>Teléfono</label>
				<div class="input-group">					
					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
        			<input id="telefono" type="text" data-inputmask="'mask':'9999-9999'" data-mask class="form-control" name="telefono"  placeholder="Ingresar teléfono" autofocus>
        		</div>			
			</div>

            <!-- ENTRADA PARA LA DIRRECCION -->

           <div class="form-group"> 
			<label>Dirección</label>
				<div class="input-group">					
					<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
        			<input type="text"  class="form-control" id="direccion" name="direccion" placeholder="Ingresar dirección" autofocus>
        		</div>			
			</div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

           <button id="cancel1" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
          <button id="cancel" class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar </button>

        </div>

       

      </form>

    </div>

  </div>


</div>
 

<?php echo Form::close(); ?>


	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			 <div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover" id="facultades">
					<thead><!--fila-->
						<th hidden=""></th><!--celda-->
            <th>N°</th>
          <?php /*   <th>Código</th><!--celda--> */ ?>
						<th>Nombre</th><!--celda-->
						<!--<th>Decano</th>celda-->
						<th>Teléfono</th><!--celda-->
						<!--<th>dirección</th>celda-->
            <th>Estado</th><!--celda-->
						<th>Opciones</th><!--celda-->						
					</thead>
          <?php $cont=1; ?>
					<?php foreach($facultades as $fac): ?>
					<tr><!--fila simple-->
            <td><?php echo $cont; $cont++ ?></td>
						<td hidden=""><?php echo e($fac->idfacultad); ?></td><!--celda sencilla-->
                        <?php /* <td><?php echo e($fac->codigo); ?></td><!--celda sencilla--> */ ?>
						<td><?php echo e($fac->nombre); ?></td><!--celda sencilla-->
						
						<td><?php echo e($fac->telefono); ?></td><!--celda sencilla-->
					<!--	<td><?php echo e($fac->direccion); ?></td>celda sencilla-->

                        <td> <?php if($fac->condicion==true): ?> Activa 
                         <?php else: ?>
                        Inactiva 
                        <?php endif; ?> </td><!--celda sencilla-->
						<td>
							
							

        
<?php if($fac->condicion==true): ?>
                        <a href="" data-target="#modal-edit-<?php echo e($fac->idfacultad); ?>" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-<?php echo e($fac->idfacultad); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-delete-<?php echo e($fac->idfacultad); ?>" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>
<?php else: ?>
                        <a href=""  data-target="" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-<?php echo e($fac->idfacultad); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-modalup-<?php echo e($fac->idfacultad); ?>" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>


    <?php endif; ?>        

             
                                      						

						</td><!--celda-->
					</tr>
                     <?php echo $__env->make('ues.facultades.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('ues.facultades.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo $__env->make('ues.facultades.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('ues.facultades.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endforeach; ?>
				</table>
			</div><!--div tabla responsiva-->
			
	
 
   </div>
	</div>


<?php $__env->startSection('script'); ?>

<script>
function ventana(id)
{
ventana1=window.open("<?php echo e(url('/listaFac/')); ?>" ,'scrollbars=yes, width=800, height=1000, titlebar=no'); 
}
</script>

<script>
function ventanaI(id)
{
ventana2=window.open("<?php echo e(url('/listaFacI/')); ?>" ,'scrollbars=yes, width=800, height=1000, titlebar=no'); 
}
</script>


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



    </script>


    <script>
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
        especiales = "8-37-39-46";

        tecla_especial = false
        for (var i in especiales) {
            if (key == especiales[i]) {
                tecla_especial = true;
                break;
            }
        }

        if (letras.indexOf(tecla) == -1 && !tecla_especial) {
            return false;
        }
    }


</script>


    <script>
      $(document).ready(function() {
    $('#facultades').DataTable({
    
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