@extends('layout')

@section('title', "Create user")

@section('content')

	<div class="card">
		<div class="card-header">
	    	<h3>Create user</h3>
	  	</div>
	  
		<div class="card-body">
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

				<div class="form-group">
				    <label for="name">Name</label>
					<input type="text" name="name" class="form-control"  placeholder="Name LastName" value={{ old('name') }} >		    
				</div>
				<div class="form-group">
					<label for="email">Email</label>
					<input type="email" name="email" class="form-control"  placeholder="email@example.com" value={{ old('email') }} >
				</div>	
				<div class="form-group">
					<label for="password">Password</label>
				<input type="password" name="password" class="form-control" placeholder="more than 6 characters">
				</div>	
				
				<button type="submit" class="btn btn-primary">Create new user</button>
				<a href="{{ url('/users/') }}" class="btn btn-link ml-10">Back to user list</a>
			</form>

		</div>
   </div>
	

@endsection

