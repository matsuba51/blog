@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6">コメント編集</h1>

        <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="content" class="block text-sm font-medium text-white">コメント内容</label>
                <textarea name="content" id="content" class="w-full p-4 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="6" required>{{ old('content', $comment->content) }}</textarea>
            </div>

            <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300">更新する</button>
        </form>

        <!-- 戻るボタン: コメント編集ページからブログ詳細ページに戻る -->
        <div class="mt-6">
            <a href="{{ route('blogs.show', $comment->blog_id) }}" class="btn-secondary">戻る</a>
        </div>
    </div>
@endsection