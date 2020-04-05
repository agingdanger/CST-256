<?php $__env->startSection('title', 'Registration Page'); ?>

<?php $__env->startSection('content'); ?>
		<form action = "register" method = "POST">
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token()?>"/>
			<h2>Registration</h2>
			<table>
				<tr>
					<td>First Name: </td>
					<td><input type = "text" name = "firstname" /><?php echo e($errors->first('firstname')); ?></td>
				</tr>
				
				<tr>
					<td>Last Name: </td>
					<td><input type = "text" name = "lastname" /><?php echo e($errors->first('lastname')); ?></td>
				</tr>
				
				<tr>
					<td>Username: </td>
					<td><input type = "text" name = "username" /><?php echo e($errors->first('username')); ?></td>
				</tr>
				
				<tr>
					<td>Password: </td>
					<td><input type = "password" name = "password" /><?php echo e($errors->first('password')); ?></td>
				</tr>
				
				<tr>
					<td>Email: </td>
					<td><input type = "text" name = "email" /><?php echo e($errors->first('email')); ?></td>
				</tr>
				
				<tr>
					<td>Phone: </td>
					<td><input type = "text" name = "phone" /><?php echo e($errors->first('phone')); ?></td>
				</tr>
				
				<tr>
					<td>Role: </td>
					<td><input type = "text" name = "role" /><?php echo e($errors->first('role')); ?></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Register" />
					</td>
				</tr>
			</table>
		</form>
		<a href="welcome">Click here for the Login Page.</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>