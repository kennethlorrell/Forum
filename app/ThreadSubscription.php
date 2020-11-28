<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Notifications\ThreadWasUpdated;

class ThreadSubscription extends Model
{
    protected $fillable = [
    	'user_id', 'thread_id',
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function thread()
    {
    	return $this->belongsTo('App\Thread');
    }

    public function notify($reply)
    {
    	$this->user->notify(new ThreadWasUpdated($this->thread, $reply));
    }
}
