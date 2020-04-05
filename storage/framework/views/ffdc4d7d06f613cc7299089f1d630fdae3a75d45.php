<?php $__env->startSection('title', 'Portfolio Page'); ?>

<?php $__env->startSection('content'); ?>
<h1 align="center">Portfolio</h1>
<br>
<br>
<h3 align="center">Job History</h3>
<div>
    <table id="jobTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Description</th>
                    <th>Awards</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            	<?php if(count($jobs) > 0): ?>
                <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
            		<td><?php echo e($job['NAME']); ?></td>
            		<td><?php echo e($job['POSITION']); ?></td>
            		<td><?php echo e($job['DESCRIPTION']); ?></td>
            		<td><?php echo e($job['AWARDS']); ?></td>
            		<td><?php echo e($job['START_DATE']); ?></td>
            		<td><?php echo e($job['END_DATE']); ?></td>
            		
            		<td>
            	
            			 <form action="userRouteJobEdit" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>" />
                			<input type = "hidden" name = "jobid" value = "<?php echo e($job['ID']); ?>"/>
                			<input type = "hidden" name = "jobname" value = "<?php echo e($job['NAME']); ?>"/>
                			<input type = "hidden" name = "jobposition" value = "<?php echo e($job['POSITION']); ?>"/>
                			<input type = "hidden" name = "jobdescription" value = "<?php echo e($job['DESCRIPTION']); ?>"/>
                			<input type = "hidden" name = "jobawards" value = "<?php echo e($job['AWARDS']); ?>"/>
                			<input type = "hidden" name = "jobstartdate" value = "<?php echo e($job['START_DATE']); ?>"/>
                			<input type = "hidden" name = "jobenddate" value = "<?php echo e($job['END_DATE']); ?>"/>
                			<input type = "hidden" name = "userid" value = "<?php echo e($job['users_ID']); ?>"/>
        					<input class = "btn btn-info" type = "submit" value = "Edit" />
            			</form>
        		
            		</td>
            		
            		<td>
            			<form action="userJobDelete" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
                			<input type = "hidden" name = "jobid" value = "<?php echo e($job['ID']); ?>"/>
		          			<input type = "hidden" name = "jobname" value = "<?php echo e($job['NAME']); ?>"/>
                			<input type = "hidden" name = "jobposition" value = "<?php echo e($job['POSITION']); ?>"/>
                			<input type = "hidden" name = "jobdescription" value = "<?php echo e($job['DESCRIPTION']); ?>"/>
                			<input type = "hidden" name = "jobawards" value = "<?php echo e($job['AWARDS']); ?>"/>
                			<input type = "hidden" name = "jobstartdate" value = "<?php echo e($job['START_DATE']); ?>"/>
                			<input type = "hidden" name = "jobenddate" value = "<?php echo e($job['END_DATE']); ?>"/>
                			<input type = "hidden" name = "userid" value = "<?php echo e($job['users_ID']); ?>"/>
                			<input class = "btn btn-danger" type = "submit" value = "Delete"  onclick="javascript:return confirm('Are you sure you want to delete this Job?')"/>                			
            			</form>
            		</td>
            		
            		
            	</tr>
        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        	<?php endif; ?>
        	</tbody>
    </table>
</div>
<div class="form-row text-center">
    <div class="col-12">
    	<a class = "btn btn-primary" href="addJobHistory">Add Another Job</a>
    </div>
 </div>
 <br>
 <br>
 <br>
 


