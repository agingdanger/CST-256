@extends('layouts.master') 
@section('title', 'Account Page')


@section('content')
	<form action="addJobPost" method="POST">
        <input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
			<h2>Add Job</h2>
			<table>
				<tr>
					<td>Job Name: </td>
					<td><input type = "text" name = "jobname" /><!-- {{ $errors->first('firstname') }} --></td>
				</tr>
				
				<tr>
					<td>Description: </td>
					<td><input type = "text" name = "description" /><!-- {{ $errors->first('lastname') }} --></td>
				</tr>
				
				<tr>
					<td>Company: </td>
					<td><input type = "text" name = "company" /><!-- {{ $errors->first('username') }} --></td>
				</tr>
				
				<tr>
					<td>Requirements: </td>
					<td><input type = "text" name = "requirements" /><!-- {{ $errors->first('password') }} --></td>
				</tr>
				
				<tr>
					<td>Skills: </td>
					<td><input type = "text" name = "skills" /><!-- {{ $errors->first('email') }} --></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Post a Job" />
					</td>
				</tr>
			</table>
	</form>
@endsection