@extends('layouts.master')
@section('title', 'List of Interest Groups')


@section('heading', 'Interest Group List')


@section('content')

	
    <form action="addInterestGroup" method="POST">
        <input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
        <input class = "btn btn-primary" type = "submit" value = "Click Here to Add an Interest Group" />
    </form>

	<table id="table_id" class="table table-striped table-bordered" style="width:95%">
    <thead>
        <tr>
        	<th>Group Page</th>
            <th>Name</th>
            <th>Description</th>
            <th>Tags</th>
            <th>Join</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach($intGroups as $key => $intGroup)
        <tr>
        	<td>
        		<form action="viewInterestGroup" method="POST">
    				<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                	<input type = "hidden" name = "id" value = "{{$intGroup['ID']}}"/>
                	<input type = "hidden" name = "name" value = "{{$intGroup['NAME']}}"/>
                	<input type = "hidden" name = "description" value = "{{$intGroup['DESCRIPTION']}}"/>
                	<input type = "hidden" name = "tags" value = "{{$intGroup['TAGS']}}"/>
                	<input type = "hidden" name = "users_id" value = "{{$intGroup['users_ID']}}"/>
        			<input class = "btn btn-primary" type = "submit" value = "View" />
    			</form>
        	</td>
            <td>{{ $intGroup['NAME'] }}</td>
            <td>{{ $intGroup['DESCRIPTION'] }}</td>
            <td>{{ $intGroup['TAGS'] }}</td>
            <td>
            	<form action="joinInterestGroup" method="POST">
                	<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                	<input type = "hidden" name = "id" value = "{{$intGroup['ID']}}"/>
                	<input type = "hidden" name = "users_id" value = "{{Session::get('userID')}}"/>
                	<input class = "btn btn-warning" type = "submit" value = "Join" onclick="javascript:return confirm('Are you sure you want join this Group?')"/>
            	</form>
            </td>
            @if(Session::get('userID') == $intGroup['users_ID'] || Session::get('role') == "admin")	
            <td>
            	<form action="editInterestGroupForm" method="POST">
                	<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                	<input type = "hidden" name = "id" value = "{{$intGroup['ID']}}"/>
                	<input type = "hidden" name = "name" value = "{{$intGroup['NAME']}}"/>
                	<input type = "hidden" name = "description" value = "{{$intGroup['DESCRIPTION']}}"/>
                	<input type = "hidden" name = "tags" value = "{{$intGroup['TAGS']}}"/>
                	<input type = "hidden" name = "users_id" value = "{{$intGroup['users_ID']}}"/>
                	<input class = "btn btn-primary" type = "submit" value = "Edit" />
            	</form>
            </td>
            <td>
            	<form action="deleteInterestGroup" method="POST">
                	<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                	<input type = "hidden" name = "id" value = "{{$intGroup['ID']}}"/>
                	<input type = "hidden" name = "name" value = "{{$intGroup['NAME']}}"/>
                	<input type = "hidden" name = "description" value = "{{$intGroup['DESCRIPTION']}}"/>
                	<input type = "hidden" name = "tags" value = "{{$intGroup['TAGS']}}"/>
                	<input type = "hidden" name = "users_id" value = "{{$intGroup['users_ID']}}"/>
                	<input class = "btn btn-danger" type = "submit" value = "Delete" onclick="javascript:return confirm('Are you sure you want to delete this Group?')"/>
            	</form>
            </td>
            @endif
            
            
        </tr>
    @endforeach
    </tbody>
</table>

@endsection