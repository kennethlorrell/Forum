@foreach ($categories as $category)
  	<a href="{{ $category->path() }}">{{ $category->name }}</a>
 @endforeach