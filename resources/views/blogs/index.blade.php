@extends('layouts.app')

@section('content')
    <div>
        <h1 id="top" class="text-2xl font-bold mb-6 blog">ブログ一覧</h1>
        <!-- 管理者のみ表示 -->
        @if(Auth::check() && Auth::user()->isAdmin())  
            <a href="{{ route('admin.dashboard') }}" 
                class="inline-block px-6 py-3 bg-green-500 text-white rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 control">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"></path>
                </svg>
                管理画面
            </a>
        @endif
    </div>

    <form action="{{ route('blogs.index') }}" method="GET" class="mb-6 search">
        <input type="text" name="search" value="{{ request()->get('search') }}" placeholder="検索..." class="p-2 border border-gray-300 rounded-md">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">検索</button>
    </form>
    @if($blogs->isEmpty())
        <p class="text-center text-gray-500 mt-6">該当するブログが見つかりませんでした。</p>
    @endif

    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 sm:gap-6">
        @foreach ($blogs as $blog)
            <div class="flex flex-col justify-between border p-4 rounded-lg bg-white shadow-md mb-2 h-full">
                <div>
                    <h2 class="text-lg font-semibold">
                        <a href="{{ route('blog.show', $blog->id) }}">{{ $blog->title }}</a>
                    </h2>
                    <p class="text-gray-600">投稿者: {{ $blog->user->name }}</p>
                    <p class="text-gray-500 text-sm mb-4">投稿日: {{ $blog->created_at->format('Y-m-d H:i') }}</p>
                    <p class="text-gray-700 mt-2">{{ Str::limit($blog->content, 50) }}</p>
                </div>

                <a href="{{ route('blog.show', $blog->id) }}" class="block mt-3 text-blue-500 hover:underline">
                    詳細を見る
                </a>
            </div>
        @endforeach
        </div>
    </div>

    <div class="mt-6 flex flex-col items-center">
        <p class="text-sm text-gray-700 mb-2">
            {{ $blogs->firstItem() }} - {{ $blogs->lastItem() }} 件目を表示（全 {{ $blogs->total() }} 件）
        </p>

        <nav aria-label="Page navigation">
            <ul class="inline-flex items-center -space-x-px">
                <!-- 「最初へ」ボタン -->
                @if (!$blogs->onFirstPage())
                    <li  class="hidden sm:flex">
                        <a href="{{ $blogs->url(1) }}" 
                            class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
                            « 最初へ
                        </a>
                    </li>
                @endif

                <!-- 「前へ」ボタン -->
                @if ($blogs->previousPageUrl())
                    <li class="hidden sm:flex">
                        <a href="{{ $blogs->previousPageUrl() }}" 
                            class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            ‹ 前へ
                        </a>
                    </li>
                @endif

                <!-- ページ番号 -->
                @php
                    $start = max(1, $blogs->currentPage() - 2);
                    $end = min($blogs->lastPage(), $blogs->currentPage() + 2);
                @endphp

                <!-- 最初のページ -->
                @if ($start > 1)
                    <li>
                        <a href="{{ $blogs->url(1) }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            1
                        </a>
                    </li>
                    @if ($start > 2)
                        <li><span class="px-3 py-2">...</span></li>
                    @endif
                @endif

                <!-- 現在ページの前後 -->
                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $blogs->currentPage())
                        <li>
                            <span class="px-3 py-2 leading-tight text-white bg-blue-500 border border-blue-500">{{ $i }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $blogs->url($i) }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                {{ $i }}
                            </a>
                        </li>
                    @endif
                @endfor

                <!-- 最後のページ -->
                @if ($end < $blogs->lastPage())
                    @if ($end < $blogs->lastPage() - 1)
                        <li><span class="px-3 py-2">...</span></li>
                    @endif
                    <li>
                        <a href="{{ $blogs->url($blogs->lastPage()) }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            {{ $blogs->lastPage() }}
                        </a>
                    </li>
                @endif

                <!-- 「次へ」ボタン -->
                @if ($blogs->nextPageUrl())
                    <li class="hidden sm:flex">
                        <a href="{{ $blogs->nextPageUrl() }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            次へ ›
                        </a>
                    </li>
                @endif

                <!-- 「最後へ」ボタン -->
                @if ($blogs->hasMorePages())
                    <li class="hidden sm:flex">
                        <a href="{{ $blogs->url($blogs->lastPage()) }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
                            最後へ »
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endsection
