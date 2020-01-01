@extends('layouts.app')

@section('content')
	<div class="flex mb-4">
		<div class="w-3/4">
			@include('threads.card')
			@include('replies.index')
		</div>
		<div class="w-1/4 p-4 text-center">
			<div class="text-blue-800 p-4 pt-0 font-bold">ACTIVITY</div>
			<p>{{ $thread->creator->name }} created {{ $thread->title }} {{ $thread->created_at->diffForHumans() }}.</p>
			<p>There is {{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</p>
		</div>
	</div>
@endsection