@extends('layouts.master') 
@section('title', 'Account Page')


@section('content')
	<form action="addJobPost" method="POST">
        <input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
			<h2>Add a Job</h2>
			<table>
				<tr>
					<td>Job Name: </td>
					<td><input type = "text" name = "jobname" />{{ $errors->first('jobname') }}</td>
				</tr>
				
				<tr>
					<td>Description: </td>
					<td><input type = "text" name = "description" />{{ $errors->first('description') }}</td>
				</tr>
				
				<tr>
					<td>Company: </td>
					<td><input type = "text" name = "company" />{{ $errors->first('company') }}</td>
				</tr>
				
				<tr>
					<td>Requirements: </td>
					<td><input type = "text" name = "requirements" />{{ $errors->first('requirements') }}</td>
				</tr>
				
				<tr>
					<td>Skills: </td>
					<td><input type = "text" name = "skills" />{{ $errors->first('skills') }}</td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Post a Job" />
					</td>
				</tr>
			</table>
	</form>
	<a href="viewJobs">Click here to go back to view the list of Jobs page.</a>
@endsection