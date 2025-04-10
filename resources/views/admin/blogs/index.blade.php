@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">ブログ一覧（管理者）</h1>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2">タイトル</th>
                        <th class="border border-gray-300 px-4 py-2">投稿者</th>
                        <th class="border border-gray-300 px-4 py-2">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                        <tr class="hover:bg-gray-200">
                            <td class="border border-gray-300 px-4 py-2">{{ $blog->title }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $blog->user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center whitespace-nowrap">
                                
                                <a href="{{ route('admin.blogs.show', $blog->id) }}" 
                                   class="inline-block px-4 py-1 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">
                                    詳細
                                </a>

                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="inline-block px-4 py-1 bg-red-500 text-white rounded-md shadow-md hover:bg-red-600"
                                        onclick="return confirm('本当に削除しますか？')">
                                        削除
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                            <a href="{{ $blogs->previousPageUrl() }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
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

        <div class="mt-6 text-center">
            <a href="{{ route('admin.dashboard') }}" class="inline-block px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                管理画面に戻る
            </a>
        </div>
    </div>
@endsection
