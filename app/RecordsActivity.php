<?php

namespace App;

trait RecordsActivity
{
    public function activities()
    {
        return $this->morphMany('App\Activity', 'activable');
    }

    protected static function bootRecordsActivity()
    {
        if (auth()->check()) {
        	foreach (static::getActivitiesToRecord() as $event) {
    			static::$event(function ($model) use ($event) {
        			$model->recordActivity($event);
            	});
        	}
        }

        static::deleting(function ($model) {
            $model->activities()->delete();
        });
    }

    protected static function getActivitiesToRecord()
    {
    	return ['created'];
    }

    protected function recordActivity($event)
    {
    		$this->activities()->create([
    	        'user_id' => auth()->id(),
    	        'type' => $this->getActivityType($event),
    		]);
    }
	

	public function getActivityType($event)
	{
		$type = strtolower((new \ReflectionClass($this))->getShortName());

		return "{$event}_{$type}";
	}
}