@extends('layout')

@section('title', $user->name)

@section('content')

<div class="container">

	<h1>Welcome, {{ $user->name }}</h1>
	<p class="lead">This is the admin area</p>
	
	<hr>
	
	@foreach($user->walks as $walk)
		<p><a href="{{ action('WalkController@show', $walk->slug) }}">{{ $walk->title }}</a></p>
	@endforeach
	
</div>

@endsection
