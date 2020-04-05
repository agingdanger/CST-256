<?php $__env->startSection('title', 'Edit Education Page'); ?>

<?php $__env->startSection('content'); ?>
		<form action = "editEducation" method = "POST">
			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
			<h2>Edit Education History</h2>
			<table>
				<tr>
					<td>School: </td>
					<td><input type = "text" name = "edname" value= "<?php echo e($ed->getName()); ?>" /></td>
				</tr>
				
				<tr>
					<td>Years: </td>
					<td><input type = "text" name = "edyears" value= "<?php echo e($ed->getYears()); ?>"/></td>
				</tr>
				
				<tr>
					<td>Major: </td>
					<td><input type = "text" name = "edmajor" value= "<?php echo e($ed->getMajor()); ?>"/></td>
				</tr>
				
				<tr>
					<td>Minor: </td>
					<td><input type = "text" name = "edminor" value= "<?php echo e($ed->getMinor()); ?>"/></td>
				</tr>
				
				<tr>
					<td>Start Year: </td>
					<td><input type = "text" name = "edstartyear" value= "<?php echo e($ed->getStartyear()); ?>"/></td>
				</tr>
				
				<tr>
					<td>End Year: </td>
					<td><input type = "text" name = "edendyear" value= "<?php echo e($ed->getEndyear()); ?>"/></td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "edid" value = "<?php echo e($ed->getId()); ?>"/></td>
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
		<a href="portfolio">Click here to go back to the portfolio page.</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>