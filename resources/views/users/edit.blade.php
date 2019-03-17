@extends('layout')

@section('title', "Create user")

@section('content')
	
	<h1>User editor</h1>

	@if ($errors->any())
		<div class="alert alert-danger">
			<p>Please correct this errors below:</p>
			<ul>
				@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			
		</div>
	@endif
	
	<form method="POST" action="{{ url('users')}}">

		{!! csrf_field() !!}
		
		<label for="name">Name</label>
		<input type="text" name="name" placeholder="Name LastName" value={{ old('name', $user->name ) }} >
		
		<br><br>
		<label for="email">Email</label>
		<input type="email" name="email" placeholder="email@example.com" value={{ old('email', $user->email ) }} >
		
		<br><br>
		<label for="password">Password</label>
		<input type="password" name="password" placeholder="more than 6 characters">
		
		<br><br>
		<button type="submit">User update</button>
	</form>





	<p>
		<a href="{{ url('/users/') }}">Back to user list</a>
	</p>
	
		

@endsection

