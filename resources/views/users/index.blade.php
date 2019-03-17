@extends('layout')

@section('title', "users")

@section('content')
	
	<h1>{{ $title }}</h1>
	<hr>
		
	<ul>
		@forelse ($users as $user)
			<li>{{ $user->name }},{{ $user->email }}
			<a href="{{ route('users.show',['id' => $user->id]) }}">More details</a></li>
		@empty
			<p>No registered users.</p>	
		@endforelse
	</ul>

@endsection


@section('sidebar')
	
	<h2>Modified sidebar</h2>
	@parent
@endsection