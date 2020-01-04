<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Threads</a>
    <div class="dropdown-menu">
      <a class="nav-link" href="{{ route('threads') }}">All Threads</a>
      <div class="dropdown-divider"></div>
      @if (auth()->check())
	      <a class="nav-link" href="{{ route('threads') . '?by=' . auth()->user()->name }}">My Threads</a>
      @endif
      <a class="nav-link" href="{{ route('threads') . '?popular=1' }} ">Popular Threads</a>
    </div>
  </li>
                    