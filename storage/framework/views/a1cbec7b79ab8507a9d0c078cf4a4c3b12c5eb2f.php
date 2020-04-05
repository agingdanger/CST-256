<?php $__env->startSection('title', 'List of Interest Groups'); ?>


<?php $__env->startSection('heading', 'Interest Group'); ?>


<?php $__env->startSection('content'); ?>
    

	<table id="table_id" class="table table-striped table-bordered" style="width:95%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Tags</th>
            <th>Join</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $intGroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($group['NAME']); ?></td>
            <td><?php echo e($group['DESCRIPTION']); ?></td>
            <td><?php echo e($group['TAGS']); ?></td>
            <td>
            	<form action="joinInterestGroup" method="POST">
                	<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
                	<input type = "hidden" name = "id" value = "<?php echo e($group['ID']); ?>"/>
                	<input type = "hidden" name = "users_id" value = "<?php echo e(Session::get('userID')); ?>"/>
                	<input class = "btn btn-warning" type = "submit" value = "Join" onclick="javascript:return confirm('Are you sure you want join this Group?')"/>
            	</form>
            </td>
            <?php if(Session::get('userID') == $group['users_ID'] || Session::get('role') == "admin"): ?>	
            <td>
            	<form action="editInterestGroupForm" method="POST">
                	<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
                	<input type = "hidden" name = "id" value = "<?php echo e($group['ID']); ?>"/>
                	<input type = "hidden" name = "name" value = "<?php echo e($group['NAME']); ?>"/>
                	<input type = "hidden" name = "description" value = "<?php echo e($group['DESCRIPTION']); ?>"/>
                	<input type = "hidden" name = "tags" value = "<?php echo e($group['TAGS']); ?>"/>
                	<input type = "hidden" name = "users_id" value = "<?php echo e($group['users_ID']); ?>"/>
                	<input class = "btn btn-primary" type = "submit" value = "Edit" />
            	</form>
            </td>
            <td>
            	<form action="deleteInterestGroup" method="POST">
                	<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
                	<input type = "hidden" name = "id" value = "<?php echo e($group['ID']); ?>"/>
                	<input type = "hidden" name = "name" value = "<?php echo e($group['NAME']); ?>"/>
                	<input type = "hidden" name = "description" value = "<?php echo e($group['DESCRIPTION']); ?>"/>
                	<input type = "hidden" name = "tags" value = "<?php echo e($group['TAGS']); ?>"/>
                	<input type = "hidden" name = "users_id" value = "<?php echo e($group['users_ID']); ?>"/>
                	<input class = "btn btn-danger" type = "submit" value = "Delete" onclick="javascript:return confirm('Are you sure you want to delete this Group?')"/>
            	</form>
            </td>
            <?php endif; ?>
            
            
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<table id="table_id" class="table table-striped table-bordered" style="width:95%">
    <thead>
        <tr>
            <th>Users</th>
        </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <tr>
            <td><?php echo e($user['USERNAME']); ?></td>
    </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>