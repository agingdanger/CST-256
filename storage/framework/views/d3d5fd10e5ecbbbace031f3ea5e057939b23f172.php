 
<?php $__env->startSection('title', 'Job Result Page'); ?>

<?php $__env->startSection('content'); ?>
<?php if(Session::get('role') == "admin"): ?>	
    <form action="jobPost" method="POST">
        <input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
        <input class = "btn btn-primary" type = "submit" value = "Click Here to Add a Job" />
    </form>
<?php endif; ?>
	
<div>
    <table id="" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>View Job</th>
                    <th>Job Name</th>
                    <th>Description</th>
                    <th>Company</th>
                    <th>Requirements</th>
                    <th>Skills</th>
                    <?php if(Session::get('role') == "admin"): ?>
                    	<th>Modify</th>
                    	<th>Delete</th>
                    <?php endif; ?>
                </tr>
            </thead>
            
            <tbody>
                <?php $__currentLoopData = $searchData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
            		<td>
            			<form action="viewJob" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
                			<input type = "hidden" name = "id" value = "<?php echo e($job['ID']); ?>"/>
                			<input type = "hidden" name = "job" value = "<?php echo e($job['NAME']); ?>"/>
                			<input type = "hidden" name = "description" value = "<?php echo e($job['DESCRIPTION']); ?>"/>
                			<input type = "hidden" name = "company" value = "<?php echo e($job['COMPANY']); ?>"/>
                			<input type = "hidden" name = "requirements" value = "<?php echo e($job['REQUIREMENTS']); ?>"/>
                			<input type = "hidden" name = "skills" value = "<?php echo e($job['SKILLS']); ?>"/>
                			<input class = "btn btn-primary" type = "submit" value = "View Job" />
            			</form>
            		</td>
            		<td><?php echo e($job['NAME']); ?></td>
            		<td><?php echo e($job['DESCRIPTION']); ?></td>
            		<td><?php echo e($job['COMPANY']); ?></td>
            		<td><?php echo e($job['REQUIREMENTS']); ?></td>
            		<td><?php echo e($job['SKILLS']); ?></td>
            		
            		<?php if(Session::get('role') == "admin"): ?>
                		<td>
                	
                			 <form action="viewEditJob" method="POST">
                    			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>" />
                    			<input type = "hidden" name = "id" value = "<?php echo e($job['ID']); ?>"/>
                    			<input type = "hidden" name = "jobname" value = "<?php echo e($job['NAME']); ?>"/>
                    			<input type = "hidden" name = "description" value = "<?php echo e($job['DESCRIPTION']); ?>"/>
                    			<input type = "hidden" name = "company" value = "<?php echo e($job['COMPANY']); ?>"/>
                    			<input type = "hidden" name = "requirements" value = "<?php echo e($job['REQUIREMENTS']); ?>"/>
                    			<input type = "hidden" name = "skills" value = "<?php echo e($job['SKILLS']); ?>"/>
            					<input class = "btn btn-info" type = "submit" value = "Edit" />
                			</form>
            		
                		</td>
                		
                		<td>
                			<form action="jobDelete" method="POST">
                    			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
                    			<input type = "hidden" name = "id" value = "<?php echo e($job['ID']); ?>"/>
                    			<input type = "hidden" name = "job" value = "<?php echo e($job['NAME']); ?>"/>
                    			<input type = "hidden" name = "description" value = "<?php echo e($job['DESCRIPTION']); ?>"/>
                    			<input type = "hidden" name = "company" value = "<?php echo e($job['COMPANY']); ?>"/>
                    			<input type = "hidden" name = "requirements" value = "<?php echo e($job['REQUIREMENTS']); ?>"/>
                    			<input type = "hidden" name = "skills" value = "<?php echo e($job['SKILLS']); ?>"/>
                    			<input class = "btn btn-danger" type = "submit" value = "Delete"  onclick="javascript:return confirm('Are you sure you want to delete this User?')"/>                			
                			</form>
                		</td>
            		<?php endif; ?>
            	</tr>
        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        	</tbody>
    </table>
    
    <h3>Matched Jobs:</h3>
    
    <table id="" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>View Job</th>
                    <th>Matching Skill</th>
                    <th>Job Name</th>
                    <th>Description</th>
                    <th>Company</th>
                    <th>Requirements</th>
                    <th>Skills</th>
                    <?php if(Session::get('role') == "admin"): ?>
                    	<th>Modify</th>
                    	<th>Delete</th>
                    <?php endif; ?>
                </tr>
            </thead>
            
            <tbody>
                <?php $__currentLoopData = $matchData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
            		<td>
            			<form action="viewJob" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
                			<input type = "hidden" name = "id" value = "<?php echo e($job['ID']); ?>"/>
                			<input type = "hidden" name = "job" value = "<?php echo e($job['NAME']); ?>"/>
                			<input type = "hidden" name = "description" value = "<?php echo e($job['DESCRIPTION']); ?>"/>
                			<input type = "hidden" name = "company" value = "<?php echo e($job['COMPANY']); ?>"/>
                			<input type = "hidden" name = "requirements" value = "<?php echo e($job['REQUIREMENTS']); ?>"/>
                			<input type = "hidden" name = "skills" value = "<?php echo e($job['SKILLS']); ?>"/>
                			<input class = "btn btn-primary" type = "submit" value = "View Job" />
            			</form>
            		</td>
            		<td><?php echo e($job[0]); ?></td>
            		<td><?php echo e($job['NAME']); ?></td>
            		<td><?php echo e($job['DESCRIPTION']); ?></td>
            		<td><?php echo e($job['COMPANY']); ?></td>
            		<td><?php echo e($job['REQUIREMENTS']); ?></td>
            		<td><?php echo e($job['SKILLS']); ?></td>
            		
            		<?php if(Session::get('role') == "admin"): ?>
                		<td>
                	
                			 <form action="viewEditJob" method="POST">
                    			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>" />
                    			<input type = "hidden" name = "id" value = "<?php echo e($job['ID']); ?>"/>
                    			<input type = "hidden" name = "jobname" value = "<?php echo e($job['NAME']); ?>"/>
                    			<input type = "hidden" name = "description" value = "<?php echo e($job['DESCRIPTION']); ?>"/>
                    			<input type = "hidden" name = "company" value = "<?php echo e($job['COMPANY']); ?>"/>
                    			<input type = "hidden" name = "requirements" value = "<?php echo e($job['REQUIREMENTS']); ?>"/>
                    			<input type = "hidden" name = "skills" value = "<?php echo e($job['SKILLS']); ?>"/>
            					<input class = "btn btn-info" type = "submit" value = "Edit" />
                			</form>
            		
                		</td>
                		
                		<td>
                			<form action="jobDelete" method="POST">
                    			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
                    			<input type = "hidden" name = "id" value = "<?php echo e($job['ID']); ?>"/>
                    			<input type = "hidden" name = "job" value = "<?php echo e($job['NAME']); ?>"/>
                    			<input type = "hidden" name = "description" value = "<?php echo e($job['DESCRIPTION']); ?>"/>
                    			<input type = "hidden" name = "company" value = "<?php echo e($job['COMPANY']); ?>"/>
                    			<input type = "hidden" name = "requirements" value = "<?php echo e($job['REQUIREMENTS']); ?>"/>
                    			<input type = "hidden" name = "skills" value = "<?php echo e($job['SKILLS']); ?>"/>
                    			<input class = "btn btn-danger" type = "submit" value = "Delete"  onclick="javascript:return confirm('Are you sure you want to delete this User?')"/>                			
                			</form>
                		</td>
            		<?php endif; ?>
            	</tr>
        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        	</tbody>
    </table>
    
</div>

<script>
$(document).ready( function () {
    $('table.display').DataTable();
} );
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>