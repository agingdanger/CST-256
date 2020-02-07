@extends('layouts.master') 
@section('title', 'Account Page')

@section('content')
<h2>Account Page</h2>
<div>
<table>
	<tr>
		<td>Username:</td>
		<td>{{$user['USERNAME']}}</td>
	</tr>

	<tr>
		<td>Email:</td>
		<td>{{$user['EMAIL']}}</td>
	</tr>

	<tr>
		<td>Phone:</td>
		<td>{{$user['PHONE']}}</td>
	</tr>
	
	<tr>
		<td>Role:</td>
		<td>{{$user['ROLE']}}</td>
	</tr>

	<tr>
		<td colspan="2" align="center"><input type="submit" value="Login" /></td>
	</tr>
</table>
</div>
<div>
@if($user['ROLE'] === "admin")
	@include('admin.adminButtons')
@endif
</div>
@endsection