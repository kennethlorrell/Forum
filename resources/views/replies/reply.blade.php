<div class="border border-blue-400 bg-blue-100 my-3">
	<div class="p-2 flex justify-between">
		<h3>{{ $reply->owner->name }} replied {{ $reply->created_at->diffForHumans() }}</h3>
		<form action="/replies/{{ $reply->id }}/favorites" method="POST">
			@csrf
			<button type="submit" class="py-2 px-4 rounded bg-blue-100 text-blue-600 
			{{ $reply->isFavorite() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-blue-200'}}">
				{{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}
			</button>
		</form>
	</div>
	<p class=p-2>{{ $reply->body }}</p>
</div>