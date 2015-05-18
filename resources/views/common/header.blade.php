<header id="header">
	<nav class="navbar navbar-default">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed bg-primary" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="text-default">Menu</span>
				</button>
				<a class="navbar-brand" href="{{ action('ContentController@index') }}">Hikewriter</a>
			</div>
		
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Walks <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ action('WalkController@index') }}">Walk Index</a></li>
						</ul>
					</li>
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ action('UserController@index') }}">{{ Auth::user()->name }}'s Homepage</a></li>
								<li><a href="{{ action('UserController@show', Auth::user()->subdomain) }}">{{ Auth::user()->name }}'s Public Homepage</a></li>
								<li><a href="{{ action('UpvoteController@show', Auth::user()->subdomain) }}">{{ Auth::user()->name }}'s Upvotes</a></li>
								<li role="presentation" class="divider"></li>
								<li><a href="{{ action('WalkController@create') }}">Create Walk</a></li>
								<li role="presentation" class="divider"></li>
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</header>