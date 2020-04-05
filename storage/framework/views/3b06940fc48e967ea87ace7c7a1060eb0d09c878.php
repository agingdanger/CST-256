 
<?php $__env->startSection('title', 'Account Page'); ?>

<?php $__env->startSection('content'); ?>
<h2>Account Page</h2>
<!-- <div> -->
<!-- <table> -->
<!-- 	<tr> -->
<!-- 		<td>First Name:</td> -->
<!-- 		<td><?php echo e($user->getFirstname()); ?></td> -->
<!-- 	</tr> -->
	
<!-- 	<tr> -->
<!-- 		<td>Last Name:</td> -->
<!-- 		<td><?php echo e($user->getLastname()); ?></td> -->
<!-- 	</tr> -->
<!-- 	<tr> -->
<!-- 		<td>Username:</td> -->
<!-- 		<td><?php echo e($user->getUsername()); ?></td> -->
<!-- 	</tr> -->

<!-- 	<tr> -->
<!-- 		<td>Email:</td> -->
<!-- 		<td><?php echo e($user->getEmail()); ?></td> -->
<!-- 	</tr> -->

<!-- 	<tr> -->
<!-- 		<td>Phone:</td> -->
<!-- 		<td><?php echo e($user->getPhone()); ?></td> -->
<!-- 	</tr> -->
	
<!-- 	<tr> -->
<!-- 		<td>Role:</td> -->
<!-- 		<td><?php echo e($user->getRole()); ?></td> -->
<!-- 	</tr> -->
<!-- </table> -->
<!-- </div> -->
<div>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Profile Card</h5>
    <div class="row">
        <h6 class="mx-auto card-subtitle mb-1 text-muted"><?php echo e($user->getFirstName()); ?></h6>
        <h6 class="mx-auto card-subtitle mb-1 text-muted"><?php echo e($user->getLastName()); ?></h6>
    </div>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>

<?php if(Session::get('role') === "admin"): ?>
	<?php echo $__env->make('admin.adminButtons', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>