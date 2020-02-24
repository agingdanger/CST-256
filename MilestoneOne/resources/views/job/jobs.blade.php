@extends('layouts.master')
@section('title', 'List of Jobs')

@section('content')
	
<div>
    <table id="userTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Job</th>
                    <th>Description</th>
                    <th>Company</th>
                    <th>Requirements</th>
                    <th>Modify</th>
                    <th>Delete</th>
                    <th>Suspend</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($jobs as $key => $job)
				<tr>
            		<td>
            			<form action="viewJob" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                			<input type = "hidden" name = "id" value = "{{$job['ID']}}"/>
                			<input type = "hidden" name = "job" value = "{{$job['JOB']}}"/>
                			<input type = "hidden" name = "description" value = "{{$job['DESCRIPTION']}}"/>
                			<input type = "hidden" name = "company" value = "{{$job['COMPANY']}}"/>
                			<input type = "hidden" name = "requirements" value = "{{$job['REQUIREMENTS']}}"/>
                			<input class = "btn btn-primary" type = "submit" value = "{{$job['ID']}}" />
            			</form>
            		</td>
            		<td>{{$job['FIRST_NAME']}}</td>
            		<td>{{$job['LAST_NAME']}}</td>
            		<td>{{v$job['USERNAME']}}</td>
            		<td>{{$user['PASSWORD']}}</td>
            		<td>{{$user['EMAIL']}}</td>
            		<td>{{$user['PHONE']}}</td>
            		<td>{{$user['ROLE']}}</td>
            		
            		<td>
            	
            			 <form action="adminEdit" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}" />
                			<input type = "hidden" name = "id" value = "{{$user['ID']}}"/>
                			<input type = "hidden" name = "firstname" value = "{{$user['FIRST_NAME']}}"/>
                			<input type = "hidden" name = "lastname" value = "{{$user['LAST_NAME']}}"/>
                			<input type = "hidden" name = "username" value = "{{$user['USERNAME']}}"/>
                			<input type = "hidden" name = "password" value = "{{$user['PASSWORD']}}"/>
                			<input type = "hidden" name = "email" value = "{{$user['EMAIL']}}"/>
                			<input type = "hidden" name = "phone" value = "{{$user['PHONE']}}"/>
                			<input type = "hidden" name = "role" value = "{{$user['ROLE']}}"/>
        					<input class = "btn btn-info" type = "submit" value = "Edit" />
            			</form>
        		
            		</td>
            		
            		<td>
            			<form action="adminDelete" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                			<input type = "hidden" name = "id" value = "{{$user['ID']}}"/>
                			<input type = "hidden" name = "firstname" value = "{{$user['FIRST_NAME']}}"/>
                			<input type = "hidden" name = "lastname" value = "{{$user['LAST_NAME']}}"/>
                			<input type = "hidden" name = "username" value = "{{$user['USERNAME']}}"/>
                			<input type = "hidden" name = "password" value = "{{$user['PASSWORD']}}"/>
                			<input type = "hidden" name = "email" value = "{{$user['EMAIL']}}"/>
                			<input type = "hidden" name = "phone" value = "{{$user['PHONE']}}"/>
                			<input type = "hidden" name = "role" value = "{{$user['ROLE']}}"/>
                			<input class = "btn btn-danger" type = "submit" value = "Delete"  onclick="javascript:return confirm('Are you sure you want to delete this User?')"/>                			
            			</form>
            		</td>
            		<td>
            	
            			 <form action="adminSuspend" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}" />
                			<input type = "hidden" name = "id" value = "{{$user['ID']}}"/>
                			<input type = "hidden" name = "firstname" value = "{{$user['FIRST_NAME']}}"/>
                			<input type = "hidden" name = "lastname" value = "{{$user['LAST_NAME']}}"/>
                			<input type = "hidden" name = "username" value = "{{$user['USERNAME']}}"/>
                			<input type = "hidden" name = "password" value = "{{$user['PASSWORD']}}"/>
                			<input type = "hidden" name = "email" value = "{{$user['EMAIL']}}"/>
                			<input type = "hidden" name = "phone" value = "{{$user['PHONE']}}"/>
                			<input type = "hidden" name = "role" value = "{{$user['ROLE']}}"/>
                				<input class = "btn btn-warning" type = "submit" value = "Suspend" onclick="javascript:return confirm('Are you sure you want to change this user status?')" />
            			</form>
        		
            		</td>
            		
            		
            	</tr>
        	@endforeach
        	</tbody>
    </table>
</div>
@endsection