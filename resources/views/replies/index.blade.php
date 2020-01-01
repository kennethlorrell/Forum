@can('create', App\Reply::class)
	@include('replies.create')
@endcan
@cannot('create', App\Reply::class)
	<p class="text-center my-5">
		Please, <a href="{{ route('login') }}" class="text-blue-700 font-bold">login</a> to participate in discussion
	</p>
@endcannot
@forelse ($replies as $reply)
	@include('replies.reply')
	{{ $replies->links() }}
@empty
	<h1>No replies so far. Would you like to share your opinion about this topic?</h1>
@endforelse
