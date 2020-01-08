@extends('layouts.app')

@section('content')

	<thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
		<div class="row">
			<div class="col-8">

				<div class="card">

					<div class="card-header d-flex justify-content-between">
						<h3 class="card-title">
						<a href="{{ $thread->path() }}">{{ $thread->title }}</a>
						</h3>
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

				<replies @added="repliesCount++" @removed="repliesCount--"></replies>

			</div>

			<div class="col-4">
				
				<div class="card">
					
					<div class="card-body d-flex flex-column align-items-center">

						<p class="card-text text-center">
							This thread was created 
							{{ $thread->created_at->diffForHumans() }} 
							by 
							<a href="/profiles/{{ $thread->creator->name }}">{{ $thread->creator->name }}</a>
							and has 
							<span v-text="repliesCount"></span>
							{{ Str::plural('reply', $thread->replies_count) }} 
							so far
						</p>

						<subscribe-button :active="{{ json_encode($thread->isSubsribedTo) }}"></subscribe-button>

					</div>

				</div>

			</div>

		</div>
	</thread-view>

@endsection
