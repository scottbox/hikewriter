<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Upvote;
use App\Walk;
use App\User;
use App\Image;

class UpvoteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$upvote = new Upvote;
		
		$upvote->walk_id = $request->input('walk_id');
		$upvote->user_id = Auth::user()->id;
		
		$upvote->save();
		
		$walk = Walk::where('id', $request->input('walk_id'))->first();
		
		return redirect()->action('WalkController@show', [$walk->slug]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($subdomain)
	{
		$user = User::where('subdomain', $subdomain)->first();
		$walk = Walk::where('user_id', $user->id)->first();
		
		$featured_image = Image::where('id', $walk->featured_image_id)->first();
		
		return view('upvotes.show', [
			'user'				=> $user,
			'featured_image'	=> $featured_image,
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
