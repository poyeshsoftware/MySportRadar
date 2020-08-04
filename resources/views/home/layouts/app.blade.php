<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('main.name', 'Laravel') }}</title>

    <!-- Scripts -->


    <!-- Styles -->
    <link href="{{ asset('sass/app.css') }}" rel="stylesheet">
    @yield('head')
</head>

<body>
<div id="main">
    <nav class="bg-gray-200 border-b-2">
        <div class="container mx-auto flex flex-row justify-between py-4">
            <a class="block ml-6  font-medium" href="{{ url('/') }}">
                {{ config('main.name', 'Laravel') }}
            </a>


            <!-- Right Side Of Navbar -->
            <ul class="flex flex-row">
                <!-- Authentication Links -->
                @guest
                    <li class="mx-6">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @else
                    <li class="flex flex-row">
                        <a href="{{ route('dashboard') }}">
                            Dashboard
                        </a>

                        <div class="mx-4">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

        </div>
    </nav>


</div>

        @yield('content')


</body>
</html>
