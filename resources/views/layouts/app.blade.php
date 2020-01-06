<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        [v-cloak] { display: none; }
    </style>
</head>
<body>
    <div id="app">
        @include('layouts.nav')
        <main class="py-4 container">
            @yield('content')
        </main>
        <flash message="{{ session('flash') }}"></flash>
    </div>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script>
        window.App = {!! json_encode([
            'user' => Auth::user(),
            'signedIn' => Auth::check()
        ]) !!};
    </script>
</body>
</html>
