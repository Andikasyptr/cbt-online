<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- Title Dinamis --}}
        <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

            <!-- Favicon -->
        <link rel="icon" href="{{ asset('images/logo.png') }}" type="images/png">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
   <body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col items-center justify-center bg-gray-200 dark:bg-gray-900">
        <div>
            <a href="/">
                <x-application-logo class="w-80 h-60 fill-current text-gray-500 mx-auto" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <div class="mt-8 text-center text-sm text-gray-400 dark:text-gray-300">
            © {{ date('Y') }} Inovasi Digital Nusantara. All rights reserved.
        </div>
    </div>
</body>


</html>
