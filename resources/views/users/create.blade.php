@extends('layout')

@section('title', "Create user")

@section('content')
	
	<h1>Create user</h1>

	@if ($errors->any())
		<div class="alert alert-danger">
			<p>Please correct this errors below:</p>
			
		</div>
	@endif
	
	<form method="POST" action="{{ url('users')}}">

		{!! csrf_field() !!}
		
		<label for="name">Name</label>
		<input type="text" name="name" placeholder="Name LastName" value={{ old('name') }} >
		@if ($errors->has('name'))
			<br>{{ $errors->first('name') }}
		@endif
		<br><br>
		<label for="email">Email</label>
		<input type="email" name="email" placeholder="email@example.com" value={{ old('email') }} >
		@if ($errors->has('email'))
			<br>{{ $errors->first('email') }}
		@endif
		<br><br>
		<label for="password">Password</label>
		<input type="password" name="password" placeholder="more than 6 characters">
		@if ($errors->has('password'))
			<br>{{ $errors->first('password') }}
		@endif
		<br><br>
		<button type="submit">Create new user</button>
	</form>





	<p>
		<a href="{{ url('/users/') }}">Back to user list</a>
	</p>
	
		

@endsection

