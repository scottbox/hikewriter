@extends('layout')

@section('title', $walk->title)

@section('content')

<script>
// Define the osMap variable
var osMap, lgpx;

// This function creates the map and is called by the div in the HTML
function init()
{
	// Create new map
	osMap = new OpenSpace.Map('map');

	// Set map centre in National Grid Eastings and Northings and select zoom level 7
    osMap.setCenter(new OpenSpace.MapPoint(392905, 433010), 7);
    
	lgpx = new OpenLayers.Layer.GML("gpx", "{{ asset('/gpx/' . $walk->gpx) }}", {
		format: OpenLayers.Format.GPX,
		style: {
			strokeColor: "blue",
			strokeWidth: 3,
			strokeOpacity: 1
		},
		projection: new OpenLayers.Projection("EPSG:4326")  
	});

	// Add the gpx layer to the map
	osMap.addLayer(lgpx);
	
	// once locaded, centre the map on the route
	lgpx.events.register("loadend", lgpx, function()
	{
		this.map.zoomToExtent(this.getDataExtent());
	});
}
</script>

<div class="splash" style="background-image: url({{ asset(Croppa::url('images/walk/' . $featured_image->filename, 1920)) }})">
	<div class="splash-inner">
		<div class="container">
			<h1 class="text-center">{{ $walk->user->sitename }}</h1>
			
			<ul class="nav nav-tabs">
				@include('user.partials.usermenu')
			</ul>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-xs-9">
			<h2>{{ $walk->title }}</h2>
		</div>
		
		<div class="h2 col-xs-3 text-right">
			@if(!null == Auth::user() && $walk->user_id == Auth::user()->id)
			{!! Form::open(['action' => ['WalkController@destroy', $walk->id], 'method' => 'delete']) !!}
				<a href="{!! action('WalkController@edit', $walk->id) !!}" class="btn btn-primary">Edit this walk</a></li>
				<button type="submit" class="btn btn-danger btn-mini">Delete</button>
				<span class="btn btn-default">{{ count($walk->upvotes) }}</span>
			{!! Form::close() !!}
			@endif
			
			@if(!null == Auth::user())
			{!! Form::open(['action' => ['UpvoteController@store']]) !!}
			<div class="btn-group">
				@if($walk->user_id !== Auth::user()->id)
				<button type="submit" class="btn btn-primary" value="{{ $walk->id }}" name="walk_id">Upvote this walk</button>
				<span class="btn btn-default">{{ count($walk->upvotes) }}</span>
				@endif
			</div>
			{!! Form::close() !!}
			@endif
		</div>
	</div>
	
	<hr>
	
	<div class="row">
		<div class="col-md-4">
			<p><a href="{{ asset('/gpx/' . $walk->gpx) }}" class="btn btn-success">Download the GPX File</a></p>
			
			<hr>
			
			<ul class="list-unstyled">
				<li class="h4">Created on {{ date('jS F Y', strtotime($walk->created_at)) }}</li>
				<li class="small">Last Updated on {{ date('jS F Y', strtotime($walk->created_at)) }}</li>
			</ul>
			
			<hr>
			
			<h4>Walk Information</h4>
			<p>Walk Length: {{ number_format($miles, 2) }} miles ({{ number_format($miles * 1.609344, 2) }} km)</p>
		</div>
	
		<div class="col-md-8">
			<div id="map"></div>
		</div>
	</div>
	
	<hr>
	
	{!! $walk->body !!}
	
</div>

@endsection
