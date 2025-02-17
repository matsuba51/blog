@extends('layouts.app')

@section('content')
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold">{{ $blog->title }}</h1>
        <p class="text-gray-400">投稿者: {{ $blog->user->name }}</p>
        <p class="mt-4">{{ $blog->body }}</p>
    </div>

    <div class="mt-6">
        <h2 class="text-xl font-bold">コメント</h2>
        <ul class="space-y-4 mt-4">
            @foreach ($blog->comments as $comment)
                <li class="bg-gray-700 p-4 rounded-md shadow">
                    <strong class="text-blue-300">{{ $comment->user->name }}</strong>: 
                    <span id="comment-text-{{ $comment->id }}">{{ $comment->content }}</span>

                    @if (Auth::check() && Auth::id() === $comment->user_id)
                        <!-- 編集ボタン: コメント編集ページに遷移 -->
                        <a href="{{ route('comments.edit', $comment->id) }}" class="btn-edit">編集</a>

                        <!-- コメント削除フォーム -->
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('本当に削除しますか？');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete">削除</button>
                        </form>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>


    @auth
        <div class="mt-6">
            <form action="{{ route('comments.store', $blog->id) }}" method="POST" class="bg-gray-800 p-4 rounded-lg shadow-lg">
                @csrf
                <textarea class="w-full p-2 text-black rounded-md" name="content" rows="4" placeholder="コメントを入力"></textarea>
                <button type="submit" class="btn-primary mt-2">コメントを投稿</button>
            </form>
        </div>
    @endauth

    <div class="mt-6">
        <!-- コメント編集後は必ずブログ詳細ページに戻る -->
        <a href="{{ route('blogs.index', $blog->id) }}" class="btn-secondary">戻る</a>
    </div>
@endsection
