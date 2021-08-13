<?php $__env->startSection('htmlheader_title'); ?>
Error 401 - Sin autorizaciòn
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
<h1>404 Pàgina no encontrada</h1>
<p class="zoom-area">No se ha logrado encontrar la pàgina que ha solicitado. </p>
<section class="error-container">
  <span><span>4</span></span>
  <span>0</span>
  <span><span>4</span></span>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>