@extends('layouts.master')
@section('title', 'List of Interest Groups')


@section('heading', 'Interest Group List')


@section('content')

	<table id="table_id" class="table table-striped table-bordered" style="width:95%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Tags</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @foreach($intGroups as $key => $intGroup)
        <tr>
            <td>{{ $intGroup['NAME'] }}</td>
            <td>{{ $intGroup['DESCRIPTION'] }}</td>
            <td>{{ $intGroup['TAGS'] }}</td>
            <td>
            	<form action="editInterestGroupForm" method="POST">
                	<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                	<input type = "hidden" name = "id" value = "{{$job['ID']}}"/>
                	<input type = "hidden" name = "job" value = "{{$intGroup['NAME']}}"/>
                	<input type = "hidden" name = "description" value = "{{$intGroup['DESCRIPTION']}}"/>
                	<input type = "hidden" name = "company" value = "{{$intGroup['TAGS']}}"/>
                	<input class = "btn btn-primary" type = "submit" value = "Edit" />
            	</form>
            </td>
            <td>
            	<form action="deleteInterestGroup" method="POST">
                	<input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
                	<input type = "hidden" name = "id" value = "{{$job['ID']}}"/>
                	<input type = "hidden" name = "job" value = "{{$intGroup['NAME']}}"/>
                	<input type = "hidden" name = "description" value = "{{$intGroup['DESCRIPTION']}}"/>
                	<input type = "hidden" name = "company" value = "{{$intGroup['TAGS']}}"/>
                	<input class = "btn btn-danger" type = "submit" value = "Delete" onclick="javascript:return confirm('Are you sure you want to delete this User?')"/>
            	</form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection