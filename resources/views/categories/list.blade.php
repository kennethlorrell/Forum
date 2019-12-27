@foreach (App\Category::all() as $category)
  	<a href="{{ $category->path() }}">{{ $category->name }}</a>
 @endforeach