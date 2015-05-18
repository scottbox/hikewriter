<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Upvote extends Model {

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function walk()
	{
		return $this->belongsTo('App\Walk');
	}

}
