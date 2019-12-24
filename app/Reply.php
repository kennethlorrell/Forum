<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function owner()
    {
    	return $this->belongsTo('App\User');
    }

    public function thread()
    {
    	return $this->belongsTo('App\Thread');
    }

    public function path()
    {
    	return "/threads/{$this->thread->id}/replies/{$this->id}";
    }
}
