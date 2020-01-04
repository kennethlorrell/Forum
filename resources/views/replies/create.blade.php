<form method="POST" action="{{ $thread->path() . '/replies' }}">
	@csrf
	<div class="form-group">
	   <textarea class="form-control" name="body" rows="4" 
	   placeholder="Do you mind share your opinion about the topic?"></textarea>
	 </div>
	 <button type="submit" class="btn btn-primary mb-2">Add reply</button>
	 @include('threads.validate')
</form>