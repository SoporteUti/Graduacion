<?php $__env->startSection('contenido'); ?>


    <!-- jQuery 2.1.4 -->
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
        
  <div class="row" >
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
      <h3>Listado de Docentes   <button class="btn btn-success" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#modalagregardocente">Nuevo</button>  <a><button onclick="ventana()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> Activos </button></a>   <a><button onclick="ventanaI()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> Inactivos </button></a></h3>
    </div>
  </div>




<?php echo Form::open (array('url'=>'ues/docentes','method'=>'POST','autocomplete'=>'off', 'files' =>'true')); ?>

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
    
<div id="modalagregardocente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form id="docente" role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
 

        <div class="modal-header" style="background:#00a65a; color:white">

         <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>-->

          <h4 class="modal-title">Agregar Docente</h4>

        </div>





        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">

          <div class="box-body">

           <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
             <div class="form-group"> 
            <label>Foto</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                     <input type="file" name="foto" accept="image/x-png,image/gif,image/jpeg" placeholder="Foto">
                </div>          
            </div>
            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
              <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group"> 
        <label>Nombres (*)</label>
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
              <input type="text" onKeyPress="return soloLetras(event)" class="form-control" id="nombres" name="nombres" placeholder="Ingresar Nombres" autofocus>
            </div>      
      </div>
            </div>

         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
             <div class="form-group"> 
                <label>Apellidos (*)</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input  type="text" onKeyPress="return soloLetras(event)" class="form-control" id="apellidos" name="apellidos" placeholder="Ingresar Apellidos" autofocus>
                </div>          
            </div>
          </div> 




      <!-- ENTRADA PARA CATEGORIA -->
      <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
      <div class="form-group"> 
        <label>Categoría(*)</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-bank"></i></span>
              <select name="categoria" id="categoria" class="form-inline form-control">

              <option value="">[Seleccione]
                
               </option>
            
                <?php foreach($categorias as $cat): ?>
                   <?php if($cat->condicion==1): ?>
                     <option value="<?php echo e($cat->idcategoria); ?>"><?php echo e($cat->nombrecat); ?>

                
               </option>
                    <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>      
      </div>
      </div>

 <!-- ENTRADA PARA TELEFONO -->

            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
            <div class="form-group"> 
      <label>Teléfono(*)</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-phone"></i></span>
              <input id="telefono" type="text"  required  data-inputmask="'mask':'9999-9999'" data-mask class="form-control" name="telefono"  placeholder="Ingresar teléfono" autofocus>
            </div>      
      </div>
      </div>


    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
           <div class="form-group"> 
      <label>Correo(*)</label>
        <div class="input-group">         
          <span class="input-group-addon"><i class="fa fa-at"></i></span>
              <input type="text"  class="form-control" name="correo" id="correo" placeholder="Ingresar correo" autofocus>
            </div>      
      </div>
      </div>


  <!-- ENTRADA PARA TITULO -->
         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
            <div class="form-group"> 
            <label>Título(*)</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
                    <input type="text"  class="form-control" name="titulo" id="titulo" placeholder="Ingresar titulo" autofocus>
                </div>          
            </div>
            </div>


                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

           <div class="form-group" > 
        
        <label>Sexo(*)</label>          
             <div class="input-group">    
                      
        <span class="input-group-addon"><i class="fa fa-child"></i></span>
              <select name="sexo" id="sexo" class="form-inline form-control">

              <option value="">[Seleccione]</option>
                
              <option value="0">Femenino</option>
                    <option value="1">Masculino</option>
              </select>

            </div> 
                  </div>  
                </div>

       <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group" >   
                    <label>DUI</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                    <input type="text" data-inputmask="'mask':'99999999-9'"  data-mask placeholder="Ingresar Dui" class="form-control" id="dui" name="dui" autofocus>
                </div>         
            </div>
            </div>
           


            <!-- ENTRADA PARA CORREO -->
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
                  <div class="form-group"> 
                  <label>Fecha de Nacimiento </label>   
       <div class="input-group">  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input type="date" class="form-control" id="fechanac" name="fechanac" autofocus>
                </div>         
            </div>
              </div>



        
      

          <div class="col-lg-12 col-md-12 col-xs-12 col-sm-6" >
            <div class="form-group" >   
                    <label>Dirección</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresar Dirección" autofocus>
                </div>         
            </div>
            </div>

            <!-- ENTRADA PARA LUGAR DE TRABAJO -->
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-6" >
            <div class="form-group"> 
            <label>Lugar de trabajo</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-briefcase"></i></span>
                    <input type="text"  class="form-control" name="lugar" id="lugar" placeholder="Ingresar lugar de trabajo" autofocus>
                </div>          
            </div>
            </div>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button id="cancel1" type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i>  Salir</button>
          <button id="cancel" class="btn btn-warning" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>  Guardar</button>

        </div>

       

      </form>

    </div>

  </div>


