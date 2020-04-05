<?php $__env->startSection('title', 'Error Page'); ?>
<?php $__env->startSection('content'); ?>
	<div>
		<p>Common Error.</p>
		<a href="welcome">Login</a>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>