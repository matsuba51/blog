<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }} - 管理画面</title>
        <link rel="icon" href="{{ asset('blog.png') }}" type="image/png">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- CSS & JavaScript (Vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen">

            <nav class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-center h-16 items-center">
                        <a href="{{ route('admin.dashboard') }}" class="font-semibold text-3xl">Laravel</a>
                    </div>
                </div>
            </nav>

        @if(session('success'))
                <div class="alert alert-success bg-green-500 border-l-4 border-green-500 text-white p-4 mb-4 text-center mx-auto">
                    {{ session('success') }}
                </div>
            @endif

            <main class="py-6">
                @yield('content')
            </main>
        </div>

        <footer class="bg-gray-800 text-white text-center py-4 mt-8">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </footer>
    </body>
</html>
