<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Blog</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-gray-900 text-white">
    <!-- ヘッダー -->
    <header class="bg-gray-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16 relative">
            <!-- ロゴ -->
            <a href="{{ route('home') }}" class="text-xl font-bold text-white">
                Laravel Blog
            </a>

            <!-- ハンバーガーメニュー（右側） -->
            <button id="menu-toggle" class="sm:hidden text-white focus:outline-none absolute right-4">
                ☰
            </button>

            <!-- ナビゲーションメニュー（PC用） -->
            <nav class="hidden sm:flex space-x-6">
                <a href="{{ route('home') }}" class="nav-link">ホーム</a>
                <a href="{{ route('blogs.index') }}" class="nav-link">ブログ一覧</a>

                @auth
                    <a href="{{ route('blogs.create') }}" class="nav-link">新規投稿</a>
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">管理画面</a>
                    @endif
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-red-400 hover:bg-red-500">
                        ログアウト
                    </a>
                @else
                    <a href="{{ route('login') }}" class="nav-link">ログイン</a>
                    <a href="{{ route('register') }}" class="nav-link">新規登録</a>
                @endauth
            </nav>
        </div>

        <!-- モバイルメニュー -->
        <div id="mobile-menu" class="sm:hidden bg-gray-800 shadow-md absolute top-0 left-0 right-0 bottom-0 z-50 transform -translate-x-full transition-transform duration-300 ease-in-out">
            <nav class="flex flex-col space-y-2 p-4">
                <a href="{{ route('home') }}" class="mobile-nav-link">ホーム</a>
                <a href="{{ route('blogs.index') }}" class="mobile-nav-link">ブログ一覧</a>

                @auth
                    <a href="{{ route('blogs.create') }}" class="mobile-nav-link">新規投稿</a>
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="mobile-nav-link">管理画面</a>
                    @endif
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mobile-nav-link text-red-400 hover:bg-red-500">
                        ログアウト
                    </a>
                @else
                    <a href="{{ route('login') }}" class="mobile-nav-link">ログイン</a>
                    <a href="{{ route('register') }}" class="mobile-nav-link">新規登録</a>
                @endauth
            </nav>
        </div>
    </header>

    <!-- メインコンテンツ -->
    <main class="w-full mx-auto p-6">
        @yield('content')
    </main>

    <!-- フッター -->
    <footer class="bg-gray-800 text-center py-4 w-full">
        <p class="text-white">&copy; 2025 Laravel Blog</p>
    </footer>
</body>
</html>
