@extends('layout')

@section('title', "users")

@section('content')
	
	<h1>{{ $title }}</h1>
	<hr>

	<p>
		<a href="{{ route('users.create') }}">New user</a>
	</p>
		
	<ul>
		@forelse ($users as $user)
			<li>{{ $user->name }},{{ $user->email }}
				<a href="{{ route('users.show', $user) }}">More details</a> |
				<a href="{{ route('users.edit', $user) }}">Edit</a> |
				<form action="{{ route('users.destroy',$user)}}" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button type="submit">Delete</button>
				</form>
			</li>
		@empty
			<p>No registered users.</p>	
		@endforelse
	</ul>

@endsection


@section('sidebar')
	
	<h2>Modified sidebar</h2>
	@parent
@endsection