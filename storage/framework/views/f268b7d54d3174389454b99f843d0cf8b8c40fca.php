 
<?php $__env->startSection('title', 'Account Page'); ?>


<?php $__env->startSection('content'); ?>
	<form action="addJobPost" method="POST">
        <input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
			<h2>Add a Job</h2>
			<table>
				<tr>
					<td>Job Name: </td>
					<td><input type = "text" name = "jobname" /><?php echo e($errors->first('jobname')); ?></td>
				</tr>
				
				<tr>
					<td>Description: </td>
					<td><input type = "text" name = "description" /><?php echo e($errors->first('description')); ?></td>
				</tr>
				
				<tr>
					<td>Company: </td>
					<td><input type = "text" name = "company" /><?php echo e($errors->first('company')); ?></td>
				</tr>
				
				<tr>
					<td>Requirements: </td>
					<td><input type = "text" name = "requirements" /><?php echo e($errors->first('requirements')); ?></td>
				</tr>
				
				<tr>
					<td>Skills: </td>
					<td><input type = "text" name = "skills" /><?php echo e($errors->first('skills')); ?></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Post a Job" />
					</td>
				</tr>
			</table>
	</form>
	<a href="viewJobs">Click here to go back to view the list of Jobs page.</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>