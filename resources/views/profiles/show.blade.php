@extends('layouts.app')

@section('content')
	<div class="w-2/3 mx-auto">
		<h1 class="text-center pb-4">
			<a class="text-xl" href="{{ route('profile', $user->name) }}">{{ $user->name }}</a> joined
			{{ $user->created_at->diffForHumans() }}
		</h1>
		@forelse ($threads as $thread)
			@include('threads.card')
		@empty
			<p>This user hasn't created any threads yet...</p>
		@endforelse
		<div class="p-3">
			{{ $threads->links() }}
		</div>
	</div>
@endsection
