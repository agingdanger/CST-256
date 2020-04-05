<?php $__env->startSection('title', 'Login Page'); ?>

<?php $__env->startSection('content'); ?>
		<form action = "login" method = "POST">
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token()?>"/>
			<h2>Login</h2>
			<table>
				<tr>
					<td>Username: </td>
					<td><input type = "text" name = "username" /><?php echo e($errors->first('username')); ?></td>
				</tr>
				
				<tr>
					<td>Password: </td>
					<td><input type = "password" name = "password" /><?php echo e($errors->first('password')); ?></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Login" />
					</td>
				</tr>
			</table>
		</form>
		
    	<?php if($errors->count() != 0): ?>
        	<h5>List of Errors</h5>
        	<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
        		<?php echo e($message); ?> <br /> 
        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
    	<?php endif; ?>
		
		
		<p><?php 
// 		if ($message == null)
//		echo $message;?></p>
		
		<a href="registration">Register Here</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>