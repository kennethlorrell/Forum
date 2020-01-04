<div class="card my-4">
	<div class="card-header d-flex justify-content-between">
		<div>
			<h3 class="card-title">
		    	<a href="{{ route('profile', $reply->owner->name) }}">{{ $reply->owner->name }}</a>
		    </h3>
			<h6 class="card-subtitle text-muted m-0">
		    	{{ $reply->created_at->diffForHumans() }}
		    </h6>
	    </div>
	    @auth
	    	<form action="/replies/{{ $reply->id }}/favorites" method="POST">
				@csrf
				<button type="submit" class="btn btn-success 
				{{ $reply->isFavorite() ? ' disabled' : ''}}">
					{{ $reply->favorites_count }} {{ Str::plural('Favorite', $reply->favorites_count) }}
				</button>
			</form>
		@endauth
	</div>
  	<div class="card-body">
	    <p class="card-text">
	    	{{ $reply->body }}
	    </p>
  	</div>
</div>