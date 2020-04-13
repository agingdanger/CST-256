@extends('layouts.master')
@section('title', 'Login Page')

@section('content')

<?php
echo $message;

?>
<br>
<a href="registration">Register Here</a>
<br>
<a href="welcome">Login Here Again</a>

@endsection