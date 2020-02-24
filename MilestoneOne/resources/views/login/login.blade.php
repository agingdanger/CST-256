@extends('layouts.master')
@section('title', 'Login Page')

@section('content')
		<form action = "login" method = "POST">
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token()?>"/>
			<h2>Login</h2>
			<table>
				<tr>
					<td>Username: </td>
					<td><input type = "text" name = "username" />{{ $errors->first('username') }}</td>
				</tr>
				
				<tr>
					<td>Password: </td>
					<td><input type = "password" name = "password" />{{ $errors->first('password') }}</td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Login" />
					</td>
				</tr>
			</table>
		</form>
		
    	<!-- @if($errors->count() != 0)
        	<h5>List of Errors</h5>
        	@foreach($errors->all() as $message) 
        		{{ $message }} <br /> 
        	@endforeach 
    	@endif -->
		
		
		<p><?php 
// 		if ($message == null)
//		echo $message;?></p>
		
		<a href="registration">Register Here</a>
@endsection