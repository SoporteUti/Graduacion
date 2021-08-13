<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('htmlheader_title'); ?> | SISPG</title>
    <?php /* <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'> */ ?>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <style>
        @import  url('https://fonts.googleapis.com/css?family=Montserrat:400,600,700');
@import  url('https://fonts.googleapis.com/css?family=Catamaran:400,800');
.error-container {
  text-align: center;
  font-size: 180px;
  font-family: 'Catamaran', sans-serif;
  font-weight: 800;
  margin: 20px 15px;
}
.error-container > span {
  display: inline-block;
  line-height: 0.7;
  position: relative;
  color: #FFB485;
}
.error-container > span > span {
  display: inline-block;
  position: relative;
}
.error-container > span:nth-of-type(1) {
  perspective: 1000px;
  perspective-origin: 500% 50%;
  color: #F0E395;
}
.error-container > span:nth-of-type(1) > span {
  transform-origin: 50% 100% 0px;
  transform: rotateX(0);
  animation: easyoutelastic 8s infinite;
}

.error-container > span:nth-of-type(3) {
  perspective: none;
  perspective-origin: 50% 50%;
  color: #D15C95;
}
.error-container > span:nth-of-type(3) > span {
  transform-origin: 100% 100% 0px;
  transform: rotate(0deg);
  animation: rotatedrop 8s infinite;
}
@keyframes  easyoutelastic {
  0% {
    transform: rotateX(0);
  }
  9% {
    transform: rotateX(210deg);
  }
  13% {
    transform: rotateX(150deg);
  }
  16% {
    transform: rotateX(200deg);
  }
  18% {
    transform: rotateX(170deg);
  }
  20% {
    transform: rotateX(180deg);
  }
  60% {
    transform: rotateX(180deg);
  }
  80% {
    transform: rotateX(0);
  }
  100% {
    transform: rotateX(0);
  }
}

@keyframes  rotatedrop {
  0% {
    transform: rotate(0);
  }
  10% {
    transform: rotate(30deg);
  }
  15% {
    transform: rotate(90deg);
  }
  70% {
    transform: rotate(90deg);
  }
  80% {
    transform: rotate(0);
  }
  100% {
    transform: rotateX(0);
  }
}
    




/* demo stuff */
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
body {
  background-color: #f4f4f4;
  margin-bottom: 50px;
}
html, button, input, select, textarea {
    font-family: 'Montserrat', Helvetica, sans-serif;
    color: #bbb;
}
h1 {
  text-align: center;
  margin: 30px 15px;
}
.zoom-area { 
  max-width: 490px;
  margin: 30px auto 30px;
  font-size: 19px;
  text-align: center;
}
.link-container {
  text-align: center;
}
a.more-link {
  text-transform: uppercase;
  font-size: 13px;
    background-color: #bbb;
    padding: 10px 15px;
    border-radius: 0;
    color: #fff;
    display: inline-block;
    margin-right: 5px;
    margin-bottom: 5px;
    line-height: 1.5;
    text-decoration: none;
  margin-top: 50px;
  letter-spacing: 1px;
}
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="<?php echo e(asset('/bootstrap/css/bootstrap.css')); ?> " type="text/css" >

    
</head>
<body>
    <div id="app">
        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            <?php echo $__env->yieldContent('main-content'); ?>
        </section><br>
<br>
<br>
<br>
<div class="link-container">
  Puedes regresar a la <a href='<?php echo e(url('/home')); ?>'>pàgina principal</a> o puedes volver a 
  <a href="javascript:history.back()">Atràs</a>
</div>
    </div>
    <script src="<?php echo e(asset('/plugins/jquery/jquery.js')); ?>"></script>
    <script src="<?php echo e(asset('/plugins/bootstrap/js/bootstrap.js')); ?>"></script>
</body>
</html>