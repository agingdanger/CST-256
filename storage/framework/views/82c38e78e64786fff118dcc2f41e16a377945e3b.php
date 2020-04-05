<?php $__env->startSection('title', 'Login Page'); ?>

<?php $__env->startSection('content'); ?>

<?php
echo $message;

?>
<br>
<a href="registration">Register Here</a>
<br>
<a href="welcome">Login Here Again</a>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>