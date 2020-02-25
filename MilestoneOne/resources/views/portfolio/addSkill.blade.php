@extends('layouts.master')
@section('title', 'Add a Skill Page')

@section('content')
		<form action = "addSkill" method = "POST">
			<input type = "hidden" name = "_token" value = "{{csrf_token()}}"/>
			<h2>Add Skill History</h2>
			<table>
				<tr>
					<td>Skill: </td>
					<td><input type = "text" name = "skillname" /></td>
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