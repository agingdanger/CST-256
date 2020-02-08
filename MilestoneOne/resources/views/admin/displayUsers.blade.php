@extends('layouts.master') 
@section('title', 'Admin User Page')
@section('content')

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
                @foreach($users as $key => $user)
				<tr>
            		<td>
            			<form action="viewProfile" method="POST">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                			<input type = "hidden" name = "id" value = "{{$user['ID']}}"/>
                			<input type = "hidden" name = "firstname" value = "{{$user['FIRST_NAME']}}"/>
                			<input type = "hidden" name = "lastname" value = "{{$user['LAST_NAME']}}"/>
                			<input type = "hidden" name = "username" value = "{{$user['USERNAME']}}"/>
                			<input type = "hidden" name = "password" value = "{{$user['PASSWORD']}}"/>
                			<input type = "hidden" name = "email" value = "{{$user['EMAIL']}}"/>
                			<input type = "hidden" name = "phone" value = "{{$user['PHONE']}}"/>
                			<input type = "hidden" name = "role" value = "{{$user['ROLE']}}"/>
                			<input class = "btn btn-primary" type = "submit" value = "{{$user['ID']}}" />
            			</form>
            		</td>
            		<td>{{$user['FIRST_NAME']}}</td>
            		<td>{{$user['LAST_NAME']}}</td>
            		<td>{{$user['USERNAME']}}</td>
            		<td>{{$user['PASSWORD']}}</td>
            		<td>{{$user['EMAIL']}}</td>
            		<td>{{$user['PHONE']}}</td>
            		<td>{{$user['ROLE']}}</td>
            		
            		<td>
            	
            			 <form action="viewProfile" method="POST">
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
<script>
$(document).ready(function() {
    $('#userTable').DataTable();
    	  
});


</script>