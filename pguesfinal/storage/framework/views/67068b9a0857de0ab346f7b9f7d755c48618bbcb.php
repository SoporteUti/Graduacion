 

<?php $__env->startSection('contenido'); ?>

 

	<div class="row" >
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
			<h3>Listado de Estudiantes   <button data-backdrop="static" data-keyboard="false" class="btn btn-success" data-toggle="modal" data-target="#modalagregarestudiante"><i class="fa fa-file-o"></i> Nuevo</button>
      <a><button onclick="ventana()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> Activos </button></a>  
      <a><button onclick="ventanaI()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> Inactivos </button></a> </h3>
		</div>
	</div>
 



<?php echo Form::open (array('url'=>'ues/estudiantes','method'=>'POST','autocomplete'=>'off', 'files' =>'true')); ?>

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
    
<div id="modalagregarestudiante" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form id="estudiante" role="form" method="post"  enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
 

        <div class="modal-header" style="background:#00a65a; color:white">

          

          <h4 class="modal-title">Agregar Estudiante</h4>

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
            <label>Carné (*)</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-database"></i></span>
                    <input id="carnet" type="text"    class="form-control" name="carnet" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="7" placeholder="Ingresar Carné" autofocus>
                </div>          
            </div>
            </div>
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
            <!-- ENTRADA PARA TELEFONO -->

            <!-- ENTRADA PARA LA DIRRECCION -->
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

           <div class="form-group" > 
			  
				<label>Sexo (*)</label>          
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
                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >
           <div class="form-group"> 
              <label>Carrera (*)</label>
                <div class="input-group">                   
                    <span class="input-group-addon"><i class="fa fa-bank"></i></span>
                    <select name="carrera" id="carrera" class="form-inline form-control">

                    <option value="">[Seleccione]
                        
                    </option>
                
                    <?php foreach($carreras as $car): ?>
                    <?php if($car->condicion==true &&  $car->idcarrera==Auth::user()->idcarrera): ?>
<option value="<?php echo e($car->idcarrera); ?>"><?php echo e($car->nombre); ?>

                        
                    </option>
<?php endif; ?>
 <?php endforeach; ?>
                    </select>
                </div>          
            </div>
</div>
<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

            <div class="form-group" > 
              <label>Correo electrónico (*)</label>
                <div class="input-group" >     
                            
                <span class="input-group-addon"><i class="fa fa-at"></i></span><input type="text" placeholder="Ingresar Correo electrónico"  class="form-control" id="correo" name="correo" autofocus>
                    
                </div> 
                 </div>  
                </div> 
                	<div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >
                  <div class="form-group"> 
                  <label>Fecha de Nacimiento </label>   
			 <div class="input-group">  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input type="date" class="form-control" id="fechanac" name="fechanac" autofocus>
                </div>         
            </div>
              </div>

                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

<div class="form-group" >   
                    <label>Dirección</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresar Dirección" autofocus>
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
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                    <div class="form-group" >
                         <label>Teléfono </label>
             <div class="input-group" >     
                        
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                   <input type="text"  placeholder="Ingresar Teléfono" class="form-control" id="telefono" name="telefono" data-inputmask="'mask':'9999-9999'" data-mask autofocus>
                </div>       
            </div>
</div>
            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

 <div class="form-group" >  
                    <label>Fecha de Egreso</label>
             <div class="input-group" >  
                 
                    <span class="input-group-addon"><i class="  fa fa-calendar-o"></i></span>
                    <input type="date" class="form-control" id="anioegreso" name="anioegreso"  placeholder="Ingresar fecha de Egreso" autofocus>
                </div>         
            </div>
            </div>
                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

          <div class="form-group" > 
                              <label>Programa de Refuerzo Académico</label>             

              <div class="input-group" >     
                <span class="input-group-addon"><i class="  fa fa-info"></i></span>
                    <select name="pera" id="pera" class="form-inline form-control">

                    <option value="0">No</option>
                        
                    <option value="1">Si</option>
                   
                    </select>

                </div>
                  </div>  
                 </div>


                   <div class="col-lg-6 col-md-6 col-xs-12 col-sm-6" >

                       <div class="form-group" >
                                    <label>Servicio Social Estudiantil</label>             

             <div class="input-group" >    
                
                    <span class="input-group-addon"><i class="  fa fa-info"></i></span><select name="horassociales" id="horassociales" class="form-inline form-control">

                    <option value="0">No</option>
                        
                    <option value="1">Si</option>
                    
                    </select>

                </div>       
            </div>
</div>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >

<div class="form-group" >   
                                     <label>Carta de Egreso</label>

             <div class="input-group" >  
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                    <input type="file" accept="application/pdf" id="carta" name="carta" class="form-control">
                </div>         
              </div>

  </div>
<div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >

<div class="form-group" >   
                                     <label>Curriculum Vitae</label>

             <div class="input-group" >  
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                    <input type="file" accept="application/pdf" id="curriculum" name="curriculum" class="form-control">
                </div>         
              </div>

  </div>
  <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12" >

