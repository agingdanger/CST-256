<?php $__env->startSection('title', 'Edit a Skill Page'); ?>

<?php $__env->startSection('content'); ?>
		<form action = "editSkill" method = "POST">
			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
			<h2>Edit Skill History</h2>
			<table>
				<tr>
					<td>Skill: </td>
					<td><input type = "text" name = "skillname" value = "<?php echo e($skill->getName()); ?>"/></td>
				</tr>
	
				<tr>
					<td><input type = "hidden" name = "userid" value = "<?php echo e(Session::get('userID')); ?>"/></td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "skillid" value = "<?php echo e($skill->getId()); ?>"/></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Edit" />
					</td>
				</tr>
			</table>
		</form>
		<a href="myportfolio">Click here to go back to the portfolio page.</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>