</div>


 

<?php echo Form::close(); ?>



  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
       <div class="table-responsive">
        <table class="table table-striped table-bordered table-condensed table-hover" id="docentes">
          <thead><!--fila-->
            <th hidden=""></th><!--celda-->
            <th>N°</th>
            <th>Nombre</th><!--celda-->
            <th>Apellidos</th><!--celda-->
            <th>Teléfono</th><!--celda-->
            <th>Correo</th><!--celda-->
            <th>Estado</th><!--celda-->
            <th>Opciones</th><!--celda-->           
          </thead>
          <?php $cont=1; ?>
          <?php foreach($personas as $per): ?>
          <?php foreach($docentes as $doc): ?>
          <?php if($per->idpersona==$doc->idpersona): ?>

            
          <tr><!--fila simple-->
            <td><?php echo $cont; $cont++ ?></td>
            <td hidden=""><?php echo e($doc->iddocente); ?></td><!--celda sencilla-->
            <td><?php echo e($per->nombres); ?></td><!--celda sencilla-->
            <td><?php echo e($per->apellidos); ?></td><!--celda sencilla-->
            <td><?php echo e($per->telefono); ?></td><!--celda sencilla-->
            <td><?php echo e($per->correo); ?></td><!--celda sencilla-->


                        <td> <?php if($per->condicion==true): ?> Activo 
                         <?php else: ?>
                        Inactivo
                        <?php endif; ?> </td><!--celda sencilla-->
            <td>
              
              

        
<?php if($per->condicion==true): ?>
                        <a href="" data-target="#modal-edit-<?php echo e($per->idpersona); ?>" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                       <a href="" data-target="#modal-ver-<?php echo e($per->idpersona); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        <a href="" data-target="#modal-delete-<?php echo e($per->idpersona); ?>" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>

                        <a><button onclick="ventanaP('<?php echo e($per->idpersona); ?>')" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i></button></a>
