@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">タグ管理</h1>

        <!-- 新規作成ボタン -->
        <div class="text-right mb-4">
            <a href="{{ route('admin.tags.create') }}" 
               class="inline-block px-6 py-3 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">
                新規タグ作成
            </a>
        </div>

        <!-- テーブルの横スクロール対応 -->
        <div class="overflow-x-auto">
            <table class="w-full min-w-[400px] border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="border border-gray-300 px-4 py-2 min-w-[200px]">タグ名</th>
                        <th class="border border-gray-300 px-4 py-2 min-w-[150px] text-center">操作</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr class="hover:bg-gray-200">
                            <td class="border border-gray-300 px-4 py-2">{{ $tag->name }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center whitespace-nowrap">
                                <a href="{{ route('admin.tags.edit', $tag->id) }}" 
                                   class="inline-block px-4 py-1 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">
                                    編集
                                </a>
                                <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST" class="inline-block ml-2">
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

        <div class="mt-6 text-center">
            <a href="{{ route('admin.dashboard') }}"
               class="inline-block px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                管理画面に戻る
            </a>
        </div>
    </div>
@endsection
