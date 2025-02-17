@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-semibold mb-6 text-white">新規ブログ投稿</h1>

        <!-- エラーメッセージの表示 -->
        @if($errors->any())
            <div class="alert mb-4 bg-red-500 text-white p-4 rounded-md">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 新規投稿フォーム -->
        <form action="{{ route('blogs.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="form-group">
                <label for="title" class="block text-sm font-medium text-white">タイトル</label>
                <input type="text" name="title" id="title" class="w-full p-4 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('title') }}" required>
            </div>

            <div class="form-group">
                <label for="body" class="block text-sm font-medium text-white">内容</label>
                <textarea name="body" id="body" class="w-full p-4 bg-gray-700 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" rows="6" required>{{ old('body') }}</textarea>
            </div>

            <button type="submit" class="w-full py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 transition duration-300">投稿する</button>
        </form>
    </div>
@endsection
