@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-gray-800 text-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-6">ブログ編集</h1>

        <!-- エラーメッセージの表示 -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block font-semibold mb-2">タイトル</label>
                <input type="text" name="title" id="title" value="{{ old('title', $blog->title) }}" 
                    class="w-full bg-gray-700 text-white border border-gray-600 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                    required>
            </div>

            <div class="mb-4">
                <label for="content" class="block font-semibold mb-2">内容</label>
                <textarea name="content" id="content" rows="5" 
                    class="w-full bg-gray-700 text-white border border-gray-600 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400" 
                    required>{{ old('content', $blog->content) }}</textarea>
            </div>

            <div class="flex justify-between">
                <button type="submit" class="btn-primary">更新</button>
                <a href="{{ route('admin.blogs.index') }}" class="btn-secondary">戻る</a>
            </div>
        </form>
    </div>
@endsection
