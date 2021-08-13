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
      <h3>Listado de Solicitudes        
       
       </h3>

      
    </div>
  </div>

<?php echo Form::open (array('url'=>'ues/solis','method'=>'POST','autocomplete'=>'off')); ?>

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

    

 

<?php echo Form::close(); ?>


  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover" id="facultades">
          <thead><!--fila-->
            <th hidden=""></th><!--celda-->
            <th>N°</th>
         <th>Solicitud</th>
         
           
            <th>Opciones</th><!--celda-->           
          </thead>
          <?php $cont=1; ?>
          <?php foreach($enunciado as $enu): ?>
          <tr><!--fila simple-->
             <td hidden=""><?php echo e($enu->id); ?></td><!--celda sencilla-->
            <td><?php echo $cont; $cont++ ?></td>
            <td>
            <?php foreach($solicitud as $sol): ?>
            <?php if($sol->idsolicitud==$enu->idsolicitud): ?>
            <?php echo e($sol->nombre); ?>:
            <?php endif; ?>
            <?php endforeach; ?>
             <?php foreach($rol as $rl): ?>
            <?php if($rl->idrol==$enu->idrol): ?>
            <?php echo e($rl->nombre); ?>

            <?php endif; ?>
            <?php endforeach; ?>
          </td>
           
                    
          
              <td>

                        

                        <a href="" data-target="#modal-edit-<?php echo e($enu->id); ?>" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
           

             
                                                  

            </td><!--celda-->
          </tr>
             <?php echo $__env->make('ues.solis.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
              <?php echo $__env->make('ues.solis.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>     
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
    "order":[[2,"asc"]],
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