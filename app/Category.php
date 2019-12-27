<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public function getRouteKeyName()
	{
		return 'slug';
	}

    public function path()
    {
    	return "/threads/{$this->slug}";
    }

    public function threads()
    {
    	return $this->hasMany('App\Thread');
    }
}
