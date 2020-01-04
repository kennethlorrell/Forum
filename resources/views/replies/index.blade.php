@forelse ($replies as $reply)
	@include('replies.card')
@empty
	<p>No replies so far. Would you like to share your opinion about this topic?</p>
@endforelse
{{ $replies->links() }}
@can('create', App\Reply::class)
	@include('replies.create')
@endcan
@cannot('create', App\Reply::class)
	<p class="mx-auto">
		Please, <a href="{{ route('login') }}" class="">login</a> to participate in discussion
	</p>
@endcannot
