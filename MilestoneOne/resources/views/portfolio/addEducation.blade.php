@extends('layouts.master')
@section('title', 'Add Education Page')

@section('content')
		<form action = "addEducation" method = "POST">
			<input type = "hidden" name = "_token" value = "{{csrf_token()}}"/>
			<h2>Add Job History</h2>
			<table>
				<tr>
					<td>School: </td>
					<td><input type = "text" name = "edname" /></td>
				</tr>
				
				<tr>
					<td>Years: </td>
					<td><input type = "text" name = "edyears" /></td>
				</tr>
				
				<tr>
					<td>Major: </td>
					<td><input type = "text" name = "edmajor" /></td>
				</tr>
				
				<tr>
					<td>Minor: </td>
					<td><input type = "text" name = "edminor" /></td>
				</tr>
				
				<tr>
					<td>Start Year: </td>
					<td><input type = "text" name = "edstartyear" /></td>
				</tr>
				
				<tr>
					<td>End Year: </td>
					<td><input type = "text" name = "edendyear" /></td>
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
		<a href="portfolio">Click here to go back to the portfolio page.</a>
@endsection