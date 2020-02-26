@extends('layouts.master')
@section('title', 'Portfolio Page')

@section('content')
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
            	@if(count($jobs) > 0)
                @foreach($jobs as $key => $job)
				<tr>
            		<td>{{$job['NAME']}}</td>
            		<td>{{$job['POSITION']}}</td>
            		<td>{{$job['DESCRIPTION']}}</td>
            		<td>{{$job['AWARDS']}}</td>
            		<td>{{$job['START_DATE']}}</td>
            		<td>{{$job['END_DATE']}}</td>
            		
            		<td>
            	
            			 <form action="userRouteJobEdit" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}" />
                			<input type = "hidden" name = "jobid" value = "{{$job['ID']}}"/>
                			<input type = "hidden" name = "jobname" value = "{{$job['NAME']}}"/>
                			<input type = "hidden" name = "jobposition" value = "{{$job['POSITION']}}"/>
                			<input type = "hidden" name = "jobdescription" value = "{{$job['DESCRIPTION']}}"/>
                			<input type = "hidden" name = "jobawards" value = "{{$job['AWARDS']}}"/>
                			<input type = "hidden" name = "jobstartdate" value = "{{$job['START_DATE']}}"/>
                			<input type = "hidden" name = "jobenddate" value = "{{$job['END_DATE']}}"/>
                			<input type = "hidden" name = "userid" value = "{{$job['users_ID']}}"/>
        					<input class = "btn btn-info" type = "submit" value = "Edit" />
            			</form>
        		
            		</td>
            		
            		<td>
            			<form action="userJobDelete" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                			<input type = "hidden" name = "jobid" value = "{{$job['ID']}}"/>
		          			<input type = "hidden" name = "jobname" value = "{{$job['NAME']}}"/>
                			<input type = "hidden" name = "jobposition" value = "{{$job['POSITION']}}"/>
                			<input type = "hidden" name = "jobdescription" value = "{{$job['DESCRIPTION']}}"/>
                			<input type = "hidden" name = "jobawards" value = "{{$job['AWARDS']}}"/>
                			<input type = "hidden" name = "jobstartdate" value = "{{$job['START_DATE']}}"/>
                			<input type = "hidden" name = "jobenddate" value = "{{$job['END_DATE']}}"/>
                			<input type = "hidden" name = "userid" value = "{{$job['users_ID']}}"/>
                			<input class = "btn btn-danger" type = "submit" value = "Delete"  onclick="javascript:return confirm('Are you sure you want to delete this Job?')"/>                			
            			</form>
            		</td>
            		
            		
            	</tr>
        	@endforeach
        	@endif
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
            	@if(count($education) > 0)
                @foreach($education as $key => $ed)
				<tr>
            		<td>{{$ed['NAME']}}</td>
            		<td>{{$ed['YEARS']}}</td>
            		<td>{{$ed['MAJOR']}}</td>
            		<td>{{$ed['MINOR']}}</td>
            		<td>{{$ed['START_YEAR']}}</td>
            		<td>{{$ed['END_YEAR']}}</td>
            		
            		<td>
            	
            			 <form action="userRouteEducationEdit" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}" />
                			<input type = "hidden" name = "edid" value = "{{$ed['ID']}}"/>
                			<input type = "hidden" name = "edname" value = "{{$ed['NAME']}}"/>
                			<input type = "hidden" name = "edyears" value = "{{$ed['YEARS']}}"/>
                			<input type = "hidden" name = "edmajor" value = "{{$ed['MAJOR']}}"/>
                			<input type = "hidden" name = "edminor" value = "{{$ed['MINOR']}}"/>
                			<input type = "hidden" name = "edstartyear" value = "{{$ed['START_YEAR']}}"/>
                			<input type = "hidden" name = "edendyear" value = "{{$ed['END_YEAR']}}"/>
                			<input type = "hidden" name = "userid" value = "{{$ed['users_ID']}}"/>
        					<input class = "btn btn-info" type = "submit" value = "Edit" />
            			</form>
        		
            		</td>
            		
            		<td>
            			<form action="userEducationDelete" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                			<input type = "hidden" name = "edid" value = "{{$ed['ID']}}"/>
                			<input type = "hidden" name = "edname" value = "{{$ed['NAME']}}"/>
                			<input type = "hidden" name = "edyears" value = "{{$ed['YEARS']}}"/>
                			<input type = "hidden" name = "edmajor" value = "{{$ed['MAJOR']}}"/>
                			<input type = "hidden" name = "edminor" value = "{{$ed['MINOR']}}"/>
                			<input type = "hidden" name = "edstartyear" value = "{{$ed['START_YEAR']}}"/>
                			<input type = "hidden" name = "edendyear" value = "{{$ed['END_YEAR']}}"/>
                			<input type = "hidden" name = "userid" value = "{{$ed['users_ID']}}"/>
                			<input class = "btn btn-danger" type = "submit" value = "Delete"  onclick="javascript:return confirm('Are you sure you want to delete this School?')"/>                			
            			</form>
            		</td>
            		
            		
            	</tr>
        	@endforeach
        	@endif
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
            	@if(count($skills) > 0)
                @foreach($skills as $key => $skill)
				<tr>
            		<td>{{$skill['NAME']}}</td>
            		
            		<td>
            	
            			 <form action="userRouteSkillEdit" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}" />
                			<input type = "hidden" name = "skillid" value = "{{$skill['ID']}}"/>
                			<input type = "hidden" name = "skillname" value = "{{$skill['NAME']}}"/>
                			<input type = "hidden" name = "userid" value = "{{$skill['users_ID']}}"/>
        					<input class = "btn btn-info" type = "submit" value = "Edit" />
            			</form>
        		
            		</td>
            		
            		<td>
            			<form action="userSkillDelete" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}" />
                			<input type = "hidden" name = "skillid" value = "{{$skill['ID']}}"/>
                			<input type = "hidden" name = "skillname" value = "{{$skill['NAME']}}"/>
                			<input type = "hidden" name = "userid" value = "{{$skill['users_ID']}}"/>
                			<input class = "btn btn-danger" type = "submit" value = "Delete"  onclick="javascript:return confirm('Are you sure you want to delete this Skill?')"/>                			
            			</form>
            		</td>
            		
            		
            	</tr>
        	@endforeach
        	@endif
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

@endsection