<?php else: ?>
                        <a href=""  data-target="" data-toggle="modal">
                        <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>

                       <a href="" data-target="#modal-ver-<?php echo e($per->idpersona); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>

                        <a href="" data-target="#modal-modalup-<?php echo e($per->idpersona); ?>" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>

                        <a><button onclick="ventanaP('<?php echo e($per->idpersona); ?>')" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i></button></a>


    <?php endif; ?>        

             
                                                  

            </td><!--celda-->
          </tr>
                     <?php echo $__env->make('ues.docentes.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('ues.docentes.edit', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                     <?php echo $__env->make('ues.docentes.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    <?php echo $__env->make('ues.docentes.modalup', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
                    <?php endif; ?>
          <?php endforeach; ?>
          <?php endforeach; ?>
        </table>
      </div><!--div tabla responsiva-->
  </div>
  </div>


<?php $__env->startSection('script'); ?>

<script type="text/javascript">
function ventana(id)
{
ventana1=window.open("<?php echo e(url('/listaDoc/')); ?>"  ,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>

</script>
<script type="text/javascript">
function ventanaI(id)
{
ventana1=window.open("<?php echo e(url('/listaDocI/')); ?>"  ,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>

<script type="text/javascript">
function ventanaP(id)
{
ventana1=window.open("<?php echo e(url('ues/docentes/perfilDoc')); ?>"+"/"+ id,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>

  <script type="text/javascript">
        $(document).ready(function () {
        $("#cancel").on("click", function () {
            $('.form-group').removeClass('has-success has-error');
           $('.glyphicon ').remove();  
          // $('#docentes').reload();      
        });
    });
</script>
<script type="text/javascript">
        $(document).ready(function () {
        $("#cancel1").on("click", function () {
            $('.form-group').removeClass('has-success has-error');
           $('.glyphicon ').remove();
           //$('#docentes').reload();      
        });
    });
</script>


  <script>
$(document).ready(function() {

$('#modalagregardocente').on('show.bs.modal', function () {
            $(this).removeData('bs.modal');
            $('#modalagregardocente').bootstrapValidator('resetForm', true);
              $.ajax(
                     {
                         url: "ues/docentes",
                         type: "GET",
                         success:function(text) 
                         {
                             
                         },
                         error: function(jqXHR, textStatus, errorThrown) 
                         {     
                         }
                     });
            });

    $('#modalagregardocente').bootstrapValidator({
        feedbackIcons: {
            /*valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
        },
        fields: {
                nombres: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese los nombres del Docente '
                    },
                    stringLength: {
                        min: 3,
                        max: 75,
                        message: ' '
                    } 

                }
            },  
            apellidos: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese los apellidos del Docente'
                    },
                    stringLength: {
                        min: 3,
                        max: 16,
                        message: ' '
                    } 

                }
            }, 


            dui: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el Dui del Docente'
                    },
                    stringLength: {
                        min: 10,
                        max: 10,
                        message: 'Ingrese el Dui del Docente'
                         },  
                    remote: {
                        message: 'El Dui no está disponible',
                        url: "<?php echo e(url('/duiDocValid/')); ?>",
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
                        message: 'Ingrese el telefono del Docente'
                    },
                    stringLength: {
                        min: 9,
                        max: 9,
                        message: 'Ingrese el telefono del Docente'
                         },  
                    remote: {
                        message: 'El telefono no está disponible',
                        url: "<?php echo e(url('/telefonoDocValid/')); ?>",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "<?php echo e(csrf_token()); ?>";
                          }
                        }
                        
                    }
                    
                }
            }, 


            titulo: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el codigo del Departamento '
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: ''
                    } 

                }
            }, 

            lugar: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el codigo del Departamento '
                    },
                    stringLength: {
                        min: 5,
                        max: 100,
                        message: ' '
                    } 

                }
            }, 


            ///correo

             correo: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el email del Docente'
                    }, 
                    emailAddress: {
                       message: 'El correo electronico no es valido'
                       } ,  
                    remote: {
                        message: 'correo no disponible',
                        url: "<?php echo e(url('/correoDocValid/')); ?>",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "<?php echo e(csrf_token()); ?>";
                          }
                        }
                        
                    }
                    
                }
            }, 


            ////correo




             correootro: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el email del Docente'
                    }, 
                    emailAddress: {
                       message: 'El correo electronico no es valido'
                       }   
                }
              },

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
                    var formulario = document.getElementById('docente');
                    formulario.submit();
                  }
                },
                warning: {
                  button: "Cancelar",
                  className: "btn-warning",
                  callback: function() {
                                     
                  }
                }
              }
            });
        });


});
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
    $('#docentes').DataTable({
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
      $("#modal-ver-<?php echo e($per->idpersona); ?>").on('hidden.bs.modal', function() {
        DataTableCargaDatos();
    });
    </script>

 

<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>