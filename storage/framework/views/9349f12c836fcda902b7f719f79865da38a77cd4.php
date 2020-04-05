 
<?php $__env->startSection('title', 'Account Page'); ?>

<?php $__env->startSection('heading', 'Edit Job Posting'); ?>

<?php $__env->startSection('content'); ?>
	<form action="editJobPost" method="PATCH">
        <input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
			<h2>Edit Job</h2>
			<table>
				
				<tr>
					<td></td>
                    	<td><input type="hidden" name="jobid" value="<?php echo e($job->getId()); ?>"/>
                    	<!-- <?php echo e($errors->first('id')); ?> --></td>
            	</tr>
				
				<tr>
					<td>Job Name:</td>
                    	<td><input type="text" name="jobname" value="<?php echo e($job->getName()); ?>"/>
                    	<!-- <?php echo e($errors->first('firstname')); ?> --></td>
            	</tr>
            
                <tr>
                	<td>Description:</td>
                	<td><input type="text" name="description" value="<?php echo e($job->getDescription()); ?>"/>
                	<!-- <?php echo e($errors->first('lastname')); ?> --></td>
                </tr>
                
                <tr>
                	<td>Company:</td>
                	<td><input type="text" name="company" value="<?php echo e($job->getCompany()); ?>"/>
                	<!-- <?php echo e($errors->first('username')); ?> --></td>
                </tr>
                
                <tr>
                	<td>Requirements:</td>
                	<td><input type="text" name="requirements" value="<?php echo e($job->getRequirements()); ?>"/>
                	<!-- <?php echo e($errors->first('password')); ?> --></td>
                </tr>
                
                <tr>
                	<td>Skills:</td>
                	<td><input type="text" name="skills" value="<?php echo e($job->getSkills()); ?>"/>
                	<!-- <?php echo e($errors->first('email')); ?> --></td>
                </tr>
    				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Edit Job" />
					</td>
				</tr>
			</table>
	</form> 




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>