<h3 align="center">Education History</h3>
<div>
    <table id="educationTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>School Name</th>
                    <th>Years</th>
                    <th>Major</th>
                    <th>Minor</th>
                    <th>Start Year</th>
                    <th>End Year</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            	<?php if(count($education) > 0): ?>
                <?php $__currentLoopData = $education; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
            		<td><?php echo e($ed['NAME']); ?></td>
            		<td><?php echo e($ed['YEARS']); ?></td>
            		<td><?php echo e($ed['MAJOR']); ?></td>
            		<td><?php echo e($ed['MINOR']); ?></td>
            		<td><?php echo e($ed['START_YEAR']); ?></td>
            		<td><?php echo e($ed['END_YEAR']); ?></td>
            		
            		<td>
            	
            			 <form action="userRouteEducationEdit" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>" />
                			<input type = "hidden" name = "edid" value = "<?php echo e($ed['ID']); ?>"/>
                			<input type = "hidden" name = "edname" value = "<?php echo e($ed['NAME']); ?>"/>
                			<input type = "hidden" name = "edyears" value = "<?php echo e($ed['YEARS']); ?>"/>
                			<input type = "hidden" name = "edmajor" value = "<?php echo e($ed['MAJOR']); ?>"/>
                			<input type = "hidden" name = "edminor" value = "<?php echo e($ed['MINOR']); ?>"/>
                			<input type = "hidden" name = "edstartyear" value = "<?php echo e($ed['START_YEAR']); ?>"/>
                			<input type = "hidden" name = "edendyear" value = "<?php echo e($ed['END_YEAR']); ?>"/>
                			<input type = "hidden" name = "userid" value = "<?php echo e($ed['users_ID']); ?>"/>
        					<input class = "btn btn-info" type = "submit" value = "Edit" />
            			</form>
        		
            		</td>
            		
            		<td>
            			<form action="userEducationDelete" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>"/>
                			<input type = "hidden" name = "edid" value = "<?php echo e($ed['ID']); ?>"/>
                			<input type = "hidden" name = "edname" value = "<?php echo e($ed['NAME']); ?>"/>
                			<input type = "hidden" name = "edyears" value = "<?php echo e($ed['YEARS']); ?>"/>
                			<input type = "hidden" name = "edmajor" value = "<?php echo e($ed['MAJOR']); ?>"/>
                			<input type = "hidden" name = "edminor" value = "<?php echo e($ed['MINOR']); ?>"/>
                			<input type = "hidden" name = "edstartyear" value = "<?php echo e($ed['START_YEAR']); ?>"/>
                			<input type = "hidden" name = "edendyear" value = "<?php echo e($ed['END_YEAR']); ?>"/>
                			<input type = "hidden" name = "userid" value = "<?php echo e($ed['users_ID']); ?>"/>
                			<input class = "btn btn-danger" type = "submit" value = "Delete"  onclick="javascript:return confirm('Are you sure you want to delete this School?')"/>                			
            			</form>
            		</td>
            		
            		
            	</tr>
        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        	<?php endif; ?>
        	</tbody>
    </table>
</div>

<div class="form-row text-center">
    <div class="col-12">
    	<a class = "btn btn-primary" href="addEducationHistory">Add Another School</a>
    </div>
 </div>
 <br>
 <br>
 <br>

<h3 align="center">Skills</h3>
<div>
    <table id="skillTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            	<?php if(count($skills) > 0): ?>
                <?php $__currentLoopData = $skills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $skill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
            		<td><?php echo e($skill['NAME']); ?></td>
            		
            		<td>
            	
            			 <form action="userRouteSkillEdit" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>" />
                			<input type = "hidden" name = "skillid" value = "<?php echo e($skill['ID']); ?>"/>
                			<input type = "hidden" name = "skillname" value = "<?php echo e($skill['NAME']); ?>"/>
                			<input type = "hidden" name = "userid" value = "<?php echo e($skill['users_ID']); ?>"/>
        					<input class = "btn btn-info" type = "submit" value = "Edit" />
            			</form>
        		
            		</td>
            		
            		<td>
            			<form action="userSkillDelete" method="POST">
                			<input type = "hidden" name = "_token" value = "<?php echo e(csrf_token()); ?>" />
                			<input type = "hidden" name = "skillid" value = "<?php echo e($skill['ID']); ?>"/>
                			<input type = "hidden" name = "skillname" value = "<?php echo e($skill['NAME']); ?>"/>
                			<input type = "hidden" name = "userid" value = "<?php echo e($skill['users_ID']); ?>"/>
                			<input class = "btn btn-danger" type = "submit" value = "Delete"  onclick="javascript:return confirm('Are you sure you want to delete this Skill?')"/>                			
            			</form>
            		</td>
            		
            		
            	</tr>
        	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        	<?php endif; ?>
        	</tbody>
    </table>
</div>

<div class="form-row text-center">
    <div class="col-12">
    	<a class = "btn btn-primary" href="addSkillHistory" value = "Add another Skill">Add another Skill</a>
    </div>
 </div>
 <br>
 <br>
 <br>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>