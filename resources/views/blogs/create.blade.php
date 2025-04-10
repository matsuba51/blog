@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg share">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">新規投稿</h1>

        @auth
            <form action="{{ route('blog.store') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" required 
                        class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    @if ($errors->has('title'))
                        <div class="text-red-500 mt-2 text-sm">{{ $errors->first('title') }}</div>
                    @endif
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">本文</label>
                    <textarea name="content" id="content" required 
                        class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('content') }}
                    </textarea>

                    @if ($errors->has('content'))
                        <div class="text-red-500 mt-2 text-sm">{{ $errors->first('content') }}</div>
                    @endif
                </div>

                <div class="mb-6">
                    <label for="tags" class="block text-sm font-medium text-gray-700">タグ</label>
                    <select name="tags[]" id="tags" multiple 
                        class="mt-1 block w-full p-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('tags'))
                        <div class="text-red-500 mt-2 text-sm">{{ $errors->first('tags') }}</div>
                    @endif
                </div>

                <button type="submit" class="px-6 py-3 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    投稿する
                </button>
            </form>

            <a href="{{ route('blogs.index') }}" class="inline-block px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600 mt-4">
                ブログ一覧に戻る
            </a>
        @endauth

        @guest
            <p class="mt-4 text-center text-gray-600">ログインしてください</p>
        @endguest
    </div>
@endsection
