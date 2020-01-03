<nav class="bg-blue-900 shadow mb-8 py-6">
    <div class="container mx-auto px-6 md:px-0">
        <div class="flex items-center justify-center text-gray-100 no-underline text-lg">
            <div class="font-semibold">
                <a href="{{ url('/') }}" class="mr-6">{{ config('app.name', 'Forum') }}</a>
                <a href="{{ route('threads') }}" class="mr-6">Threads</a>
                @if (auth()->user())
                    <a href="{{ route('threads') . '?by=' . auth()->user()->name }}" class="mr-6">My Threads</a>
                @endif
                    <a href="/threads/create" class="mr-6">New Thread</a>
                @include('categories.list')
            </div>
            <div class="flex-1 text-right">
                @guest
                    <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                    @else
                        <span class="text-gray-300 text-sm pr-4">
                            <a href="{{ route('profile', auth()->user()->name) }}">{{ Auth::user()->name }}</a>
                        </span>
                        <a href="{{ route('logout') }}"
                            class="no-underline hover:underline text-gray-300 text-sm p-3"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            {{ csrf_field() }}
                        </form>
                @endguest
            </div>
        </div>
    </div>
</nav>