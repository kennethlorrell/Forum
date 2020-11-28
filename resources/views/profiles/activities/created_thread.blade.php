@component('profiles.activities.activity')

	@slot('heading')
		{{ $user->name }} created <a href="{{ $activity->activable->path() }}">
	     	{{ $activity->activable->title }}
	    </a>
	@endslot

	@slot('body')
		{{ $activity->activable->description }}
	@endslot

@endcomponent