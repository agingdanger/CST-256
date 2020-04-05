<?php $__env->startSection('title', 'Edit a Job Page'); ?>

<?php $__env->startSection('content'); ?>
		<form action = "editJob" method = "POST">
			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
			<h2>Edit Job History</h2>
			<table>
			
				<tr>
					<td>Name: </td>
					<td><input type = "text" name = "jobname" value = "<?php echo e($job->getName()); ?>" /><?php echo e($errors->first('name')); ?></td>
				</tr>
				
				<tr>
					<td>Position: </td>
					<td><input type = "text" name = "jobposition" value = "<?php echo e($job->getPosition()); ?>"/><?php echo e($errors->first('position')); ?></td>
				</tr>
				
				<tr>
					<td>Description: </td>
					<td><input type = "text" name = "jobdescription" value = "<?php echo e($job->getDescription()); ?>"/><?php echo e($errors->first('description')); ?></td>
				</tr>
				
				<tr>
					<td>Awards: </td>
					<td><input type = "text" name = "jobawards" value = "<?php echo e($job->getAwards()); ?>"/><?php echo e($errors->first('awards')); ?></td>
				</tr>
				
				<tr>
					<td>Start Date: </td>
					<td><input type = "date" name = "jobstartdate" value = "<?php echo e($job->getStartdate()); ?>"/><?php echo e($errors->first('sdate')); ?></td>
				</tr>
				
				<tr>
					<td>End Date: </td>
					<td><input type = "date" name = "jobenddate" value = "<?php echo e($job->getEnddate()); ?>"/><?php echo e($errors->first('edate')); ?></td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "jobid" value = "<?php echo e($job->getId()); ?>"/></td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "userid" value = "<?php echo e(Session::get('userID')); ?>"/></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Edit" />
					</td>
				</tr>
			</table>
		</form>
		<a href="welcome">Click here to go back to the profile page.</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>