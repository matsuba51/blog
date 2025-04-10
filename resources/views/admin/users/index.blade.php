@extends('layouts.admin')

@section('content')
    <div class="max-w-6xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">ユーザー 一覧</h1>

        <!-- テーブルの横スクロール対応 -->
        <div class="overflow-x-auto">
            <table class="w-full min-w-[600px] border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2 min-w-[200px]">名前</th>
                        <th class="border border-gray-300 px-4 py-2 min-w-[250px]">メールアドレス</th>
                        <th class="border border-gray-300 px-4 py-2 min-w-[150px]">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="hover:bg-gray-200">
                            <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center whitespace-nowrap">
                                <!-- 詳細ページへのリンク -->
                                <a href="{{ route('admin.users.show', $user->id) }}" 
                                class="inline-block px-4 py-1 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">
                                詳細
                                </a>
                            
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block">
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
    </div>

    <div class="mt-6 flex flex-col items-center">
        <p class="text-sm text-gray-700 mb-2">
            {{ $users->firstItem() }} - {{ $users->lastItem() }} 件目を表示（全 {{ $users->total() }} 件）
        </p>

        <nav aria-label="Page navigation">
            <ul class="inline-flex items-center -space-x-px">
                <!-- 「最初へ」ボタン -->
                @if (!$users->onFirstPage())
                    <li  class="hidden sm:flex">
                        <a href="{{ $users->url(1) }}" class="px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700">
                            « 最初へ
                        </a>
                    </li>
                @endif

                <!-- 「前へ」ボタン -->
                @if ($users->previousPageUrl())
                    <li class="hidden sm:flex">
                        <a href="{{ $users->previousPageUrl() }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            ‹ 前へ
                        </a>
                    </li>
                @endif

                <!-- ページ番号 -->
                @php
                    $start = max(1, $users->currentPage() - 2);
                    $end = min($users->lastPage(), $users->currentPage() + 2);
                @endphp

                <!-- 最初のページ -->
                @if ($start > 1)
                    <li>
                        <a href="{{ $users->url(1) }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            1
                        </a>
                    </li>
                    @if ($start > 2)
                        <li><span class="px-3 py-2">...</span></li>
                    @endif
                @endif

                <!-- 現在ページの前後 -->
                @for ($i = $start; $i <= $end; $i++)
                    @if ($i == $users->currentPage())
                        <li>
                            <span class="px-3 py-2 leading-tight text-white bg-blue-500 border border-blue-500">{{ $i }}</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $users->url($i) }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                                {{ $i }}
                            </a>
                        </li>
                    @endif
                @endfor

                <!-- 最後のページ -->
                @if ($end < $users->lastPage())
                    @if ($end < $users->lastPage() - 1)
                        <li><span class="px-3 py-2">...</span></li>
                    @endif
                    <li>
                        <a href="{{ $users->url($users->lastPage()) }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            {{ $users->lastPage() }}
                        </a>
                    </li>
                @endif

                <!-- 「次へ」ボタン -->
                @if ($users->nextPageUrl())
                    <li class="hidden sm:flex">
                        <a href="{{ $users->nextPageUrl() }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700">
                            次へ ›
                        </a>
                    </li>
                @endif

                <!-- 「最後へ」ボタン -->
                @if ($users->hasMorePages())
                    <li class="hidden sm:flex">
                        <a href="{{ $users->url($users->lastPage()) }}" class="px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700">
                            最後へ »
                        </a>
                    </li>
                @endif
                
            </ul>
        </nav>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('admin.dashboard', $user->id) }}"
            class="inline-block px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600">
            管理画面に戻る
        </a>
    </div>
@endsection