<div class="form-group" >   
                                     <label>Partida de Nacimiento</label>

             <div class="input-group" >  
                    <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span>
                    <input type="file" accept="application/pdf" id="partida" name="partida" class="form-control">
                </div>         
              </div>

  </div>
<div>
  <p style="color:red;">     Nota: El proceso de guardado puede tardar dependiendo el tama&ntilde;o de los archivos.</p>
</div>
          </div>



        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button id="cancel1" type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
          <button class="btn btn-warning" id="cancel" type="reset"> <i class="fa fa-times"></i> Cancelar</button>
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
      <?php /* TABLE */ ?>
      <table class="table table-striped table-bordered table-condensed table-hover" id="est">
        <thead>
          <tr>
            <th>N°</th>
            <th>Carné</th>
            <th>Nombres</th><!--celda-->
            <th>Apellidos</th><!--celda-->
            <th>Carrera</th><!--celda-->
            <th>Estado</th><!--celda-->
            <th>Opciones</th><!--celda--> 
          </tr>
        </thead>
        <tbody>
          <?php 
            $index =0;
           ?>
          <?php foreach($estudiante as $element): ?>
          <tr>
            <td><?php echo e($index=$index+1); ?></td>
            <td><?php echo e($element->carnet); ?></td>
            <td><?php echo e($element->persona->nombres); ?></td>
            <td><?php echo e($element->persona->apellidos); ?></td>
            <td><?php echo e($element->carrera->nombre); ?></td>
            <td><?php if($element->persona->condicion): ?> Activo
            <?php else: ?>
            Inactivo
          <?php endif; ?></td>
            <td>
              <?php if($element->persona->condicion==true): ?>
            <a href="" data-target="#modal-edit-<?php echo e($element->persona->idpersona); ?>" data-toggle="modal">
              <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
              <a href="" data-target="#modal-ver-<?php echo e($element->persona->idpersona); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
              <a href="" data-target="#modal-delete-<?php echo e($element->persona->idpersona); ?>" data-toggle="modal"><button class="btn btn-danger"><i class="fa fa-caret-square-o-down"></i></button></a>
               <a><button onclick="ventanaP('<?php echo e($element->persona->idpersona); ?>')" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i></button></a>
              <?php else: ?>
              <a href=""  data-target="" data-toggle="modal">
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button></a>
                <a href="" data-target="#modal-ver-<?php echo e($element->persona->idpersona); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                <a href="" data-target="#modal-modalup-<?php echo e($element->persona->idpersona); ?>" data-toggle="modal"><button class="btn btn-info"><i class="fa fa-caret-square-o-up"></i></button></a>
                <a><button onclick="ventanaP('<?php echo e($element->persona->idpersona); ?>')" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i></button></a>
                <?php endif; ?>
            </td>
          </tr>
           <?php echo $__env->make('ues.estudiantes.ver',['per'=>$element->persona,'est'=>$element], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('ues.estudiantes.edit',['per'=>$element->persona,'est'=>$element], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('ues.estudiantes.modal',['per'=>$element->persona,'est'=>$element], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->make('ues.estudiantes.modalup',['per'=>$element->persona,'est'=>$element], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <?php endforeach; ?>
        </tbody>
      </table>
      <?php /* TABLE */ ?>
    </div><!--div tabla responsiva-->
  </div>
</div>
  <?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
        $(function () {
          $('#est').DataTable({
            "language": {
              "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
          });
        });
      </script>
<script>
      $(document).ready(function() {
    $('#esdddt').DataTable({
    
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

<script>
function ventana(id)
{
ventana1=window.open("<?php echo e(url('/listaEst/')); ?>" ,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>

<script>
function ventanaI(id)
{
ventana1=window.open("<?php echo e(url('/listaEstI/')); ?>" ,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>

<script type="text/javascript">
function ventanaP(id)
{
ventana1=window.open("<?php echo e(url('ues/estudiantes/perfilEst')); ?>"+"/"+ id,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>


<script >
    function showAlert(info, message, title='')­{
toastr[info] (message, title,{
"closeButton": false,
"debug": false,
"newestOnTop": false,
"progressBar": true,
"positionClass": "toast-top-right",
"preventDuplicates":­ false,
"onclick": null,
"showDuration": "300",
"hideDuration": "1000",
"timeOut": "5000",
"extendedTimeOut": "1000",
"showEasing": "swing",
"hideEasing": "linear",
"showMethod": "fadeIn",
"hideMethod": "fadeOut"
});
}
</script>
<script>
    <?php if(Session::has('message')): ?>
        var type = "<?php echo e(Session::get('alert-type', 'info')); ?>";
        switch(type){
            case 'info':
               // toastr.info("<?php echo e(Session::get('message')); ?>");
               toastr['info'] ('<?php echo e(Session::get('message')); ?>', null,{
"closeButton": false,
"debug": false,
"newestOnTop": false,
"progressBar": true,
"positionClass": "toast-top-right",
"preventDuplicates":­ false,
"onclick": null,
"showDuration": "300",
"hideDuration": "1000",
"timeOut": "5000",
"extendedTimeOut": "1000",
"showEasing": "swing",
"hideEasing": "linear",
"showMethod": "fadeIn",
"hideMethod": "fadeOut"
});
             
                break;
            
            case 'warning':
                showAlert('warning','<?php echo e(Session::get('message')); ?>');
                break;
            case 'success':
               showAlert('success','<?php echo e(Session::get('message')); ?>');
                 break;
            case 'error':
                showAlert('error','<?php echo e(Session::get('message')); ?>');
                break;
        }
    <?php endif; ?>



    </script>


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


 $('#modalagregarestudiante').on('show.bs.modal', function () {
             // $('#addNodeForm').bootstrapValidator('resetForm', true);
            $(this).removeData('bs.modal');
            $('#modalagregarestudiante').bootstrapValidator('resetForm', true);
              $.ajax(
                     {
                         url: "ues/estudiantes",
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


    $('#modalagregarestudiante').bootstrapValidator({
       feedbackIcons: {
           /* valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'*/
        },
        fields: {
                nombres: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el nombre del Estudiante '
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
                        message: 'Ingrese los apellidos del Estudiante '
                    },
                    stringLength: {
                        min: 3,
                        max: 75,
                        message: ' '
                    } 

                }
            },  
            carnet: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el carnet del Estudiante'
                    },
                    stringLength: {
                        min: 7,
                        max: 7,
                        message: 'Ingrese el carnet del Estudiante'
                         },  
                    remote: {
                        message: 'El carnet no está disponible',
                        url: "<?php echo e(url('/carnetEstValid/')); ?>",
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
                        message: 'Ingrese el telefono del Estudiante'
                    },
                    stringLength: {
                        min: 9,
                        max: 9,
                        message: 'Ingrese el telefono del Estudiante'
                         },  
                    remote: {
                        message: 'El telefono no está disponible',
                        url: "<?php echo e(url('/telefonoEstValid/')); ?>",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "<?php echo e(csrf_token()); ?>";
                          }
                        }
                        
                    }
                    
                }
            }, 
             dui: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el Dui del Estudiante'
                    },
                    stringLength: {
                        min: 9,
                        max: 10,
                        message: 'Ingrese el Dui del Estudiante'
                         },  
                    remote: {
                        message: 'El Dui no está disponible',
                        url: "<?php echo e(url('/duiEstValid/')); ?>",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "<?php echo e(csrf_token()); ?>";
                          }
                        }
                        
                    }
                    
                }
            }, 

            fechanac: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione fecha'
                    },
    
                        
                  
                }
            }, 
            correo: {
                validators: {
                    notEmpty: {
                        message: 'Ingrese el correo electronico del Estudiante'
                    }, 
                    emailAddress: {
                       message: 'El correo electronico no es valido'
                       } ,  
                    remote: {
                        message: 'correo no disponible',
                        url: "<?php echo e(url('/correoEstValid/')); ?>",
                        type: 'POST',
                        data: {
                          _token: function() {
                            return "<?php echo e(csrf_token()); ?>";
                          }
                        }
                        
                    }
                    
                }
            }, 
            carrera: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione carrera'
                    },
    
                        
                  
                }
            }, 
            sexo: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione sexo'
                    },
    
                        
                  
                }
            }, 
            pera: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione'
                    },
    
                        
                  
                }
            }, 
            horassociales: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione'
                    },
    
                        
                  
                }
            }, 
              anioegreso: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione la fecha '
                    },
                }
            }, 

            curriculum: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione un archivo'
                    },
    
                        
                  
                }
            }, 

            partida: {
                validators: {
                    notEmpty: {
                        message: 'Seleccione un archivo'
                    },
    
                        
                  
                }
            }, 



            direccion: {
                validators: {
                    isnotEmpty: {
                        message: 'Ingrese la direccion '
                    },
                    stringLength: {
                        min: 15,
                        max: 256,
                        message: 'Debe ingresar una dirección mas específica'
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
                    var formulario = document.getElementById('estudiante');
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



<script>
        $(window).load(function(){
            $('#estudiantes').removeAttr('style');
        })
    </script>



<script>
    function soloNumeros(e){
    var key = window.Event ? e.which : e.keyCode
    return (key >= 48 && key <= 57)
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
document.getElementById('correo').addEventListener('input', function() {
    campo = event.target;
    valido = document.getElementById('emailOK');
        
    emailRegex = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    //Se muestra un texto a modo de ejemplo, luego va a ser un icono
    if (emailRegex.test(campo.value)) {
      valido.innerText = "válido";
    } else {
      valido.innerText = "incorrecto";
    }
// });
// </script>
//    <script type="text/javascript">
//         $(function () {
//           $('.dataTable1').DataTable({
//             "language": {
//               "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
//             }
//           });
//         });
//       </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>