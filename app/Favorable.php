<?php

namespace App;

trait Favorable
{
    public static function bootFavorable()
    {
        static::deleting(function ($model) {
            $model->favorites->each->delete();
        });
    }

    public function favorites()
    {
        return $this->morphMany('App\Favorite', 'favorable');
    }

    public function favorite()
    {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->favorites()->where($attributes)->exists()) {
            return $this->favorites()->create($attributes);
        }
    }

    public function unfavorite()
    {
        $attributes = ['user_id' => auth()->id()];

        return $this->favorites()->where($attributes)->get()->each->delete();
    }

    public function isFavorite()
    {
        return !! $this->favorites->where('user_id', auth()->id())->count();
    }

    public function getFavoritesStatusAttribute()
    {
        return $this->isFavorite();
    }

    public function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
}