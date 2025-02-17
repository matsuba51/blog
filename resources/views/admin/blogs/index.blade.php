@extends('layouts.admin')

@section('content')
@if(session('success'))
    <div class="bg-green-500 text-white p-4 rounded-md mb-4">
        {{ session('success') }}
    </div>
@endif

<h1 class="text-2xl font-bold text-center mb-6">ブログ管理</h1>

<!-- レスポンシブテーブル -->
<div class="overflow-x-auto">
    <table class="w-full border-collapse border border-gray-700">
        <thead>
            <tr class="bg-gray-800 text-white">
                <th class="p-3 border border-gray-700">タイトル</th>
                <th class="p-3 border border-gray-700">投稿者</th>
                <th class="p-3 border border-gray-700">投稿日</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr class="bg-gray-700 text-white hover:bg-gray-600 transition">
                    <td class="p-3 border border-gray-600">
                        <a href="{{ route('admin.blogs.show', $blog->id) }}" class="text-blue-400 hover:underline">
                            {{ $blog->title }}
                        </a>
                    </td>
                    <td class="p-3 border border-gray-600">{{ $blog->user->name }}</td>
                    <td class="p-3 border border-gray-600">{{ $blog->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
