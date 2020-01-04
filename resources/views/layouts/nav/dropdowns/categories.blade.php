<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Categories</a>
    <div class="dropdown-menu">
      	@foreach ($categories as $category)
    		<a class="dropdown-item" href="{{ $category->path() }}">{{ $category->name }}</a>   
    	@endforeach
    </div>
  </li>
