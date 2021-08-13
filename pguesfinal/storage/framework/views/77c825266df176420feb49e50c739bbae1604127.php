Click aquí para recuperar tu contraseña <a href="<?php echo e($link = url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset())); ?>"> <?php echo e($link); ?> </a>
