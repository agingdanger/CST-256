@extends('layouts.master') @section('title', 'Account Page')

@section('content')
<h2>Account Page</h2>

<div>
	<table id="userTable" class = "table table-striped table-bordered" style= "width:100%">
		<tr>
			<td>First Name:</td>
			<td>{{$user['FIRST_NAME']}}</td>
		</tr>
		<tr>
			<td>Last Name:</td>
			<td>{{$user['LAST_NAME']}}</td>
		</tr>
		<tr>
			<td>Username:</td>
			<td>{{$user['USERNAME']}}</td>
		</tr>
		
		
		@if(Session::get('userID') != $user['ID'] && Session::get('role') == "admin")
		<tr>
			<td>Password:</td>
			<td>{{$user['PASSWORD']}}</td>
		</tr>
		@endif

		<tr>
			<td>Email:</td>
			<td>{{$user['EMAIL']}}</td>
		</tr>

		<tr>
			<td>Phone:</td>
			<td>{{$user['PHONE']}}</td>
		</tr>

		<tr>
			<td>Role:</td>
			<td>{{$user['ROLE']}}</td>
		</tr>
	</table>

	
</div>
<!-- Collapse Button -->
 <a class="navbar-toggler toggler-example" type="button" data-toggle="collapse" data-target="#editContent">Edit</a>

<div class="collapse navbar-collapse" id="editContent">
    <table id="userTable" class="table table-striped table-bordered" style= "width:98%">
<!--             <thead> -->
<!--                 <tr> -->
<!--                     <th>First Name</th> -->
<!--                     <th>Last Name</th> -->
<!--                     <th>Username</th> -->
<!--                     @if(Session::get('userID') != $user['ID'] || Session::get('role') == "admin") -->
<!--                     	<th>Password</th> -->
<!--                     @endif -->
<!--                     <th>Email</th> -->
<!--                     <th>Phone</th> -->
<!--         			@if(Session::get('role') == "admin" && Session::get('userID') != $user['ID']) -->
<!--                     <th>Role</th> -->
<!--                     @endif -->
<!--                 </tr> -->
<!--             </thead> -->
<!--             <tbody> -->
                <form action="userEdit" method="POST">
                    <div class = "form-row">
                    	<div class="form-group">
                    		<label for="firstname">First Name</label>
                    		<input type="text" id= "firstname" class="form-control input-normal" name = "firstname" value = "{{$user['FIRST_NAME']}}" />
                    	</div>
            			<div class="form-group">
            				<label for="lastname">Last Name</label>
							<input type="text" class="form-control input-normal" name = "lastname" value = "{{$user['LAST_NAME']}}"/>
						</div>
        				<div class="form-group">
        					<label for="username">Username</label>
                				<input type = "text" class="form-control input-normal" name = "username" value = "{{$user['USERNAME']}}"/>
            			</div>
                		@if(Session::get('userID') == $user['ID'] || Session::get('role') == "admin")
                			<div class="form-group">
                				<label for="password">Password</label>
            					<input type = "text" class="form-control input-normal" name = "password" value = "{{$user['PASSWORD']}}"/>
            				</div>
            			@endif
            			<div class="form-group">
            				<label for="email">Email</label>
            				<input type = "text" class="form-control input-normal" name = "email" value = "{{$user['EMAIL']}}"/>
            			</div>
            			<div class="form-group">
            				<label for="phone">Phone</label>
            				<input type = "text" class="form-control input-normal" name = "phone" value = "{{$user['PHONE']}}"/>
            			</div>
            			@if(Session::get('role') == "admin" && Session::get('userID') != $user['ID'])
                			<div class="form-group">
                				<label for="role">Role</label>
                				<input type = "text" class="form-control input-normal" name = "role" value = "{{$user['ROLE']}}"/>
                			</div>
            			@else()
            				<div class="form-group">
            					<input type= "hidden" class="form-control input-normal" name = "role" value= "{{$user['ROLE']}}"/>
            				</div>
        				@endif()
        				<div class="form-group">
                			<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
            			</div>
            			<div class="form-group">
            				<input type="hidden" name = "id" value = "{{$user['ID']}}"/>
        				</div>
        				
        			</div>
        			<div align="center">
        					<input class = "btn btn-primary" align="center" type="submit" value = "Make Changes" />
        				</div>
            	</form>
            	
<!-- 			</tbody> -->
<!-- 	</table> -->
</div>
@endsection