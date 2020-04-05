 
<?php $__env->startSection('title', 'Admin User Page'); ?>
<?php $__env->startSection('content'); ?>

<div>
    <table id="userTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Modify</th>
                    <th>Delete</th>
                    <th>Suspend</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
            		<td>
            			<form action="viewProfile" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
                			<input type = "hidden" name = "id" value = "<?php echo e($user['ID']); ?>"/>
                			<input type = "hidden" name = "firstname" value = "<?php echo e($user['FIRST_NAME']); ?>"/>
                			<input type = "hidden" name = "lastname" value = "<?php echo e($user['LAST_NAME']); ?>"/>
                			<input type = "hidden" name = "username" value = "<?php echo e($user['USERNAME']); ?>"/>
                			<input type = "hidden" name = "password" value = "<?php echo e($user['PASSWORD']); ?>"/>
                			<input type = "hidden" name = "email" value = "<?php echo e($user['EMAIL']); ?>"/>
                			<input type = "hidden" name = "phone" value = "<?php echo e($user['PHONE']); ?>"/>
                			<input type = "hidden" name = "role" value = "<?php echo e($user['ROLE']); ?>"/>
                			<input class = "btn btn-primary" type = "submit" value = "<?php echo e($user['ID']); ?>" />
            			</form>
            		</td>
            		<td><?php echo e($user['FIRST_NAME']); ?></td>
            		<td><?php echo e($user['LAST_NAME']); ?></td>
            		<td><?php echo e($user['USERNAME']); ?></td>
            		<td><?php echo e($user['PASSWORD']); ?></td>
            		<td><?php echo e($user['EMAIL']); ?></td>
            		<td><?php echo e($user['PHONE']); ?></td>
            		<td><?php echo e($user['ROLE']); ?></td>
            		
            		<td>
            	
            			 <form action="adminEdit" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>" />
                			<input type = "hidden" name = "id" value = "<?php echo e($user['ID']); ?>"/>
                			<input type = "hidden" name = "firstname" value = "<?php echo e($user['FIRST_NAME']); ?>"/>
                			<input type = "hidden" name = "lastname" value = "<?php echo e($user['LAST_NAME']); ?>"/>
                			<input type = "hidden" name = "username" value = "<?php echo e($user['USERNAME']); ?>"/>
                			<input type = "hidden" name = "password" value = "<?php echo e($user['PASSWORD']); ?>"/>
                			<input type = "hidden" name = "email" value = "<?php echo e($user['EMAIL']); ?>"/>
                			<input type = "hidden" name = "phone" value = "<?php echo e($user['PHONE']); ?>"/>
                			<input type = "hidden" name = "role" value = "<?php echo e($user['ROLE']); ?>"/>
        					<input class = "btn btn-info" type = "submit" value = "Edit" />
            			</form>
        		
            		</td>
            		
            		<td>
            			<form action="adminDelete" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
                			<input type = "hidden" name = "id" value = "<?php echo e($user['ID']); ?>"/>
                			<input type = "hidden" name = "firstname" value = "<?php echo e($user['FIRST_NAME']); ?>"/>
                			<input type = "hidden" name = "lastname" value = "<?php echo e($user['LAST_NAME']); ?>"/>
                			<input type = "hidden" name = "username" value = "<?php echo e($user['USERNAME']); ?>"/>
                			<input type = "hidden" name = "password" value = "<?php echo e($user['PASSWORD']); ?>"/>
                			<input type = "hidden" name = "email" value = "<?php echo e($user['EMAIL']); ?>"/>
                			<input type = "hidden" name = "phone" value = "<?php echo e($user['PHONE']); ?>"/>
                			<input type = "hidden" name = "role" value = "<?php echo e($user['ROLE']); ?>"/>
                			<input class = "btn btn-danger" type = "submit" value = "Delete"  onclick="javascript:return confirm('Are you sure you want to delete this User?')"/>                			
            			</form>
            		</td>
            		<td>
            	
            			 <form action="adminSuspend" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>" />
                			<input type = "hidden" name = "id" value = "<?php echo e($user['ID']); ?>"/>
                			<input type = "hidden" name = "firstname" value = "<?php echo e($user['FIRST_NAME']); ?>"/>
                			<input type = "hidden" name = "lastname" value = "<?php echo e($user['LAST_NAME']); ?>"/>
                			<input type = "hidden" name = "username" value = "<?php echo e($user['USERNAME']); ?>"/>
                			<input type = "hidden" name = "password" value = "<?php echo e($user['PASSWORD']); ?>"/>
                			<input type = "hidden" name = "email" value = "<?php echo e($user['EMAIL']); ?>"/>
                			<input type = "hidden" name = "phone" value = "<?php echo e($user['PHONE']); ?>"/>
                			<input type = "hidden" name = "role" value = "<?php echo e($user['ROLE']); ?>"/>
                				<input class = "btn btn-warning" type = "submit" value = "Suspend" onclick="javascript:return confirm('Are you sure you want to change this user status?')" />
            			</form>
        		
            		</td>
            		
            		
            	</tr>
        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        	</tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>
<script>
$(document).ready(function() {
    $('#userTable').DataTable();
    	  
});


</script>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>