@extends('layouts.admin')

@section('content')
    <main class="flex-grow container mx-auto p-6">
        <h1 class="text-2xl font-bold text-center mb-6">管理メニュー</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 text-center">
            <!-- ボタン一覧 -->
            <a href="{{ route('admin.dashboard') }}" class="bg-indigo-600 text-white py-3 px-6 rounded-lg hover:bg-indigo-700 transition">
                ダッシュボード
            </a>
            <a href="{{ route('admin.blogs.index') }}" class="bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition">
                ブログ管理
            </a>
            <a href="{{ route('admin.users.index') }}" class="bg-green-600 text-white py-3 px-6 rounded-lg hover:bg-green-700 transition">
                ユーザー管理
            </a>
            <a href="{{ route('admin.tags.index') }}" class="bg-yellow-600 text-white py-3 px-6 rounded-lg hover:bg-yellow-700 transition">
                タグ管理
            </a>
        </div>

        <!-- 戻るボタン -->
        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="bg-gray-500 text-white py-3 px-6 rounded-lg hover:bg-gray-600 transition">
                ホームへ戻る
            </a>
        </div>
    </main>
@endsection
