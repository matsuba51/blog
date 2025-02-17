@extends('layouts.admin')

@section('content')
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg text-white"> <!-- text-white を追加 -->
        <h1 class="text-2xl font-bold">{{ $blog->title }}</h1>
        <p class="text-gray-400">投稿者: {{ $blog->user->name }}</p>
        <p class="mt-4">{{ $blog->body }}</p>
    </div>

    <!-- 管理者が編集・削除できる -->
    <div class="mt-4 flex space-x-4">
        <!-- 編集ボタン -->
        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn-primary">✏️ 編集</a>

        <!-- 削除ボタン -->
        <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete">🗑️ 削除</button>
        </form>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.blogs.index') }}" class="btn-secondary">⬅️ ブログ管理一覧へ戻る</a>
    </div>
@endsection
