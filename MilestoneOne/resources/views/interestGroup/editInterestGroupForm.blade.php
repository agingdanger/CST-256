@extends('layouts.master') 
@section('title', 'Edit Interest Group Page')

@section('heading', 'Edit Interest Group Form')

@section('content')
	<form action="editInterestGroupPost" method="POST">
        <input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
			<h2>Edit Interest Group</h2>
			<table>
				
				<tr>
					<td></td>
                    	<td><input type="hidden" name="jobid" value="{{ $intGroup->getId() }}"/>
                    	<!-- {{ $errors->first('id') }} --></td>
            	</tr>
				
				<tr>
					<td>Interest Group Name:</td>
                    	<td><input type="text" name="name" value="{{ $intGroup->getName() }}"/>
                    	<!-- {{ $errors->first('firstname') }} --></td>
            	</tr>
            
                <tr>
                	<td>Description:</td>
                	<td><input type="text" name="description" style="height:125px;" value="{{ $intGroup->getDescription() }}"/>
                	<!-- {{ $errors->first('lastname') }} --></td>
                </tr>
                
                <tr>
                	<td>Tags:</td>
                	<td><input type="text" name="tags" value="{{ $intGroup->getTags() }}"/>
                	<!-- {{ $errors->first('username') }} --></td>
                </tr>
    				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Edit Interest Group" />
					</td>
				</tr>
			</table>
	</form> 




@endsection