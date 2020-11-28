<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = [];

    public function activable()
    {
    	return $this->morphTo();
    }

    public static function feed($user, $take = 50)
    {
    	return static::where('user_id', $user->id)
    		->latest()
    		->with('activable')
    		->take($take)
    		->get()
            ->groupBy(fn($activity) => 
    			$activity->created_at->format('Y-m-d'));
    }
}
