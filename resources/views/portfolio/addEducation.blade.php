@extends('layouts.master')
@section('title', 'Add Education Page')

@section('content')
		<form action = "addEducation" method = "POST">
			<input type = "hidden" name = "_token" value = "{{csrf_token()}}"/>
			<h2>Add Education History</h2>
			<table>
				<tr>
					<td>School: </td>
					<td><input type = "text" name = "edname" />{{ $errors->first('edname') }}</td>
				</tr>
				
				<tr>
					<td>Years: </td>
					<td><input type = "number" name = "edyears" placeholder="Range: 1 - 80"/>{{ $errors->first('edyears') }}</td>
				</tr>
				
				<tr>
					<td>Major: </td>
					<td><input type = "text" name = "edmajor" />{{ $errors->first('edmajor') }}</td>
				</tr>
				
				<tr>
					<td>Minor: </td>
					<td><input type = "text" name = "edminor" />{{ $errors->first('edminor') }}</td>
				</tr>
				
				<tr>
					<td>Start Year: </td>
					<td><input type = "number" name = "edstartyear" value="1970" placeholder="YYYY"/>{{ $errors->first('edstartyear') }}</td>
				</tr>
				
				<tr>
					<td>End Year: </td>
					<td><input type = "number" name = "edendyear" value="2020" placeholder="YYYY"/>{{ $errors->first('edendyear') }}</td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "userid" value = "{{Session::get('userID')}}"/></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Add Education History" />
					</td>
				</tr>
			</table>
		</form>
		<a href="myportfolio">Click here to go back to the portfolio page.</a>
@endsection