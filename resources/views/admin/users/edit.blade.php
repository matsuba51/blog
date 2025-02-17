@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-gray-800 text-white shadow-lg rounded-lg">
        <h1 class="text-2xl font-bold text-center mb-6">ユーザー編集</h1>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium mb-2">名前</label>
                <input type="text" name="name" id="name" 
                    value="{{ old('name', $user->name) }}" 
                    class="w-full bg-gray-700 text-white border border-gray-600 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium mb-2">メールアドレス</label>
                <input type="email" name="email" id="email" 
                    value="{{ old('email', $user->email) }}" 
                    class="w-full bg-gray-700 text-white border border-gray-600 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium mb-2">新しいパスワード（任意）</label>
                <input type="password" name="password" id="password" 
                    class="w-full bg-gray-700 text-white border border-gray-600 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium mb-2">パスワード確認（任意）</label>
                <input type="password" name="password_confirmation" id="password_confirmation" 
                    class="w-full bg-gray-700 text-white border border-gray-600 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-between">
                <button type="submit" class="btn-primary w-full py-3">
                    更新
                </button>

                 <!-- 戻るボタン -->
                 <a href="{{ route('admin.users.index') }}" class="btn-secondary w-full py-3">
                    戻る
                </a>
            </div>
        </form>
    </div>
@endsection
