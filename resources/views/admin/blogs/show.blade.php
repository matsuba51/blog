@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg admin">
    
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $blog->title }}</h1>
        <p class="text-gray-600 italic mb-4">投稿者: {{ $blog->user->name }}</p>
        <div class="text-lg leading-relaxed text-gray-700 mb-6">{{ $blog->content }}</div>

        <div class="text-center">
            <a href="{{ route('admin.blogs') }}" 
               class="inline-block px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                ブログ一覧に戻る
            </a>
        </div>
    </div>
@endsection
