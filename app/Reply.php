<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use Favorable, RecordsActivity;

    protected $fillable = [
        'body', 'owner_id', 'thread_id',
    ];

    protected $with = [
        'owner', 'favorites',
    ];

    protected $appends = [
        'favoritesCount', 'favoritesStatus'
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
    	return "{$this->thread->path()}#reply-{$this->id}";
    }
}
