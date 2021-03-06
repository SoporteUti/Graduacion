



<?php $__env->startSection('contenido'); ?>
<script src="<?php echo e(asset('js/jQuery-2.1.4.min.js')); ?>"></script>







	<div class="row" >
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" >
			<h3>Listado de Estudiantes en P.E.R.A. <a><button onclick="ventana()" class="btn btn-primary"><i class="fa fa-file-pdf-o" ></i> P D F </button></a> </h3>
			 
          
       

			
		</div>
	</div>




<?php echo Form::open (array('url'=>'ues/estudiantesPera','method'=>'POST','autocomplete'=>'off', 'files' =>'true')); ?>

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

     

    </div>

  </div>


</div>
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

 

<?php echo Form::close(); ?>







	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			 <div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover" id="estudiantes">
					<thead><!--fila-->
						<th hidden=""></th><!--celda-->
                        <th>N??</th>
            			<th>Carn??</th><!--celda-->
						<th>Nombres</th><!--celda-->
						<th>Apellidos</th><!--celda-->	
						<th>Carrera</th><!--celda-->
						<th>Opciones</th><!--celda-->			
					</thead>
                    <?php $cont=1; ?>
					<?php foreach($persona as $per): ?>
                    <?php if($per->condicion==true): ?>
                    <?php foreach($estudiante as $est): ?>
                    <?php if($est->idpersona==$per->idpersona && $est->idcarrera==Auth::user()->idcarrera): ?>
                    <?php if($est->pera==true): ?>
					<tr><!--fila simple-->
                    <td><?php echo $cont; $cont++ ?></td>
                    <td hidden=""><?php echo e($est->idestudiante); ?></td>						
						<td><?php echo e($est->carnet); ?></td>
						<td><?php echo e($per->nombres); ?></td>
                        <td><?php echo e($per->apellidos); ?></td><!--celda sencilla-->
						<?php foreach($carreras as $car): ?>
        				<?php if($car->idcarrera==$est->idcarrera): ?>

						<td><?php echo e($car->nombre); ?></td>
						<?php endif; ?>
						<?php endforeach; ?>
						<!--celda sencilla-->
						
						
                    <td>
							

                       
                       <a href="" data-target="#modal-ver-<?php echo e($per->idpersona); ?>" data-toggle="modal"><button class="btn btn-success"><i class="fa fa-eye"></i></button></a>
                        



        		

						</td><!--celda-->
					</tr>
                       <?php echo $__env->make('ues.estudiantesPera.ver', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                       <?php endif; ?>
                    <?php endif; ?>
                      <?php endforeach; ?>

                      <?php endif; ?>
                    <?php endforeach; ?>
				</table>
			</div><!--div tabla responsiva-->
			
	
 
   </div>
	</div>

 


<script src="<?php echo e(asset('plugins/input-mask/jquery.inputmask.js')); ?>"></script>
      <script src="<?php echo e(asset('plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
      <script src="<?php echo e(asset('plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>
      <script src="<?php echo e(asset('plugins/plantilla.js')); ?>"></script>


<script>
        $(window).load(function(){
            $('#estudiantes').removeAttr('style');
        })
    </script>


<script>
      $(document).ready(function() {
    $('#estudiantes').DataTable({
    
    "language":{
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ning??n dato disponible en esta tabla",
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
        "sLast":     "??ltimo",
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
    function soloNumeros(e){
    var key = window.Event ? e.which : e.keyCode
    return (key >= 48 && key <= 57)
}
</script>
<script>
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " ??????????abcdefghijklmn??opqrstuvwxyz";
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
      valido.innerText = "v??lido";
    } else {
      valido.innerText = "incorrecto";
    }
});
</script>

<script>
function ventana(id)
{
ventana1=window.open("<?php echo e(url('/listaEstPera/')); ?>" ,'scrollbars=yes,width=800,height=1000,titlebar=no'); 
}
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('plantillas.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>