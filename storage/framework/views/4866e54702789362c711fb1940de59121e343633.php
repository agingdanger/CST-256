 <?php $__env->startSection('title', 'Account Page'); ?>

<?php $__env->startSection('content'); ?>
<h2>Account Page</h2>

<div>
  <table id="userTable" class = "table table-striped table-bordered" style= "width:100%">
		<tr>
			<td>First Name:</td>
			<td><?php echo e($user['FIRST_NAME']); ?></td>
		</tr>
		<tr>
			<td>Last Name:</td>
			<td><?php echo e($user['LAST_NAME']); ?></td>
		</tr>
		<tr>
			<td>Username:</td>
			<td><?php echo e($user['USERNAME']); ?></td>
		</tr>
		
		
		<?php if(Session::get('userID') != $user['ID'] && Session::get('role') == "admin"): ?>
		<tr>
			<td>Password:</td>
			<td><?php echo e($user['PASSWORD']); ?></td>
		</tr>
		<?php endif; ?>

		<tr>
			<td>Email:</td>
			<td><?php echo e($user['EMAIL']); ?></td>
		</tr>

		<tr>
			<td>Phone:</td>
			<td><?php echo e($user['PHONE']); ?></td>
		</tr>

		<tr>
			<td>Role:</td>
			<td><?php echo e($user['ROLE']); ?></td>
		</tr>
	</table>

	
</div>
<!-- Collapse Button -->


 <a class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#editContent">Edit</a>

<div class="collapse navbar-collapse" id="editContent">
    <table id="userTable" class="table table-striped table-bordered" style= "width:95%">
<!--             <thead> -->
<!--                 <tr> -->
<!--                     <th>First Name</th> -->
<!--                     <th>Last Name</th> -->
<!--                     <th>Username</th> -->
<!--                     <?php if(Session::get('userID') != $user['ID'] || Session::get('role') == "admin"): ?> -->
<!--                     	<th>Password</th> -->
<!--                     <?php endif; ?> -->
<!--                     <th>Email</th> -->
<!--                     <th>Phone</th> -->
<!--         			<?php if(Session::get('role') == "admin" && Session::get('userID') != $user['ID']): ?> -->
<!--                     <th>Role</th> -->
<!--                     <?php endif; ?> -->
<!--                 </tr> -->
<!--             </thead> -->
<!--             <tbody> -->
                <form action="userEdit" method="POST">
                    <div class = "form-row">
                    	<div class="form-group">
                    		<label for="firstname">First Name</label>
                    		<input type="text" id= "firstname" class="form-control input-normal" name = "firstname" value = "<?php echo e($user['FIRST_NAME']); ?>" />
                    	</div>
            			<div class="form-group">
            				<label for="lastname">Last Name</label>
							<input type="text" class="form-control input-normal" name = "lastname" value = "<?php echo e($user['LAST_NAME']); ?>"/>
						</div>
        				<div class="form-group">
        					<label for="username">Username</label>
                				<input type = "text" class="form-control input-normal" name = "username" value = "<?php echo e($user['USERNAME']); ?>"/>
            			</div>
                		<?php if(Session::get('userID') == $user['ID'] || Session::get('role') == "admin"): ?>
                			<div class="form-group">
                				<label for="password">Password</label>
            					<input type = "text" class="form-control input-normal" name = "password" value = "<?php echo e($user['PASSWORD']); ?>"/>
            				</div>
            			<?php endif; ?>
            			<div class="form-group">
            				<label for="email">Email</label>
            				<input type = "text" class="form-control input-normal" name = "email" value = "<?php echo e($user['EMAIL']); ?>"/>
            			</div>
            			<div class="form-group">
            				<label for="phone">Phone</label>
            				<input type = "text" class="form-control input-normal" name = "phone" value = "<?php echo e($user['PHONE']); ?>"/>
            			</div>
            			<?php if(Session::get('role') == "admin" && Session::get('userID') != $user['ID']): ?>
                			<div class="form-group">
                				<label for="role">Role</label>
                				<input type = "text" class="form-control input-normal" name = "role" value = "<?php echo e($user['ROLE']); ?>"/>
                			</div>
            			<?php else: ?>
            				<div class="form-group">
            					<input type= "hidden" class="form-control input-normal" name = "role" value= "<?php echo e($user['ROLE']); ?>"/>
            				</div>
        				<?php endif; ?>
        				<div class="form-group">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
            			</div>
            			<div class="form-group">
            				<input type="hidden" name = "id" value = "<?php echo e($user['ID']); ?>"/>
        				</div>
        				
        			</div>
        			<div align="center">
        					<input class = "btn btn-primary" align="center" type="submit" value = "Make Changes" />
        				</div>
            	</form>
            	
<!-- 			</tbody> -->
<!-- 	</table> -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>