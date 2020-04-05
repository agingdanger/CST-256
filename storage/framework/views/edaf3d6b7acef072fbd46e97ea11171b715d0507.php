<?php $__env->startSection('title', 'Add Education Page'); ?>

<?php $__env->startSection('content'); ?>
		<form action = "addEducation" method = "POST">
			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
			<h2>Add Education History</h2>
			<table>
				<tr>
					<td>School: </td>
					<td><input type = "text" name = "edname" /><?php echo e($errors->first('edname')); ?></td>
				</tr>
				
				<tr>
					<td>Years: </td>
					<td><input type = "number" name = "edyears" placeholder="Range: 1 - 80"/><?php echo e($errors->first('edyears')); ?></td>
				</tr>
				
				<tr>
					<td>Major: </td>
					<td><input type = "text" name = "edmajor" /><?php echo e($errors->first('edmajor')); ?></td>
				</tr>
				
				<tr>
					<td>Minor: </td>
					<td><input type = "text" name = "edminor" /><?php echo e($errors->first('edminor')); ?></td>
				</tr>
				
				<tr>
					<td>Start Year: </td>
					<td><input type = "number" name = "edstartyear" value="1970" placeholder="YYYY"/><?php echo e($errors->first('edstartyear')); ?></td>
				</tr>
				
				<tr>
					<td>End Year: </td>
					<td><input type = "number" name = "edendyear" value="2020" placeholder="YYYY"/><?php echo e($errors->first('edendyear')); ?></td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "userid" value = "<?php echo e(Session::get('userID')); ?>"/></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Add Education History" />
					</td>
				</tr>
			</table>
		</form>
		<a href="myportfolio">Click here to go back to the portfolio page.</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>