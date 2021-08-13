<?php $__env->startSection('content'); ?>


 <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.min.css" rel="stylesheet">

  </head>

  <body>

   <nav id="top" style="background-color: #333;">
  <div class="container">
  <div class="row">
  <div class="col-md-3 text-center">
  <a href=""><img src="img/pgues.png" title="Programacion.net" class="logo"></a>
  </div>
  <div>
  <div class="col-md-3 col-md-offset-7 text-center hidden-md hidden-lg">
  <div class="panel-group" role="tablist">
  <div class="panel panel-default">
  <div class="login-vertical login-vertical-collapsed">
  
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>
  </nav>

  
    <!-- Page Header -->
    <header class="masthead" style="background-image : url('img/home-bg.jpg');background-repeat:repeat;">
    
      <div class="overlay"></div>
      <div class="container">
  <!--   
      <div style="position:absolute;
    bottom:1px;
    left: :1px; ">
<img src="<?php echo e(URL::asset('img/minerva.png')); ?>" width="100px; height=100px; "></img>
</div> -->

        <div class="row">
          <div class="col-lg-8 col-md-8">
            <div class="site-heading">
              <div class="panel panel-primary col-lg-12 col-md-offset-3" style="background-color: rgb(0,0,0); opacity: 0.6" >

                <div class="panel-heading ">Acceso al sistema</div>
                <div class="panel-body center-block">
                    <form class="form-horizontal"  role="form" method="POST" action="<?php echo e(url('/login')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">Correo</label>

                            <div class="input-group col-md-6">
                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                <input id="email" type="email" class="form-control" onblur="fill()" name="email" value="<?php echo e(old('email')); ?>">

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="input-group col-md-6">
                                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                <input id="password" type="password" class="form-control" name="password">

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('select-carrera') ? ' has-error' : ''); ?>">
                            <label for="select-carrera" class="col-md-4 control-label">Carrera</label>

                            <div class="input-group col-md-6">
                                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                <select name="select-carrera" onchange="fill_roles()" class="form-control select2able" id="select-carrera" ></select>

                                <?php if($errors->has('select-carrera')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('select-carrera')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('select-rol') ? ' has-error' : ''); ?>">
                            <label for="select-rol" class="col-md-4 control-label">Rol</label>

                            <div class="input-group col-md-6">
                                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>
                                <select name="select-rol" class="form-control select2able" id="select-rol"></select>

                                <?php if($errors->has('select-rol')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('select-rol')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordar Contraseña
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-btn fa-sign-in"></i> Iniciar
                                </button>

                                <a class="btn btn-link" href="<?php echo e(url('/password/reset')); ?>">Recuperar Contraseña?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
   
    <!-- Footer -->


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/clean-blog.min.js"></script>

  </body>

  


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>