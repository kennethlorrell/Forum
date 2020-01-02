@extends('layouts.app')

@section('content')
	<div class="flex mb-4">
		<div class="w-3/4">
			@include('threads.card')
			@include('replies.index')
		</div>
		<div class="w-1/4 p-4 text-center">
			<div class="text-blue-800 p-4 pt-0 font-bold">ACTIVITY</div>
			<p>{{ $thread->creator->name }} created 
				<a href="#" class="text-blue-600">
					<strong>{{ $thread->title }}</strong>
				</a> {{ $thread->created_at->diffForHumans() }}.
			</p>
			<p class="mt-3">{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }} so far...</p>
		</div>
	</div>
@endsection