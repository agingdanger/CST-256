@extends('layouts.master')
@section('title', 'Add a Job Page')

@section('content')
		<form action = "addJob" method = "POST">
			<input type = "hidden" name = "_token" value = "{{csrf_token()}}"/>
			<h2>Add Job History</h2>
			<table>
				<tr>
					<td>Name: </td>
					<td><input type = "text" name = "jobname" />{{ $errors->first('jobname') }}</td>
				</tr>
				
				<tr>
					<td>Position: </td>
					<td><input type = "text" name = "jobposition" />{{ $errors->first('jobposition') }}</td>
				</tr>
				
				<tr>
					<td>Description: </td>
					<td><input type = "text" name = "jobdescription" />{{ $errors->first('jobdescription') }}</td>
				</tr>
				
				<tr>
					<td>Awards: </td>
					<td><input type = "text" name = "jobaward" />{{ $errors->first('jobaward') }}</td>
				</tr>
				
				<tr>
					<td>Start Date: </td>
					<td><input type = "date" name = "jobstartdate" />{{ $errors->first('jobstartdate') }}</td>
				</tr>
				
				<tr>
					<td>End Date: </td>
					<td><input type = "date" name = "jobenddate" />{{ $errors->first('jobenddate') }}</td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "userid" value = "{{Session::get('userID')}}"/></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Add" />
					</td>
				</tr>
			</table>
		</form>
		<a href="myportfolio">Click here to go back to the portfolio page.</a>
@endsection