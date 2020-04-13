@extends('layouts.master')
@section('title', 'Edit a Skill Page')

@section('content')
		<form action = "editSkill" method = "POST">
			<input type = "hidden" name = "_token" value = "{{csrf_token()}}"/>
			<h2>Edit Skill History</h2>
			<table>
				<tr>
					<td>Skill: </td>
					<td><input type = "text" name = "skillname" value = "{{$skill->getName()}}"/></td>
				</tr>
	
				<tr>
					<td><input type = "hidden" name = "userid" value = "{{Session::get('userID')}}"/></td>
				</tr>
				
				<tr>
					<td><input type = "hidden" name = "skillid" value = "{{$skill->getId()}}"/></td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Edit" />
					</td>
				</tr>
			</table>
		</form>
		<a href="myportfolio">Click here to go back to the portfolio page.</a>
@endsection