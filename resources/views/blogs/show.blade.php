@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-4 border-b pb-2">{{ $blog->title }}</h1>

        <div class="text-gray-600 text-sm mb-4">
            <p>投稿者: <strong>{{ $blog->user->name }}</strong></p>
            <p>投稿日: {{ $blog->created_at->format('Y-m-d H:i') }}</p>
        </div>

        @if ($blog->tags->isNotEmpty())
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-2">タグ</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach ($blog->tags as $tag)
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
        @endif

        <p class="text-gray-700 text-lg leading-relaxed mb-6">{{ $blog->content }}</p>

        <hr class="my-6">

        <!-- ブログ編集・削除（投稿者のみ） -->
        @auth
            @if (Auth::id() === $blog->user_id)
            <div class="flex gap-4">
               
                <a href="{{ route('blog.edit', $blog->id) }}" 
                class="px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600">
                    編集する
                </a>

                <form action="{{ route('blog.destroy', $blog->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-3 bg-red-500 text-white rounded-md hover:bg-red-600"
                            onclick="return confirm('本当に削除しますか？')">
                        削除する
                    </button>
                </form>
            </div>
            @endif
        @endauth

        <h3 class="text-xl font-semibold mt-6 mb-4">コメント</h3>

        @if ($blog->comments->isEmpty())
            <p class="text-gray-500">まだコメントはありません。</p>
        @else
            @foreach ($blog->comments as $comment)
                <div class="border p-4 mb-4 rounded-lg bg-gray-100 shadow-sm">
                    <p><strong class="text-gray-800">{{ $comment->user->name }}</strong>: {{ $comment->content }}</p>

                    <!-- コメント編集・削除（投稿者のみ） -->
                    @auth
                        @if (Auth::id() === $comment->user_id)
                        <div class="mt-2 flex">
                            <a href="{{ route('comment.edit', $comment->id) }}"
                            class="mr-2 px-4 py-2 bg-green-500 text-white rounded-md shadow-md hover:bg-green-600">
                                編集する
                            </a>

                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-md shadow-md hover:bg-red-600"
                                        onclick="return confirm('本当に削除しますか？')">
                                    削除する
                                </button>
                            </form>
                        </div>
                        @endif
                    @endauth
                </div>
            @endforeach
        @endif

        <!-- コメント投稿フォーム（ログインユーザーのみ） -->
        @auth
            <form action="{{ route('comment.store', $blog->id) }}" method="POST" class="mt-6">
                @csrf
                <textarea name="content" placeholder="コメントを追加..." required rows="3"
                          class="w-full p-3 border rounded-md focus:ring-2 focus:ring-blue-400"></textarea>

                @error('content')
                    <div class="text-red-500 mb-4">{{ $message }}</div>
                @enderror

                <button type="submit" class="px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    コメントする
                </button>
            </form>
        @endauth

        <!-- 未ログインユーザーへのメッセージ -->
        @guest
            <div class="mt-6 p-4 bg-yellow-100 border-yellow-500 text-yellow-800 rounded-md text-center">
                <p class="mb-2 font-semibold">コメントを投稿するにはログインが必要です。</p>
                <a href="{{ route('login') }}" class="inline-flex items-center px-5 py-2 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H3m0 0l4-4m-4 4l4 4m8-9V4a2 2 0 012-2h4a2 2 0 012 2v16a2 2 0 01-2 2h-4a2 2 0 01-2-2v-5"></path>
                    </svg>
                    ログインしてコメントする
                </a>
            </div>
        @endguest

        <div class="mt-8 flex flex-wrap gap-4">
            <a href="{{ route('blogs.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                ブログ一覧に戻る
            </a>
        </div>
    </div>
@endsection
