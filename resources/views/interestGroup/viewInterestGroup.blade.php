@extends('layouts.master')
@section('title', 'List of Interest Groups')


@section('heading', 'Interest Group')


@section('content')
    

	<table id="table_id" class="table table-striped table-bordered" style="width:95%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Tags</th>
            <th>Join</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach($intGroup as $key => $group)
        <tr>
            <td>{{ $group['NAME'] }}</td>
            <td>{{ $group['DESCRIPTION'] }}</td>
            <td>{{ $group['TAGS'] }}</td>
            <td>
            	<form action="joinInterestGroup" method="POST">
                	<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                	<input type = "hidden" name = "id" value = "{{$group['ID']}}"/>
                	<input type = "hidden" name = "users_id" value = "{{Session::get('userID')}}"/>
                	<input class = "btn btn-warning" type = "submit" value = "Join" onclick="javascript:return confirm('Are you sure you want join this Group?')"/>
            	</form>
            </td>
            @if(Session::get('userID') == $group['users_ID'] || Session::get('role') == "admin")	
            <td>
            	<form action="editInterestGroupForm" method="POST">
                	<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                	<input type = "hidden" name = "id" value = "{{$group['ID']}}"/>
                	<input type = "hidden" name = "name" value = "{{$group['NAME']}}"/>
                	<input type = "hidden" name = "description" value = "{{$group['DESCRIPTION']}}"/>
                	<input type = "hidden" name = "tags" value = "{{$group['TAGS']}}"/>
                	<input type = "hidden" name = "users_id" value = "{{$group['users_ID']}}"/>
                	<input class = "btn btn-primary" type = "submit" value = "Edit" />
            	</form>
            </td>
            <td>
            	<form action="deleteInterestGroup" method="POST">
                	<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                	<input type = "hidden" name = "id" value = "{{$group['ID']}}"/>
                	<input type = "hidden" name = "name" value = "{{$group['NAME']}}"/>
                	<input type = "hidden" name = "description" value = "{{$group['DESCRIPTION']}}"/>
                	<input type = "hidden" name = "tags" value = "{{$group['TAGS']}}"/>
                	<input type = "hidden" name = "users_id" value = "{{$group['users_ID']}}"/>
                	<input class = "btn btn-danger" type = "submit" value = "Delete" onclick="javascript:return confirm('Are you sure you want to delete this Group?')"/>
            	</form>
            </td>
            @endif
            
            
        </tr>
    @endforeach
    </tbody>
</table>

<table id="table_id" class="table table-striped table-bordered" style="width:95%">
    <thead>
        <tr>
            <th>Users</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $key => $user)
    <tr>
            <td>{{ $user['USERNAME'] }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection