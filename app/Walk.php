<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Walk extends Model implements SluggableInterface {

    use SluggableTrait;

    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

    public function images()
    {
        return $this->hasMany('App\Image');
    }
	
	public function user()
	{
		return $this->belongsTo('App\User');
	}

    public function upvotes()
    {
        return $this->hasMany('App\Upvote');
    }

}
