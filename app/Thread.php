<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $fillable = [
        'title', 'description'
    ];

    public function replies() 
    {
    	return $this->hasMany('App\Reply');
    }

    public function creator()
    {
    	return $this->belongsTo('App\User', 'owner_id');
    }

    public function path()
    {
        return "/threads/{$this->id}";
    }
}
