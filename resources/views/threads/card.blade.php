<div class="border border-indigo-400 bg-teal-100 mb-3 px-4 py-4 ">
	<div class="flex justify-between">
		<a href="{{ $thread->path() }}">
			<h1 class="font-bold text-xl mt-2 mb-4 text-green-800 hover:text-blue-800">
				{{ $thread->title }}
			</h1>
		</a>
		<p>Created by {{ $thread->creator->name }} {{ $thread->created_at->diffForHumans() }}</p>
	</div>
	<p class="text-gray-700 text-base">{{ $thread->description }}</p>
</div>
