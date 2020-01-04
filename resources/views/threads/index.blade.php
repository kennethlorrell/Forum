@extends('layouts.app')

@section('content')
	@forelse ($threads as $thread)
		@include('threads.card')
	@empty
		<h1>There is empty yet. Don't be so shy and add some awesome thread to discuss!</h1>
	@endforelse
@endsection