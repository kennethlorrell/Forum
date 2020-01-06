<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    use RecordsActivity;

    protected $fillable = [
        'title', 'description', 'owner_id', 'category_id'
    ];

    protected $with = [
        'creator', 'category',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($thread) {
            $thread->replies->each(function ($reply) {
                $reply->delete();
            });
        });
    }

    public function replies() 
    {
    	return $this->hasMany('App\Reply');
    }

    public function creator()
    {
    	return $this->belongsTo('App\User', 'owner_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function path()
    {
        return "/threads/{$this->category->slug}/{$this->id}";
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
}
