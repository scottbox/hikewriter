@extends('layout')

@section('title', 'Walks')

@section('content')

<div class="container">
	
	@foreach($walks_by_upvote as $walk)
	<div class="row">
		<div class="col-xs-12">
			<h1><span class="label label-success">{{ count($walk->upvotes) }}</span> <a href="{{ action('WalkController@show', $walk->slug) }}">{{ $walk->title }}</a></h1>
			<small> &ndash; featured on <a href="{!! action('UserController@show', $walk->user->subdomain) !!}">{{ $walk->user->sitename }}</a> by {{ $walk->user->name }}</small>
		</div>
	</div>
	<hr>
	@endforeach
</div>

@endsection
