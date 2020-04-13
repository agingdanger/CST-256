@extends('layouts.master') 
@section('title', 'Add InterestGroup Page')


@section('content')
	<form action="addInterestGroupPost" method="POST">
        <input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
			<h2>Add an Interest Group</h2>
			<table>
				<tr>
					<td></td>
                    <td><input type="hidden" name="id"/></td>
            	</tr>
				<tr>
					<td>Group Name: </td>
					<td><input type = "text" name = "name" />{{ $errors->first('name') }}</td>
				</tr>
				
				<tr>
					<td>Description: </td>
					<td><input type = "text" name = "description" />{{ $errors->first('description') }}</td>
				</tr>
				
				<tr>
					<td>Tags: </td>
					<td><input type = "text" name = "tags" />{{ $errors->first('tags') }}</td>
				</tr>
				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Post a new Interest Group" />
					</td>
				</tr>
			</table>
	</form>
	<a href="viewInterestGroups">Click here to go back to view the list of Interest Groups page.</a>
@endsection