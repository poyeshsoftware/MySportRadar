@extends('home.layouts.app')

@section('content')
    <div class="container flex justify-center px-auto">
        <div class="px-10 mb-10">

            <h1 class="text-xl mt-10">{{ __('Login') }}</h1>

            <div class="bg-gray-200 rounded-lg mt-4 px-6 py-6">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="flex flex-row mb-4 justify-between">
                        <label for="email"
                               class="text-left text-md mr-4">{{ __('E-Mail Address') }}</label>

                        <div class="flex flex-col w-64">
                            <input id="email" type="email"
                                   class="bg-white border px-2 py-1 border-2 rounded border-gray-500 @error('email') border-red-500 @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="text-red-600 text-xs italic mt-1">
                                      {{ $message }}
                                    </span>
                            @enderror
                        </div>


                    </div>

                    <div class="flex flex-row mb-4 justify-between">
                        <label for="password" class="text-left text-md mr-4">{{ __('Password') }}</label>

                        <div class="flex flex-col w-64">
                            <input id="password" type="password"
                                   class="bg-white border px-2 py-1 border-2 rounded border-gray-500 @error('password') border-red-500 @enderror"
                                   name="password" required
                                   autocomplete="current-password">

                            @error('password')
                            <span class="text-red-600 text-xs italic mt-1">
                                         {{ $message }}
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-row mb-4">
                        <div class="flex flex-row">
                            <input class="mr-2" type="checkbox" name="remember"
                                   id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="font-sm" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>

                    </div>

                    <div class="flex flex-row mb-4 items-center justify-between">
                        <button type="submit" class="bg-green-500 rounded-lg text-white px-6 py-2">
                            {{ __('Login') }}
                        </button>

                        {{--                        @if (Route::has('password.request'))--}}
                        {{--                            <a class="btn btn-link" href="{{ route('password.request') }}">--}}
                        {{--                                {{ __('Forgot Your Password?') }}--}}
                        {{--                            </a>--}}
                        {{--                        @endif--}}

                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
