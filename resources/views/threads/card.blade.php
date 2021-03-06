<div class="card my-4">
	<div class="card-header d-flex justify-content-between">
		<h3 class="card-title">
	    	<a href="{{ $thread->path() }}">{{ $thread->title }}</a> 
	    	<small class="text-muted"> created {{ $thread->created_at->diffForHumans() }}</small>
	    </h3>
		<h6 class="card-subtitle text-muted m-0">
	    	{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}
	    </h6>
	</div>
  	<div class="card-body">
	    
	    <p class="card-text">
	    	{{ $thread->description }}
	    </p>
  	</div>
	@can('update', $thread)
	  	<div class="card-footer">
			<form action="{{ $thread->path() }}" method="POST">
				@csrf
				@method('DELETE')
				<button class="btn btn-danger" type="submit">Delete</button>
			</form>
	  	</div>
	@endcan
</div>