@extends('layouts.master') 
@section('title', 'Account Page')

@section('title', 'Edit Job Posting')

@section('content')
	<form action="editJobPost" method="POST">
        <input type = "hidden" name = "_token" value = "{{ csrf_token() }}"/>
			<h2>Edit Job</h2>
			<table>
				
				<tr>
					<td></td>
                    	<td><input type="hidden" name="jobid" value="{{ $job->getId() }}"/>
                    	<!-- {{ $errors->first('id') }} --></td>
            	</tr>
				
				<tr>
					<td>Job Name:</td>
                    	<td><input type="text" name="jobname" value="{{ $job->getName() }}"/>
                    	<!-- {{ $errors->first('firstname') }} --></td>
            	</tr>
            
                <tr>
                	<td>Description:</td>
                	<td><input type="text" name="description" value="{{ $job->getDescription() }}"/>
                	<!-- {{ $errors->first('lastname') }} --></td>
                </tr>
                
                <tr>
                	<td>Company:</td>
                	<td><input type="text" name="company" value="{{ $job->getCompany() }}"/>
                	<!-- {{ $errors->first('username') }} --></td>
                </tr>
                
                <tr>
                	<td>Requirements:</td>
                	<td><input type="text" name="requirements" value="{{ $job->getRequirements() }}"/>
                	<!-- {{ $errors->first('password') }} --></td>
                </tr>
                
                <tr>
                	<td>Skills:</td>
                	<td><input type="text" name="skills" value="{{ $job->getSkills() }}"/>
                	<!-- {{ $errors->first('email') }} --></td>
                </tr>
    				
				<tr>
					<td colspan = "2" align = "center">
						<input type = "submit" value = "Edit Job" />
					</td>
				</tr>
			</table>
	</form> 




@endsection