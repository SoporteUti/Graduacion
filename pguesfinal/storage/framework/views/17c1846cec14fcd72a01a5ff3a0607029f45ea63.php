<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</head>
<body>
    <style>
        @media  only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }

            .footer {
                width: 100% !important;
            }
        }

        @media  only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
    <h2>Hola <?php echo e($persona->nombres); ?>, gracias por registrarte en <strong>Apg.UES</strong> !</h2>
    <p>Por favor asegurate de copiar tus credenciales. Podrás acceder al sistema cuando se te asigne un rol</p>
    

    <p>Tus credenciales para que inicies sesión son las siguientes:</p>

    <p>Correo: <strong><?php echo e($user->email); ?></strong> </p>
    <p>Contraseña: <strong><?php echo e($temp->password); ?></strong> </p>

    

    <p><strong>Nota:</strong> <h>Por seguridad cuando inicies sesión recomendamos que modifiques tus credenciales.</h></p>
    <footer>© <?php echo e(date('Y')); ?>  Todos los Derechos Reservados.</footer>
</body>
</html>

