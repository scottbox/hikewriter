@extends('layout')

@section('title', $user->sitename . ' by ' . $user->name)

@section('content')

<div class="splash" style="background-image: url({{ asset(Croppa::url('images/walk/' . $featured_image->filename, 1920)) }})">
	<div class="splash-inner">
		<div class="container">
			<h1 class="text-center">{{ $user->sitename }}</h1>
			
			<ul class="nav nav-tabs">
				@include('user.partials.usermenu')
			</ul>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
	{{-- get 3 walks --}}
	<?php $i = 1; ?>
	@foreach($user->walks as $walk)
		@if($i < 4)
		<div class="col-sm-4">
			@foreach($walk->images as $image)
				@if($image->id === $walk->featured_image_id)
				<a href="{{ action('WalkController@show', $walk->slug) }}">
					<img src="{{ Croppa::url('images/walk/' . $image->filename, 720) }}" alt="{{ $walk->title }}" class="img-responsive">
				</a>
				@endif
			@endforeach
			<h2><a href="{{ action('WalkController@show', $walk->slug) }}">{{ $walk->title }}</a></h2>
		</div>
		@endif
		<?php $i++; ?>
	@endforeach
	</div>
	
	<hr>
	
	<div class="row">
		<div class="col-xs-9">
			<h3>Recent Upvotes</h3>
		</div>
		
		<div class="col-xs-3 text-right">
			<a href="{{ action('UpvoteController@show', $user->subdomain) }}" class="btn btn-default">All Upvotes</a>
		</div>
	</div>
	
	<div class="row">
	{{-- get 6 walks --}}
	<?php $i = 1; ?>
		@foreach($user->upvotes as $upvote)
		@if($i < 7)
		<div class="col-md-2">
			@foreach($upvote->walk->images as $image)
				@if($image->id === $upvote->walk->featured_image_id)
				<a href="{{ action('WalkController@show', $walk->slug) }}">
					<img src="{{ Croppa::url('images/walk/' . $image->filename, 720) }}" alt="{{ $walk->title }}" class="img-responsive">
				</a>
				@endif
			@endforeach
			<h4><a href="{{ action('WalkController@show', $upvote->walk->slug) }}">{{ $upvote->walk->title }}</a><br><small>&ndash; {{ date('jS F Y', strtotime($upvote->created_at)) }}</small></h4>
		</div>
		@endif
		<?php $i++; ?>
		@endforeach
	</div>
</div>

@endsection
