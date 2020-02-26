@extends('layouts.master')
@section('title', 'Registration Page')

@section('content')
		<form action = "register" method = "POST">
			<input type = "hidden" name = "_token" value = "<?php echo csrf_token()?>"/>
			<h2>Registration</h2>
			<table>
				<tr>
					<td>First Name: </td>
					<td><input type = "text" name = "firstname" />{{ $errors->first('firstname') }}</td>
				</tr>
				
				<tr>
					<td>Last Name: </td>
					<td><input type = "text" name = "lastname" />{{ $errors->first('lastname') }}</td>
				</tr>
				
				<tr>
					<td>Username: </td>
					<td><input type = "text" name = "username" />{{ $errors->first('username') }}</td>
				</tr>
				
				<tr>
					<td>Password: </td>
					<td><input type = "password" name = "password" />{{ $errors->first('password') }}</td>
				</tr>
				
				<tr>
					<td>Email: </td>
					<td><input type = "text" name = "email" />{{ $errors->first('email') }}</td>
				</tr>
				
				<tr>
					<td>Phone: </td>
					<td><input type = "text" name = "phone" />{{ $errors->first('phone') }}</td>
				</tr>
				
				<tr>
					<td>Role: </td>
					<td><input type = "text" name = "role" />{{ $errors->first('role') }}</td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Register" />
					</td>
				</tr>
			</table>
		</form>
		<a href="welcome">Click here for the Login Page.</a>
@endsection