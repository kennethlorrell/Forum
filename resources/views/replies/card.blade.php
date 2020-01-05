<reply :attributes="{{ $reply }}" inline-template v-cloak>
	<div class="card my-4" id="reply-{{ $reply->id }}">
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
		    	<favorite :reply="{{ $reply }}"></favorite>
			@endauth
		</div>
	  	<div class="card-body">
		  	<div v-if="editing">
		  		<div class="form-group">
		  			<textarea class="form-control" v-model="body"></textarea>
		  		</div>
		  		<button class="btn btn-primary" @click="update">Update</button>
		  		<button class="btn" @click="editing = false">Cancel</button>
			</div>
	  		<div v-else>
	  			<p class="card-text" v-text="body"></p>
	  		</div>
	  	</div>
		@can('update', $reply)
	  		<div class="card-footer d-flex">
	  			<button class="btn btn-secondary mr-3" @click="editing = true">Edit</button> 
	  			<button class="btn btn-danger mr-3" @click="destroy">Delete</button> 
	  		</div>
		@endcan
	</div>
</reply>