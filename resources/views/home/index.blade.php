@extends('home.layouts.app')

@section('content')
    <main class="py-4">
        <div class="container mx-auto">
            <div id="app" class="mx-4 lg:ml-0">
                <App></App>
            </div>
        </div>
    </main>

    <script src="{{ asset('js/main/main.js') }}" defer></script>

@endsection

