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


    <script>

$(document).ready(function() {


 $('#modalagregardepartamento').on('show.bs.modal', function () {
             // $('#addNodeForm').bootstrapValidator('resetForm', true);
            $(this).removeData('bs.modal');
            $('#modalagregardepartamento').bootstrapValidator('resetForm', true);
              $.ajax(
                     {
                         url: "ues/departamentos",
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


    $('#modalagregardepartamento').bootstrapValidator({
       feedbackIcons: {
           /* valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
        },
        excluded: [':disabled'],
        fields: {
                nombre: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el nombre del Departamento '
                    },
                    stringLength: {
                        min: 6,
                        max: 75,
                        message: 'Debe ingresar 6 caracteres como mínimo'
                    } 

                }
            },  
             codigo: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el codigo del Departamento '
                    },
                    stringLength: {
                        min: 3,
                        max: 16,
                        message: 'Debe ingresar 3 caracteres como mínimo'
                        },  
                    remote: {
                        message: 'codigo no disponible',
                        url: "<?php echo e(url('/codigoDeptoValid/')); ?>",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "<?php echo e(csrf_token()); ?>";
                          }
                        }
                        
                    }
                    
                }
            }, 
            facultad: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione facultad '
                    },
                
                }
            }


           }



  }).on('success.form.bv', function(e) {
         
         e.preventDefault();
         bootbox.dialog({
              buttons: {
                success: {
                  label: "SI",
                  className: "btn-success",
                  callback: function() {
                    var formulario = document.getElementById('departamentos');
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
			<h3>Listado de Departamentos   <button data-backdrop="static" data-keyboard="false" class="btn btn-success" data-toggle="modal" data-target="#modalagregardepartamento">Nuevo</button>   <a><button onclick="ventana()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> Activos </button></a>  
        <a><button onclick="ventanaI()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> Inactivos </button></a></h3>
			 
          
       

			
		</div>
	</div>




<?php echo Form::open (array('url'=>'ues/departamentos','method'=>'POST','autocomplete'=>'off')); ?>

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
    
<div id="modalagregardepartamento" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form id="departamentos" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
 

        <div class="modal-header" style="background:#00a65a; color:white">

          

          <h4 class="modal-title">Agregar Departamento</h4>

        </div>





        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
         <?php /*     <div class="form-group"> 
            <label name="codigolabel" id="codigolabel">Código(*)</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input id="codigo" type="text"    class="form-control" name="codigo"  placeholder="Ingresar código" autofocus>
                </div>          
            </div>
             */ ?>
            <div class="form-group"> 
				<label>Nombre(*)</label>
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-text-width"></i></span>
        			<input type="text" class="form-control" name="nombre" placeholder="Ingresar nombre" autofocus>
        		</div>			
			</div>

            <!-- ENTRADA PARA TELEFONO -->

            <!-- ENTRADA PARA LA DIRRECCION -->

           <div class="form-group"> 
			  <label>Facultad(*)</label>
				<div class="input-group">					
					<span class="input-group-addon"><i class="fa fa-bank"></i></span>
        			<select name="facultad" id="facultad" class="form-inline form-control">

        			<option value="">[Seleccione]
        				
        			</option>
        		
        			<?php foreach($facultades as $fac): ?>
        			<?php if($fac->condicion==1): ?>
<option value="<?php echo e($fac->idfacultad); ?>"><?php echo e($fac->nombre); ?>

        				
        			</option>
<?php endif; ?>
 <?php endforeach; ?>
        			</select>
        		</div>			
			</div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>  Salir</button>
          <button class="btn btn-warning" id="cancel" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
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
				<table class="table table-striped table-bordered table-condensed table-hover" id="departamentos">
					<thead><!--fila-->
						<th hidden=""></th><!--celda-->
            <th>N°</th>
        <?php /*     <th>Código</th><!--celda--> */ ?>
						<th>Nombre</th><!--celda-->
						<!--<th>Decano</th>celda-->
						
						<th>Facultad</th><!--celda-->
                        <th>Estado</th><!--celda-->
						<th>Opciones</th><!--celda-->						
					</thead>
          <?php $cont=1; ?>
					<?php foreach($departamento as $dep): ?>
					<tr><!--fila simple-->
           <td><?php echo $cont; $cont++ ?></td>
            <td hidden=""><?php echo e($dep->iddepartamento); ?></td>						
					<?php /* 	<td><?php echo e($dep->codigo); ?></td */ ?>
						<td><?php echo e($dep->nombre); ?></td><!--celda sencilla-->
						<?php foreach($facultades as $fac): ?>
        				<?php if($fac->idfacultad==$dep->idfacultad): ?>

						<td><?php echo e($fac->nombre); ?></td>
						<?php endif; ?>
						<?php endforeach; ?>
						<!--celda sencilla-->
						
						<td> <?php if($dep->condicion==1): ?> Activo
                         <?php else: ?>
                        Inactivo
                        <?php endif; ?> </td><!--celda sencilla-->
                    <td>
							
<?php if($dep->condicion==1): ?>
                        <a href="" id="edit" data-target="#modal-edit-<?php echo e($dep->iddepartamento); ?>" data-toggle="modal">
                        <button  class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-<?php echo e($dep->iddepartamento); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-delete-<?php echo e($dep->iddepartamento); ?>" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>
<?php else: ?>
                        <a href=""  data-target="" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-<?php echo e($dep->iddepartamento); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-modalup-<?php echo e($dep->iddepartamento); ?>" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>


    <?php endif; ?>       		

						</td><!--celda-->
					</tr>
                    <?php echo $__env->make('ues.departamentos.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('ues.departamentos.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('ues.departamentos.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('ues.departamentos.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php endforeach; ?>
				</table>
			</div><!--div tabla responsiva-->
			
	</div>
 
   
	</div>


<?php $__env->startSection('script'); ?>

<script>
function ventana(id)
{
ventana1=window.open("<?php echo e(url('/listaDepto/')); ?>" ,'scrollbars=yes, width=800, height=1000, titlebar=no'); 
}
</script>
<script>
function ventanaI(id)
{
ventana1=window.open("<?php echo e(url('/listaDeptoI/')); ?>" ,'scrollbars=yes, width=800, height=1000, titlebar=no'); 
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
      $(document).ready(function() {
    $('#departamentos').DataTable({
    
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