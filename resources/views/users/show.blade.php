@extends('layout')

@section('title', "User name {$user->id}")

@section('content')

	<div class="card">
		<div class="card-header">
			<h3>User #{{ $user->id }}</h3>
		</div>
			
		<div class="card-body">
			<p>User name: {{ $user->name }}</p>
			<p>Email: {{ $user->email }}</p>
			<p>
				<a href="{{ url('/users/') }}">Back to user list</a>
			</p>
		</div>
	</div>
	
	
	
	
		

@endsection

