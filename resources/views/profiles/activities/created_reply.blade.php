@component('profiles.activities.activity')

	@slot('heading')
		{{ $user->name }} replied to <a href="{{ $activity->activable->thread->path() }}">
	     	{{ $activity->activable->thread->title }}
	     </a>
	@endslot

	@slot('body')
		{{ $activity->activable->body }}
	@endslot

@endcomponent