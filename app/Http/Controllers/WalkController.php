<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Walk;
use App\Image;
use App\User;

use Illuminate\Http\Request;

use Location\Coordinate;
use Location\Polyline;
use Location\Distance\Vincenty;

class WalkController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$walks_by_upvote = Walk::with('upvotes')->take(10)->get()->sortByDesc(function($walk){
			return $walk->upvotes->count();
		});
		
		return view('walk.index', [
			'walks_by_upvote'	=> $walks_by_upvote
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('walk.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$walk = new Walk;
		
		$walk->title = $request->input('walk-title');
		$walk->gpx = $request->input('walk-gpx');
		$walk->body = $request->input('walk-body');
		$walk->user_id = Auth::user()->id;
		
		$walk->save();
		
		return redirect()->action('WalkController@show', [$walk->slug]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug)
	{
		$walk = Walk::where('slug', $slug)->first();
		
		// get distance
		$gpxfile = asset('gpx/' . $walk->gpx);
	
		$xml = simplexml_load_file($gpxfile);
		$track = new Polyline();		
		
		$numItems = count($xml);
		$i = 1;
		foreach($xml as $wpt) {
			if(--$numItems <= 0) {
				break;
			} else {
				$latitude = (float)$wpt['lat'];
				$longditude = (float)$wpt['lon'];
				$track->addPoint(new Coordinate($latitude, $longditude));
			}
		}

		$metres = $track->getLength(new Vincenty());
		$miles = $metres * 0.000621371192;
		
		// get image
		$featured_image = Image::where('id', $walk->featured_image_id)->first();
		
		return view('walk.show', [
			'walk'				=> $walk,
			'featured_image'	=> $featured_image,
			'miles'				=> $miles,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$walk = Walk::find($id);
	
		return view('walk.edit', ['walk' => $walk]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$walk = Walk::find($id);
		
		$walk->title = $request->input('walk-title');
		$walk->gpx = $request->input('walk-gpx');
		$walk->body = $request->input('walk-body');
		$walk->user_id = Auth::user()->id;
		
		$walk->save();
		
		return redirect()->action('WalkController@show', [$walk->slug]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Walk::destroy($id);
		
		return redirect()->action('WalkController@index');
	}

}
