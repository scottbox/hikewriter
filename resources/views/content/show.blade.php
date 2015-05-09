@extends('layout')

@section('title', $content->title)

@section('content')

<div class="container">
	<h1>{{ $content->title }}</h1>
	
	{!! $content->body !!}
</div>

@endsection
