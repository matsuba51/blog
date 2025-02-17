@extends('layouts.app')

@section('content')
@if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
        {{ session('success') }}
    </div>
@endif

<h1 class="text-2xl font-bold text-center mb-6">ブログ一覧</h1>

<ul class="space-y-4">
    @foreach ($blogs as $blog)
        <li class="bg-gray-800 p-4 rounded-md shadow">
            <h2 class="text-xl font-bold">
                <a href="{{ route('blogs.show', $blog->id) }}" class="text-blue-400 hover:underline">
                    {{ $blog->title }}
                </a>
            </h2>
            <p class="text-gray-400">投稿者: {{ $blog->user->name }}</p>

            <!-- 編集ボタンと削除ボタン（自分の投稿したブログのみ表示） -->
            @if (Auth::check() && Auth::id() === $blog->user_id)
                <div class="mt-4">
                    <!-- 編集ボタン -->
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn-primary">編集</a>

                    <!-- 削除ボタン -->
                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="inline-block ml-2" onsubmit="return confirm('本当に削除しますか？');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">削除</button>
                    </form>
                </div>
            @endif
        </li>
    @endforeach
</ul>
@endsection
