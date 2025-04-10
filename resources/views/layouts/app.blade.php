<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('blog.png') }}" type="image/png">
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <!-- CSS & JavaScript (Vite) -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body class="font-sans antialiased bg-gray-100">
        <div class="min-h-screen">
            <!-- ナビゲーションバー -->
            <nav class="bg-white shadow">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        <a href="{{ url('/') }}" class="font-semibold text-gray-900 text-3xl">
                            {{ config('app.name', 'Laravel') }}
                        </a>

                        <!-- ハンバーガーメニュー（モバイル対応） -->
                        <div class="block lg:hidden">
                            <button class="text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-1 focus:ring-indigo-300" id="navbar-toggler">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>
                        </div>

                        <div class="hidden lg:block">
                            <div class="flex items-center space-x-4">
                                @auth
                                    <span class="mr-4">【　ようこそ、{{ Auth::user()->name }} さん　】</span>
                                    <a href="{{ route('dashboard') }}" class="text-gray-800 hover:text-gray-600">ユーザー情報編集</a>
                                    <a href="{{ route('blog.create') }}" class="text-gray-800 hover:text-gray-600">新規投稿</a>

                                    <form action="{{ route('logout') }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-gray-800 hover:text-gray-600">ログアウト</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-800 hover:text-gray-600">ログイン</a>
                                    <a href="{{ route('register') }}" class="text-gray-800 hover:text-gray-600">新規登録</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ハンバーガーメニューのドロップダウン -->
                <div class="lg:hidden" id="navbar-menu" style="display: none;">
                    <div class="flex flex-col items-center bg-white py-6 space-y-4">
                        @auth
                            <span class="text-gray-800 text-xl">【　ようこそ、{{ Auth::user()->name }} さん　】</span>
                            <a href="{{ route('dashboard') }}" class="text-gray-800 hover:text-gray-600">ユーザー情報編集</a>
                            <a href="{{ route('blog.create') }}" class="text-gray-800 hover:text-gray-600">新規投稿</a>

                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-800 hover:text-gray-600">ログアウト</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-800 hover:text-gray-600">ログイン</a>
                            <a href="{{ route('register') }}" class="text-gray-800 hover:text-gray-600">新規登録</a>
                        @endauth
                    </div>
                </div>
            </nav>

            @if(session('success'))
                <div class="alert alert-success bg-green-500 border-l-4 border-green-500 text-white p-4 sm:mb-4 text-center mx-auto">
                    {{ session('success') }}
                </div>
            @endif

            <!-- ページヘッダー -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- ページコンテンツ -->
            <main class="py-6">
                @yield('content')
            </main>
        </div>

        <footer class="bg-gray-800 text-white text-center py-4 mt-8">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </footer>
    </body>
</html>
