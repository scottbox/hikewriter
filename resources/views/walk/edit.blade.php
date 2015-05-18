@extends('layout')

@section('title', 'Create Walk')

@section('content')

@if(Auth::check())
<div class="container">
{!! Form::open(['action' => ['WalkController@update', $walk->id], 'method' => 'PATCH']) !!}

	<div class="form-group">
		{!! Form::label('walk-title', 'Walk Title') !!}
		<div class="form-group">
			{!! Form::text('walk-title', $walk->title, ['placeholder' => 'Enter the walk title', 'class' => 'form-control']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('walk-gpx', 'GPX File') !!}
		<div class="input-group">
			<span class="input-group-btn">
				<span class="btn btn-primary btn-file">
					Browse&hellip; {!! Form::file('walk-gpx', ['class' => 'form-control']) !!}
				</span>
			</span>
			<input type="text" class="form-control" readonly>
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('walk-body', 'Walk Content') !!}
		<div class="form-group">
			{!! Form::textarea('walk-body', $walk->body, ['placeholder' => 'Write about your walk', 'class' => 'form-control']) !!}
		</div>
	</div>
	
	{!! Form::submit('Submit') !!}

{!! Form::close() !!}
</div>
@endif

@endsection
