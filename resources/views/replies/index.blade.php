@can('create', App\Reply::class)
	@include('replies.create')
@endcan
@cannot('create', App\Reply::class)
	<p class="text-center my-5">
		Please, <a href="{{ route('login') }}" class="text-blue-700 font-bold">login</a> to participate in discussion
	</p>
@endcannot
@forelse ($thread->replies->sortByDesc('created_at') as $reply)
	@include('replies.reply')
@empty
	<h1>No replies so far. Would you like to share your opinion about this topic?</h1>
@endforelse
