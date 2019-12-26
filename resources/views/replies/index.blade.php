@can('create', App\Reply::class)
	@include('replies.create')
@endcan
@forelse ($thread->replies->sortByDesc('created_at') as $reply)
	@include('replies.reply')
@empty
	<h1>No replies so far. Would you like to share your opinion about this topic?</h1>
@endforelse
