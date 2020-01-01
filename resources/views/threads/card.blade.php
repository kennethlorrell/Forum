<div class="border border-indigo-400 bg-teal-100 mb-3 px-4 py-4">
	<div class="flex justify-between">
		<a href="{{ $thread->path() }}">
			<h1 class="font-bold text-xl mt-2 mb-4 text-teal-800 hover:text-teal-500">
				{{ $thread->title }}
			</h1>
		</a>
		<a href="{{ $thread->path() }}" class="font-bold text-blue-500">{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</a>
	</div>
	<p class="text-gray-800 text-base">{{ $thread->description }}</p>
</div>
