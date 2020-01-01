<div class="border border-blue-400 bg-blue-100 my-3">
	<div class="p-2 flex justify-center">
		<h3>{{ $reply->owner->name }} replied {{ $reply->created_at->diffForHumans() }}</h3>
	</div>
	<p class=p-2>{{ $reply->body }}</p>
</div>