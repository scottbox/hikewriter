@extends('layout')

@section('title', 'Create Walk')

@section('content')

@if (Auth::check())
<div class="container">
{!! Form::open(['action' => 'WalkController@store']) !!}

	<div class="form-group">
		{!! Form::label('walk-title', 'Walk Title') !!}
		<div class="form-group">
			{!! Form::text('walk-title', null, ['placeholder' => 'Enter the walk title', 'class' => 'form-control']) !!}
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
			{!! Form::textarea('walk-body', null, ['placeholder' => 'Write about your walk', 'class' => 'form-control']) !!}
		</div>
	</div>
	
	{!! Form::submit('Submit') !!}

{!! Form::close() !!}
</div>
@endif

@endsection
