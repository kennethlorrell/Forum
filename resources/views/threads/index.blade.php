@extends('layouts.app')

@section('content')
	@forelse ($threads as $thread)
		@include('threads.card')
	@empty
		<h4 class="text-center">There is empty yet. Don't be so shy and add some awesome thread to discuss!</h4>
	@endforelse
@endsection