@extends('home.layouts.app')

@section('content')
    <div class="container flex justify-center px-auto">
        <div class="px-10">
            <div class="card">
                <h1 class="text-xl">{{ __('Register') }}</h1>

                <div class="bg-gray-200 rounded-lg mt-4 px-6 py-6">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="flex flex-row mb-4 justify-between">
                            <label for="name" class="text-left text-md mr-4">{{ __('Name') }}</label>

                            <div class="flex flex-col w-64">
                                <input id="name" type="text"
                                       class="border px-2 py-1 border-2 rounded border-gray-500 @error('name') border-red-500 @enderror"
                                       name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="text-red-600 text-xs italic mt-1">
                                       {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-row mb-4 justify-between">
                            <label for="email"
                                   class="text-left text-md mr-4">{{ __('E-Mail Address') }}</label>

                            <div class="flex flex-col w-64">
                                <input id="email" type="email"
                                       class="border px-2 py-1 border-2 rounded border-gray-500 @error('email') border-red-500 @enderror"
                                       name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="text-red-600 text-xs italic mt-1">
                                       {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-row mb-4 justify-between">
                            <label for="password"
                                   class="text-left text-md mr-4">{{ __('Password') }}</label>

                            <div class="flex flex-col w-64">
                                <input id="password" type="password"
                                       class="border px-2 py-1 border-2 rounded border-gray-500 @error('password') border-red-500 @enderror"
                                       name="password"
                                       required autocomplete="new-password">

                                @error('password')
                                <span class="text-red-600 text-xs italic mt-1">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-row mb-4 justify-between">
                            <label for="password-confirm"
                                   class="text-left text-md mr-4">{{ __('Confirm Password') }}</label>

                            <div class="flex flex-col w-64">
                                <input id="password-confirm" type="password"
                                       class="border px-2 py-1 border-2 rounded border-gray-500"
                                       name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="flex flex-row mb-4 justify-between">
                            <button type="submit" class="bg-green-500 rounded-lg text-white px-6 py-2">
                                {{ __('Register') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
