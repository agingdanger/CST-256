@extends('layouts.master')
@section('title', 'Edit a Job Page')

@section('content')
		<form action = "editJob" method = "POST">
			<input type = "hidden" name = "_token" value = "{{csrf_token()}}"/>
			<h2>Edit Job History</h2>
			<table>
			
				<tr>
					<td>Name: </td>
					<td><input type = "text" name = "jobname" value = "{{$job->getName()}}" /></td>
				</tr>
				
				<tr>
					<td>Position: </td>
					<td><input type = "text" name = "jobposition" value = "{{$job->getPosition()}}"/></td>
				</tr>
				
				<tr>
					<td>Description: </td>
					<td><input type = "text" name = "jobdescription" value = "{{$job->getDescription()}}"/></td>
				</tr>
				
				<tr>
					<td>Awards: </td>
					<td><input type = "text" name = "jobaward" value = "{{$job->getAwards()}}"/></td>
				</tr>
				
				<tr>
					<td>Start Date: </td>
					<td><input type = "text" name = "jobstartdate" value = "{{$job->getStartdate()}}"/></td>
				</tr>
				
				<tr>
					<td>End Date: </td>
					<td><input type = "text" name = "jobenddate" value = "{{$job->getEnddate()}}"/></td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "jobid" value = "{{$job->getId()}}"/></td>
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
		<a href="welcome">Click here to go back to the profile page.</a>
@endsection