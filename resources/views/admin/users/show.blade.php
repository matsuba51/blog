@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg admin">
        
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">ユーザー詳細</h1>
        <div class="mb-4"><strong>名前:</strong> {{ $user->name }}</div>
        <div class="mb-4"><strong>メールアドレス:</strong> {{ $user->email }}</div>
        <div class="mb-4"><strong>登録日:</strong> {{ $user->created_at->format('Y-m-d') }}</div>

        <div class="text-center mt-6">
            <a href="{{ route('admin.users') }}" class="inline-block px-6 py-3 bg-gray-500 text-white rounded-md hover:bg-gray-600">
                ユーザー 一覧に戻る
            </a>
        </div>
    </div>
@endsection
