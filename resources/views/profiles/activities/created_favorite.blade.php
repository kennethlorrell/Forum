@component('profiles.activities.activity')

	@slot('heading')
		{{ $user->name }} favorited a <a href="{{ $activity->activable->favorable->path() }}">reply</a>
	@endslot

	@slot('body')
		{{ $activity->activable->favorable->body }}
	@endslot

@endcomponent