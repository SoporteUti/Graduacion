<?php $__env->startSection('content'); ?>


    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--===============================================================================================-->
        <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
        <!--===============================================================================================-->

        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')); ?>">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('fonts/Linearicons-Free-v1.0.0/icon-font.min.css')); ?>">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/animate/animate.css')); ?>">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/css-hamburgers/hamburgers.min.css')); ?>">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/animsition/css/animsition.min.css')); ?>">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/select2/select2.min.css')); ?>">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendor/daterangepicker/daterangepicker.css')); ?>">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/util.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/main.css')); ?>">
        <!--===============================================================================================-->

    </head>

    <style type="text/css">
        p.centrado {
            text-align: center;
        }

        .hola {

            right: 0px;
            bottom: 0px;
        }

    </style>

    <body style="background-color: #666666;">
        <div class="limiter">
            <div>
                <div class="wrap-login100">


                    <form class="login100-form validate-form hola" role="form" method="POST"
                        action="<?php echo e(url('/login')); ?>">



                        <?php echo e(csrf_field()); ?>

                        <p class="centrado"> <img src="<?php echo e(asset('img/ic_launcher144.png')); ?>" text-align="center"
                                width="100px" height="100px"></img></p>



                        <span class="login100-form-title p-b-43 offset-6">
                            Acceso al sistema
                        </span>

                        <label>Correo</label>
                        <div <?php echo e($errors->has('email') ? ' has-error' : ''); ?>

                            data-validate="Valid email is required: ex@abc.xyz">
                            <input id="email" class="form-inline form-control" type="email" name="email"
                                value="<?php echo e(old('email')); ?>">


                            <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                            <?php endif; ?>

                        </div>

                        <label>Contraseña</label>
                        <div <?php echo e($errors->has('password') ? ' has-error' : ''); ?> data-validate="Password is required">
                            <input class="form-inline form-control" type="password" id="password" name="password">



                            <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>

                        <!-- <div class="form-group<?php echo e($errors->has('select-carrera') ? ' has-error' : ''); ?>">
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
                            </div> -->

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-0">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Recordar Contraseña
                                    </label>
                                </div>
                            </div>


                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn">
                                    Iniciar
                                </button>



                                <a class="btn btn-link" href="<?php echo e(url('/password/reset')); ?>">Recuperar Contraseña</a>


                                <a class="btn btn-link" href="<?php echo e(url('/getapp')); ?>"> Descargar Aplicación Móvil </a>

                            </div>


                        </div>


                        <div class="form-group">

                        </div>
                    </form>



                    <div class="login100-more" style="background-image : url('img/fondo4-1.jpg');">
                    </div>
                </div>
            </div>
        </div>





        <!--===============================================================================================-->
        <script src="<?php echo e(asset('vendor/jquery/jquery-3.2.1.min.js')); ?>"></script>
        <!--===============================================================================================-->
        <script src="<?php echo e(asset('vendor/animsition/js/animsition.min.js')); ?>"></script>
        <!--===============================================================================================-->
        <script src="<?php echo e(asset('vendor/bootstrap/js/popper.js')); ?>"></script>
        <script src="<?php echo e(asset('vendor/bootstrap/js/bootstrap.min.js')); ?>"></script>
        <!--===============================================================================================-->
        <script src="<?php echo e(asset('vendor/select2/select2.min.js')); ?>"></script>
        <!--===============================================================================================-->
        <script src="<?php echo e(asset('vendor/daterangepicker/moment.min.js')); ?>"></script>
        <script src="<?php echo e(asset('vendor/daterangepicker/daterangepicker.js')); ?>"></script>
        <!--===============================================================================================-->
        <script src="<?php echo e(asset('vendor/countdowntime/countdowntime.js')); ?>"></script>
        <!--===============================================================================================-->
        <script src="<?php echo e(asset('js/main.js')); ?>"></script>

    </body>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>