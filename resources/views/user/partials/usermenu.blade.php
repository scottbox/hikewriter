@if(isset($walk))

<li class="active"><a href="{{ action('UserController@show', $walk->user->subdomain) }}">{{ $walk->user->sitename }}</a></li>				
<li role="presentation" class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
		Recent Walks <span class="caret"></span>
	</a>
	<ul class="dropdown-menu" role="menu">
		@foreach($walks as $walk)
		<li><a href="{{ action('WalkController@show', $walk->slug) }}">{{ $walk->title }}</a></li>
		@endforeach
	</ul>
</li>
<li><a href="{{ action('UpvoteController@show', $walk->user->subdomain) }}">{{ $walk->user->name }}'s Upvotes</a></li>

@else

<li class="active"><a href="{{ action('UserController@show', $user->subdomain) }}">{{ $user->sitename }}</a></li>				
<li role="presentation" class="dropdown">
	<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
		Recent Walks <span class="caret"></span>
	</a>
	<ul class="dropdown-menu" role="menu">
		@foreach($user->walks as $walk)
		<li><a href="{{ action('WalkController@show', $walk->slug) }}">{{ $walk->title }}</a></li>
		@endforeach
	</ul>
</li>
<li><a href="{{ action('UpvoteController@show', $user->subdomain) }}">{{ $user->name }}'s Upvotes</a></li>

@endif