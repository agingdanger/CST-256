@extends('layouts.master') 
@section('title', 'Job Info Page')

@section('content')
<h2>Job Info Page</h2>

<div>
	<h4 class="card-title">{{ $job->getName() }}</h4>
</div>
	
<!-- Cards for Job Info -->
<div class="card-group">
	
	

  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Description</h5>
      <p class="card-text">{{ $job->getDescription() }}</p>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Company</h5>
      <p class="card-text">{{ $job->getCompany() }}</p>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Requirements</h5>
      <p class="card-text">{{ $job->getRequirements() }}</p>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Skills</h5>
      <p class="card-text">{{ $job->getSkills() }}</p>
    </div>
  </div>
</div>
<!-- Cards for Job Info ends -->

<br>
<!-- Button to go back -->
<div class="">
	<a href="viewJobs" class="btn btn-primary btn-lg active" role="button" aria-pressed="true" onclick="javascript:return confirm('Thank you for applying! Check your emails to hear back from us.')">Apply Job </a>
</div>

<br>

@endsection