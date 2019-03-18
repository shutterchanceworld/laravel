@extends('layout')

@section('title', "users")

@section('content')

	<div class="d-flex justify-content-between align-items-end mb-2">
		<h1 class="pb-1">{{ $title }}</h1>

		<p>
			<a href="{{ route('users.create') }}" class="btn btn-primary">New user</a> 
		</p>

	</div>
	
	

	@if($users->isNotEmpty())

	<table class="table">
	  <thead class="thead-dark">
	    <tr>
	      <th scope="col">#</th>
	      <th scope="col">Name</th>
	      <th scope="col">Email</th>
	      <th scope="col">Action</th>
	    </tr>
	  </thead>
	  <tbody>

	  @foreach($users as $user)	
	    <tr>
	      <th scope="row">{{ $user->id }}</th>
	      <td>{{ $user->name}}</td>
	      <td>{{ $user->email }}</td>
	      <td> 
	      		
				<form action="{{ route('users.destroy',$user)}}" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<a href="{{ route('users.show', $user) }}" class="btn btn-link"><span class="oi oi-eye"></span></a> 
					<a href="{{ route('users.edit', $user) }}" class="btn btn-link"><span class="oi oi-pencil"></span></a> 
					<button type="submit" class="btn btn-link"><span class="oi oi-trash"></span></button>
				</form>		
	      </td>
	    </tr>
	    
	  @endforeach	

	  </tbody>
	</table>
	
	@else
		<p>There are no registered users</p>
	@endif

	
@endsection


@section('sidebar')
	
	<h2>Modified sidebar</h2>
	@parent
@endsection