<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = [
        'body', 'owner_id', 'thread_id',
    ];

    public function owner()
    {
    	return $this->belongsTo('App\User', 'owner_id');
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
