<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="{{ asset('js/jquery/jquery-3.7.1.js') }}"></script>
        <script src="{{ asset('js/bootstrap/bootstrap.bundle.js') }}"></script>
        <script src="{{ asset('js/utils/alerts.js') }}"></script>
        <script src="{{ asset('js/utils/ajax.js') }}"></script>
        <script src="{{ asset('js/utils/spinner.js') }}"></script>

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('css/midia-checking/layout.css') }}">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            
            <x-alerts></x-alerts>
            <x-loading></x-loading>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
