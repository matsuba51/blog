@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg admin">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">管理メニュー</h1>

        <!-- ボタン群（縦並びで確実に表示されるように修正） -->
        <div class="flex flex-col items-center gap-4 w-full">
            <a href="{{ route('admin.blogs') }}" 
               class="w-full max-w-sm py-3 text-lg bg-blue-500 text-white rounded-md text-center shadow-md hover:bg-blue-600">
                📖 ブログ一覧
            </a>
            <a href="{{ route('admin.users') }}" 
               class="w-full max-w-sm py-3 text-lg bg-blue-500 text-white rounded-md text-center shadow-md hover:bg-blue-600">
                👥 ユーザー管理
            </a>
            <a href="{{ route('admin.tags') }}" 
               class="w-full max-w-sm py-3 text-lg bg-blue-500 text-white rounded-md text-center shadow-md hover:bg-blue-600">
                🏷️ タグ管理
            </a>
            <a href="{{ route('admin.charts') }}" 
               class="w-full max-w-sm py-3 text-lg bg-blue-500 text-white rounded-md text-center shadow-md hover:bg-blue-600">
                📊 日ごとの投稿数
            </a>
        </div>

        <!-- 戻るボタン -->
        <div class="mt-6 text-center w-full">
            <a href="{{ route('blogs.index') }}" 
               class="inline-block px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                ブログ一覧に戻る
            </a>
        </div>
    </div>
@endsection
