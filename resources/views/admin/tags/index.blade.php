@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-gray-800 text-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-6">タグ管理</h1>

        <!-- タグ作成フォーム -->
        <form action="{{ route('admin.tags.store') }}" method="POST" class="mb-6">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium mb-2">タグ名</label>
                <input type="text" name="name" id="name" class="w-full bg-gray-700 text-white border border-gray-600 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <button type="submit" class="btn-primary w-full py-3">タグ追加</button>
        </form>

        <!-- 戻るボタン -->
        <div class="text-center mb-6">
            <a href="{{ route('admin.dashboard') }}" class="btn-secondary w-full py-3">管理画面に戻る</a>
        </div>

        <!-- タグ一覧 -->
        <h2 class="text-xl font-semibold mb-4">タグ一覧</h2>
        <ul class="space-y-4">
            @foreach($tags as $tag)
                <li class="bg-gray-700 p-4 rounded-md shadow flex justify-between items-center">
                    <span>{{ $tag->name }}</span>
                    <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">削除</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
