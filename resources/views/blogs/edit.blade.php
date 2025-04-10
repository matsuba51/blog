@extends('layouts.app')

@section('content')
    <div class="max-w-lg mx-auto bg-white shadow-md rounded-lg p-6 share">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">ブログ編集</h1>

        <form action="{{ route('blog.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')  <!-- 更新処理のためPUTメソッド指定 -->

            <div class="mb-4">
                <label for="title" class="block text-gray-700 font-medium">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}"
                     class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-gray-700 font-medium">本文</label>
                <textarea name="content" id="content" rows="5" 
                    class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>{{ old('content', $blog->content) }}</textarea>
            </div>

            <button type="submit"
                class="px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                更新する
            </button>
        </form>

        <div class="mt-4 flex justify-between">
            <a href="{{ route('blog.show', $blog->id) }}" class="px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                ブログ詳細に戻る
            </a>
        </div>
    </div>
@endsection
