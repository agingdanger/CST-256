@extends('layouts.master')
@section('title', 'Edit Education Page')

@section('content')
		<form action = "editEducation" method = "POST">
			<input type = "hidden" name = "_token" value = "{{csrf_token()}}"/>
			<h2>Edit Education History</h2>
			<table>
				<tr>
					<td>School: </td>
					<td><input type = "text" name = "edname" value= "{{$ed->getName()}}" /></td>
				</tr>
				
				<tr>
					<td>Years: </td>
					<td><input type = "text" name = "edyears" value= "{{$ed->getYears()}}"/></td>
				</tr>
				
				<tr>
					<td>Major: </td>
					<td><input type = "text" name = "edmajor" value= "{{$ed->getMajor()}}"/></td>
				</tr>
				
				<tr>
					<td>Minor: </td>
					<td><input type = "text" name = "edminor" value= "{{$ed->getMinor()}}"/></td>
				</tr>
				
				<tr>
					<td>Start Year: </td>
					<td><input type = "text" name = "edstartyear" value= "{{$ed->getStartyear()}}"/></td>
				</tr>
				
				<tr>
					<td>End Year: </td>
					<td><input type = "text" name = "edendyear" value= "{{$ed->getEndyear()}}"/></td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "edid" value = "{{$ed->getId()}}"/></td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "userid" value = "{{Session::get('userID')}}"/></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Edit" />
					</td>
				</tr>
			</table>
		</form>
		<a href="portfolio">Click here to go back to the portfolio page.</a>
@endsection