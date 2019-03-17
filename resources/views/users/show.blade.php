@extends('layout')

@section('title', "User name {$user->id}")

@section('content')
	
	<h1>User #{{ $user->id }}</h1>
	<p>User name: {{ $user->name }}</p>
	<p>Email: {{ $user->email }}</p>
	<p>
		<a href="{{ url('/users/') }}">Back to user list</a>
	</p>
	
		

@endsection

