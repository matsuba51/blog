@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white shadow-lg rounded-lg admin">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">タグの編集</h1>

        <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST" autocomplete="on">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">タグ名</label>
                <input type="text" id="name" name="name" value="{{ $tag->name }}" required autocomplete="on"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div class="text-center">
                <button type="submit" 
                    class="px-6 py-3 bg-blue-500 text-white rounded-md shadow-md hover:bg-blue-600">
                    タグを更新
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <a href="{{ route('admin.tags') }}"
               class="inline-block px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                タグ一覧に戻る
            </a>
        </div>
    </div>
@endsection
