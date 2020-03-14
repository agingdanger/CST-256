@extends('layouts.master') 
@section('title', 'Account Page')

@section('content')
<h2>Account Page</h2>
<!-- <div> -->
<!-- <table> -->
<!-- 	<tr> -->
<!-- 		<td>First Name:</td> -->
<!-- 		<td>{{$user->getFirstname()}}</td> -->
<!-- 	</tr> -->
	
<!-- 	<tr> -->
<!-- 		<td>Last Name:</td> -->
<!-- 		<td>{{$user->getLastname()}}</td> -->
<!-- 	</tr> -->
<!-- 	<tr> -->
<!-- 		<td>Username:</td> -->
<!-- 		<td>{{$user->getUsername()}}</td> -->
<!-- 	</tr> -->

<!-- 	<tr> -->
<!-- 		<td>Email:</td> -->
<!-- 		<td>{{$user->getEmail()}}</td> -->
<!-- 	</tr> -->

<!-- 	<tr> -->
<!-- 		<td>Phone:</td> -->
<!-- 		<td>{{$user->getPhone()}}</td> -->
<!-- 	</tr> -->
	
<!-- 	<tr> -->
<!-- 		<td>Role:</td> -->
<!-- 		<td>{{$user->getRole()}}</td> -->
<!-- 	</tr> -->
<!-- </table> -->
<!-- </div> -->
<div>

<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Profile Card</h5>
    <div class="row">
        <h6 class="mx-auto card-subtitle mb-1 text-muted">{{$user->getFirstName()}}</h6>
        <h6 class="mx-auto card-subtitle mb-1 text-muted">{{$user->getLastName()}}</h6>
    </div>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div>

@if(Session::get('role') === "admin")
	@include('admin.adminButtons')
@endif
</div>
@endsection