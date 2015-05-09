@extends('layout')

@section('title', 'Walk Index')

@section('content')

<div class="container">
@foreach($walks as $walk)	
	<h1><a href="{{ action('WalkController@show', $walk->slug) }}">{{ $walk->title }}</a></h1>
	<small> &ndash; by {{ $walk->user->name }}</small>
	<hr>
@endforeach
</div>

@endsection
