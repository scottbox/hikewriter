@extends('layout')

@section('title', $walk->title)

@section('content')
	
<div class="splash" style="background-image: url(/images/walk/test-walk-1.jpg)">
	<div class="container">
		<h1 class="text-center">{{ $walk->title }}</h1>
		<small> &ndash; by {{ $walk->user->name }}</small>
	</div>
</div>

<div class="container">
	
	
	{!! $walk->body !!}
	
	
	<ul class="list-inline">
		<li><a href="{!! action('WalkController@edit', $walk->id) !!}">Edit this walk</a></li>
		<li>
			{!! Form::open(['action' => ['WalkController@destroy', $walk->id], 'method' => 'delete']) !!}
				<button type="submit" class="btn btn-danger btn-mini">Delete</button>
			{!! Form::close() !!}
		</li>
	</ul>
	
</div>

@endsection
