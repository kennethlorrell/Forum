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

    protected static function boot()
    {
        parent::boot();

        static::created(function ($reply) {
            $reply->thread->increment('replies_count');
        });

        static::deleted(function ($reply) {
            $reply->thread->decrement('replies_count');
        });
    }

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
