@extends('layouts.master')
@section('title', 'List of Jobs')

@section('heading', 'Jobs Available')

@section('content')
	
<form action="jobPost" method="POST">
    <input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
    <input class = "btn btn-primary" type = "submit" value = "Click Here to Add a Job" />
</form>
	
<div>
    <table id="userTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Job Name</th>
                    <th>Description</th>
                    <th>Company</th>
                    <th>Requirements</th>
                    <th>Skills</th>
                    <th>Modify</th>
                    <th>Delete</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($jobs as $key => $job)
				<tr>
            		<td>
            			<form action="viewJob" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                			<input type = "hidden" name = "id" value = "{{$job['ID']}}"/>
                			<input type = "hidden" name = "job" value = "{{$job['NAME']}}"/>
                			<input type = "hidden" name = "description" value = "{{$job['DESCRIPTION']}}"/>
                			<input type = "hidden" name = "company" value = "{{$job['COMPANY']}}"/>
                			<input type = "hidden" name = "requirements" value = "{{$job['REQUIREMENTS']}}"/>
                			<input type = "hidden" name = "skills" value = "{{$job['SKILLS']}}"/>
                			<input class = "btn btn-primary" type = "submit" value = "{{$job['ID']}}" />
            			</form>
            		</td>
            		<td>{{$job['NAME']}}</td>
            		<td>{{$job['DESCRIPTION']}}</td>
            		<td>{{$job['COMPANY']}}</td>
            		<td>{{$job['REQUIREMENTS']}}</td>
            		<td>{{$job['SKILLS']}}</td>
            		
            		<td>
            	
            			 <form action="jobEdit" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}" />
                			<input type = "hidden" name = "id" value = "{{$job['ID']}}"/>
                			<input type = "hidden" name = "job" value = "{{$job['NAME']}}"/>
                			<input type = "hidden" name = "description" value = "{{$job['DESCRIPTION']}}"/>
                			<input type = "hidden" name = "company" value = "{{$job['COMPANY']}}"/>
                			<input type = "hidden" name = "requirements" value = "{{$job['REQUIREMENTS']}}"/>
                			<input type = "hidden" name = "skills" value = "{{$job['SKILLS']}}"/>
        					<input class = "btn btn-info" type = "submit" value = "Edit" />
            			</form>
        		
            		</td>
            		
            		<td>
            			<form action="jobDelete" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                			<input type = "hidden" name = "id" value = "{{$job['ID']}}"/>
                			<input type = "hidden" name = "job" value = "{{$job['NAME']}}"/>
                			<input type = "hidden" name = "description" value = "{{$job['DESCRIPTION']}}"/>
                			<input type = "hidden" name = "company" value = "{{$job['COMPANY']}}"/>
                			<input type = "hidden" name = "requirements" value = "{{$job['REQUIREMENTS']}}"/>
                			<input type = "hidden" name = "skills" value = "{{$job['SKILLS']}}"/>
                			<input class = "btn btn-danger" type = "submit" value = "Delete"  onclick="javascript:return confirm('Are you sure you want to delete this User?')"/>                			
            			</form>
            		</td>
            		
            	</tr>
        	@endforeach
        	</tbody>
    </table>
</div>
@endsection