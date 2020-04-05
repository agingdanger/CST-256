 
<?php $__env->startSection('title', 'Edit Interest Group Page'); ?>

<?php $__env->startSection('heading', 'Edit Interest Group Form'); ?>

<?php $__env->startSection('content'); ?>
	<form action="editInterestGroupPost" method="POST">
        <input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
			<h2>Edit Interest Group</h2>
			<table>
				
				<tr>
					<td></td>
                    	<td><input type="hidden" name="id" value="<?php echo e($intGroup->getId()); ?>"/>
                    	<!-- <?php echo e($errors->first('id')); ?> --></td>
            	</tr>
				
				<tr>
					<td>Interest Group Name:</td>
                    	<td><input type="text" name="name" value="<?php echo e($intGroup->getName()); ?>"/>
                    	<!-- <?php echo e($errors->first('firstname')); ?> --></td>
            	</tr>
            
                <tr>
                	<td>Description:</td>
                	<td><input type="text" name="description" style="height:125px;" value="<?php echo e($intGroup->getDescription()); ?>"/>
                	<!-- <?php echo e($errors->first('lastname')); ?> --></td>
                </tr>
                
                <tr>
                	<td>Tags:</td>
                	<td><input type="text" name="tags" value="<?php echo e($intGroup->getTags()); ?>"/>
                	<!-- <?php echo e($errors->first('username')); ?> --></td>
                </tr>
                
                <tr>
                	<td></td>
                	<td><input type="hidden" name="users_id" value="<?php echo e($intGroup->getUsers_id()); ?>"/>
                	<!-- <?php echo e($errors->first('username')); ?> --></td>
                </tr>
    				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Edit Interest Group" />
					</td>
				</tr>
			</table>
	</form> 




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>