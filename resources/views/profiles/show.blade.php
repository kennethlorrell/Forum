@extends('layouts.app')

@section('content')
	<div class="mx-auto">
		<h1 class="text-center pb-4">
			<a class="text-l" href="{{ route('profile', $user->name) }}">{{ $user->name }}</a> 
			joined <a href="/">Forum</a> 
			{{ $user->created_at->diffForHumans() }}
		</h1>
		@forelse ($activities as $date => $activity)
			<h4 class="text-center mt-4">{{ $date }}</h4>
			@foreach($activity as $action)
				@if ($action->activable)
					@include("profiles.activities.{$action->type}", ['activity' => $action])
				@endif
			@endforeach
		@empty
			<p>This user hasn't perform any activities yet...</p>
		@endforelse
	</div>
@endsection
