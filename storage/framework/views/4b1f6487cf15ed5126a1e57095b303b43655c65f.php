<?php $__env->startSection('title', 'Add a Job Page'); ?>

<?php $__env->startSection('content'); ?>
		<form action = "addJob" method = "POST">
			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
			<h2>Add Job History</h2>
			<table>
				<tr>
					<td>Name: </td>
					<td><input type = "text" name = "jobname" /><?php echo e($errors->first('jobname')); ?></td>
				</tr>
				
				<tr>
					<td>Position: </td>
					<td><input type = "text" name = "jobposition" /><?php echo e($errors->first('jobposition')); ?></td>
				</tr>
				
				<tr>
					<td>Description: </td>
					<td><input type = "text" name = "jobdescription" /><?php echo e($errors->first('jobdescription')); ?></td>
				</tr>
				
				<tr>
					<td>Awards: </td>
					<td><input type = "text" name = "jobaward" /><?php echo e($errors->first('jobaward')); ?></td>
				</tr>
				
				<tr>
					<td>Start Date: </td>
					<td><input type = "date" name = "jobstartdate" /><?php echo e($errors->first('jobstartdate')); ?></td>
				</tr>
				
				<tr>
					<td>End Date: </td>
					<td><input type = "date" name = "jobenddate" /><?php echo e($errors->first('jobenddate')); ?></td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "userid" value = "<?php echo e(Session::get('userID')); ?>"/></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Add" />
					</td>
				</tr>
			</table>
		</form>
		<a href="myportfolio">Click here to go back to the portfolio page.</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>