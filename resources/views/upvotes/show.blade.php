@extends('layout')

@section('title', $user->name . '\'s Upvotes')

@section('content')
	
<div class="splash" style="background-image: url({{ asset(Croppa::url('images/walk/' . $featured_image->filename, 1920)) }})">
	<div class="container">
		<h1 class="text-center">{{ $user->sitename }}</h1>
	</div>
</div>

<div class="container">
	<div class="row">
	<?php $i = 1; ?>
	@foreach($user->upvotes as $upvote)
		<div class="col-md-2">
			@foreach($upvote->walk->images as $image)
				@if($image->id === $upvote->walk->featured_image_id)
				<a href="{{ action('WalkController@show', $upvote->walk->slug) }}">
					<img src="{{ Croppa::url('images/walk/' . $image->filename, 720) }}" alt="{{ $upvote->walk->title }}" class="img-responsive">
				</a>
				@endif
			@endforeach
			<h4><a href="{{ action('WalkController@show', $upvote->walk->slug) }}">{{ $upvote->walk->title }}</a><br><small class="hidden-xs">&ndash; {{ date('jS F Y', strtotime($upvote->created_at)) }}</small></h4>
			<hr class="visible-xs">
		</div>
		@if($i == 6)
		<hr class="clear hidden-xs">
		@endif
		<?php $i++; ?>
	@endforeach
	</div>
</div>

@endsection
