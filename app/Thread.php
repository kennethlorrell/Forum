<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = [
        'title', 'description', 'owner_id', 'category_id'
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('replyCount', function ($builder) {
            $builder->withCount('replies');
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
