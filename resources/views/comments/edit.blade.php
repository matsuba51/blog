@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg share">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">コメント編集</h2>

        <form action="{{ route('comment.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <textarea name="content" required 
                    class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" rows="4">{{ old('content', $comment->content) }}
                </textarea>
            </div>

            @error('content')
                <div class="text-red-500 mb-4">{{ $message }}</div>
            @enderror

            <button type="submit" class="px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:ring-2 focus:ring-blue-500">
                更新する
            </button>
        </form>

        <div class="mt-4">
            <a href="{{ route('blog.show', $comment->blog_id) }}" class="inline-block px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                コメント一覧に戻る
            </a>
        </div>
    </div>
@endsection