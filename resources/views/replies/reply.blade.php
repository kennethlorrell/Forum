<div class="border border-red-600 bg-red-200 my-3">
	<div class="p-2 flex justify-between">
		<span class="text-xl font-bold text-blue-500">{{ $reply->owner->name }}</span>
		<span class="self-end text-gray-700">{{ $reply->created_at->diffForHumans() }}</span>
	</div>
	<p class=p-2>{{ $reply->body }}</p>
</div>