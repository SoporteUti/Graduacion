<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>APGUES</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <?php /* <link href="<?php echo e(elixir('css/app.css')); ?>" rel="stylesheet"> */ ?>

</style>
</head>
<body id="app-layout">
   

    <?php echo $__env->yieldContent('content'); ?>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <?php /* <script src="<?php echo e(elixir('js/app.js')); ?>"></script> */ ?>
    <script>
        function fill() {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
            var Data = {
                email: document.getElementById('email').value,
            };

            $.ajax({
                type:'POST',
                url:"<?php echo e(url('fill')); ?>",
                data:Data,
                dataType:'json',
                success:function (data) {
                    $('#select-carrera').empty();
                    $('#select-carrera').append('<option value="-99">[Seleccione una opci??n]</option>');
                    for (var i = 0 ; i <= data['carreras'].length-1; i++) {
                        var carrera=data['carreras'][i];
                        $('#select-carrera').append('<option value="'+carrera.idcarrera+'">'+carrera.nombre+'</option>');
                    }
                },error:function (data) {
                  console.log('Error:', (data.responseText));
              }
          });
        }
        

        function fill_roles() {
            $.ajaxSetup({
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
            var Data = {
                email: document.getElementById('email').value,
                idcarrera: $('#select-carrera option:selected').val(),
            };
            console.log(JSON.stringify(Data));
            $.ajax({
                type:'POST',
                url:"<?php echo e(url('fillroles')); ?>",
                data:Data,
                dataType:'json',
                success:function (data) {
                    $('#select-rol').empty();
                    $('#select-rol').append('<option value="-99">[Seleccione una opci??n]</option>');
                    for (var i = 0 ; i <= data['roles'].length-1; i++) {
                        var rol=data['roles'][i];
                        $('#select-rol').append('<option value="'+rol.idrol+'">'+rol.nombre+'</option>');
                    }
                    
                },error:function (data) {
                  console.log('Error:', (data.responseText));
              }
          });
        }
    </script>
</body>
</html>
