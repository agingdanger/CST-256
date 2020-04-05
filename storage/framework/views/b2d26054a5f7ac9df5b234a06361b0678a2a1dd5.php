<html lang="en">
<script type="text/javascript" src="<?php echo e(URL::asset('js/bootstrap.js')); ?>"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<link rel="stylesheet" href="<?php echo e(URL::asset('css/bootstrap.min.css')); ?>" />


<head>
	<title><?php echo $__env->yieldContent('title'); ?></title>
</head>

<body>
<?php echo $__env->make('layouts.templates.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div align="center">
		<?php echo $__env->yieldContent('content'); ?>
	</div>
<?php echo $__env->make('layouts.templates.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</body>
</html>